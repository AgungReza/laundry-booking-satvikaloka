<?php

namespace App\Services;

use App\Models\BookingAddonModel;
use App\Models\BookingMachineModel;
use App\Models\BookingModel;
use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use RuntimeException;

class BookingService
{
    private SettingService $settings;
    private PricingService $pricing;
    private MachineAvailabilityService $availability;

    public function __construct()
    {
        $this->settings = new SettingService();
        $this->pricing = new PricingService();
        $this->availability = new MachineAvailabilityService();
    }

    public function createBooking(
        int $userId,
        string $bookingDate,
        string $startTime,
        array $machineDurations,
        array $addonQuantities = [],
        ?string $notes = null
    ): int {
        if (empty($machineDurations)) {
            throw new RuntimeException('Pilih minimal 1 mesin.');
        }

        $timezone = new DateTimeZone($this->settings->timezone());
        $today = new DateTimeImmutable('today', $timezone);
        $bookingDay = new DateTimeImmutable($bookingDate . ' 00:00:00', $timezone);

        if ($bookingDay < $today) {
            throw new RuntimeException('Tanggal booking tidak boleh sebelum hari ini.');
        }

        $startTime = $this->normalizeTime($startTime);
        $this->validateOperationalHour($bookingDate, $startTime);

        $db = db_connect();
        $db->transStart();

        try {
            $machineIds = array_map('intval', array_keys($machineDurations));
            $machineIds = array_values(array_unique(array_filter($machineIds)));
            sort($machineIds);

            if (empty($machineIds)) {
                throw new RuntimeException('Pilih minimal 1 mesin.');
            }

            $idList = implode(',', $machineIds);

            $machines = $db->query("SELECT * FROM machines WHERE deleted_at IS NULL AND id IN ($idList) ORDER BY id ASC FOR UPDATE")
                ->getResultArray();

            if (count($machines) !== count($machineIds)) {
                throw new RuntimeException('Ada mesin yang tidak ditemukan.');
            }

            $buffer = $this->settings->bookingBufferMinutes();
            $deadlineMinutes = $this->settings->paymentDeadlineMinutes();
            $machineDetails = [];
            $machineTotalPrice = 0;
            $latestEnd = $startTime;

            foreach ($machines as $machine) {
                if ($machine['status'] !== 'available') {
                    throw new RuntimeException('Mesin ' . $machine['name'] . ' sedang tidak tersedia.');
                }

                $duration = (int) ($machineDurations[$machine['id']] ?? 0);
                $this->validateDuration($machine, $duration);

                $machineEnd = $this->addMinutes($bookingDate, $startTime, $duration);
                $availableAgain = $this->addMinutes($bookingDate, $startTime, $duration + $buffer);
                $this->validateOperationalEnd($bookingDate, $availableAgain);

                $check = $this->availability->checkMachine((int) $machine['id'], $bookingDate, $startTime, $duration);
                if (!$check['available']) {
                    throw new RuntimeException('Mesin ' . $machine['name'] . ' sedang tidak tersedia sampai ' . substr((string) $check['available_again_time'], 0, 5) . ' WIB.');
                }

                $subtotal = $this->pricing->subtotal((float) $machine['price_per_hour'], $duration);
                $machineTotalPrice += $subtotal;
                if ($machineEnd > $latestEnd) {
                    $latestEnd = $machineEnd;
                }

                $machineDetails[] = [
                    'machine' => $machine,
                    'duration_minutes' => $duration,
                    'machine_start_time' => $startTime,
                    'machine_end_time' => $machineEnd,
                    'available_again_time' => $availableAgain,
                    'subtotal' => $subtotal,
                ];
            }

            $addonDetails = $this->prepareAddonDetails($db, $addonQuantities);
            $addonTotalPrice = array_sum(array_column($addonDetails, 'subtotal'));
            $totalPrice = $machineTotalPrice + $addonTotalPrice;

            $now = new DateTimeImmutable('now', $timezone);
            $deadline = $now->add(new DateInterval('PT' . $deadlineMinutes . 'M'));
            $bookingCode = $this->generateBookingCode($db);

            $bookingModel = new BookingModel();
            $bookingId = $bookingModel->insert([
                'user_id' => $userId,
                'booking_code' => $bookingCode,
                'booking_date' => $bookingDate,
                'booking_start_time' => $startTime,
                'booking_end_time' => $latestEnd,
                'buffer_minutes_snapshot' => $buffer,
                'payment_type' => 'full',
                'total_price' => $totalPrice,
                'booking_status' => 'pending_payment',
                'payment_deadline_at' => $deadline->format('Y-m-d H:i:s'),
                'notes' => $notes,
            ], true);

            $bookingMachineModel = new BookingMachineModel();
            foreach ($machineDetails as $detail) {
                $machine = $detail['machine'];
                $bookingMachineModel->insert([
                    'booking_id' => $bookingId,
                    'machine_id' => $machine['id'],
                    'machine_name_snapshot' => $machine['name'],
                    'machine_code_snapshot' => $machine['code'],
                    'machine_start_time' => $detail['machine_start_time'],
                    'machine_end_time' => $detail['machine_end_time'],
                    'available_again_time' => $detail['available_again_time'],
                    'duration_minutes' => $detail['duration_minutes'],
                    'price_per_hour_snapshot' => $machine['price_per_hour'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }

            $bookingAddonModel = new BookingAddonModel();
            foreach ($addonDetails as $detail) {
                $addon = $detail['addon'];
                $bookingAddonModel->insert([
                    'booking_id' => $bookingId,
                    'addon_id' => $addon['id'],
                    'addon_name_snapshot' => $addon['name'],
                    'unit_price_snapshot' => $addon['price'],
                    'quantity' => $detail['quantity'],
                    'subtotal' => $detail['subtotal'],
                ]);

                if ((int) $addon['stock_enabled'] === 1) {
                    $db->table('addons')
                        ->where('id', $addon['id'])
                        ->set('stock_qty', 'stock_qty - ' . (int) $detail['quantity'], false)
                        ->update();
                }
            }

            $db->transComplete();
            if (!$db->transStatus()) {
                throw new RuntimeException('Gagal membuat booking.');
            }

            return (int) $bookingId;
        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }

    private function prepareAddonDetails($db, array $addonQuantities): array
    {
        $cleanQuantities = [];
        foreach ($addonQuantities as $addonId => $quantity) {
            $addonId = (int) $addonId;
            $quantity = (int) $quantity;
            if ($addonId > 0 && $quantity > 0) {
                $cleanQuantities[$addonId] = $quantity;
            }
        }

        if (empty($cleanQuantities)) {
            return [];
        }

        $addonIds = array_keys($cleanQuantities);
        sort($addonIds);
        $idList = implode(',', $addonIds);

        $addons = $db->query("SELECT * FROM addons WHERE deleted_at IS NULL AND is_active = 1 AND id IN ($idList) ORDER BY id ASC FOR UPDATE")
            ->getResultArray();

        if (count($addons) !== count($addonIds)) {
            throw new RuntimeException('Ada add on yang tidak ditemukan atau sedang nonaktif.');
        }

        $details = [];
        foreach ($addons as $addon) {
            $quantity = (int) ($cleanQuantities[(int) $addon['id']] ?? 0);
            if ($quantity <= 0) {
                continue;
            }

            if ((int) $addon['stock_enabled'] === 1 && (int) $addon['stock_qty'] < $quantity) {
                throw new RuntimeException('Stok add on ' . $addon['name'] . ' tidak cukup.');
            }

            $price = (float) $addon['price'];
            $details[] = [
                'addon' => $addon,
                'quantity' => $quantity,
                'subtotal' => $price * $quantity,
            ];
        }

        return $details;
    }

    private function validateDuration(array $machine, int $duration): void
    {
        $min = (int) $machine['minimum_duration_minutes'];
        $step = (int) $machine['duration_step_minutes'];
        $max = $machine['max_duration_minutes'] !== null ? (int) $machine['max_duration_minutes'] : null;

        if ($duration < $min) {
            throw new RuntimeException('Durasi mesin ' . $machine['name'] . ' minimal ' . $min . ' menit.');
        }
        if ($step > 0 && (($duration - $min) % $step !== 0)) {
            throw new RuntimeException('Durasi mesin ' . $machine['name'] . ' harus mengikuti kelipatan ' . $step . ' menit.');
        }
        if ($max !== null && $duration > $max) {
            throw new RuntimeException('Durasi mesin ' . $machine['name'] . ' maksimal ' . $max . ' menit.');
        }
    }

    private function validateOperationalHour(string $date, string $startTime): void
    {
        $open = $this->normalizeTime($this->settings->openTime());
        $close = $this->normalizeTime($this->settings->closeTime());
        if ($startTime < $open || $startTime >= $close) {
            throw new RuntimeException('Jam mulai harus berada dalam jam operasional ' . substr($open, 0, 5) . ' - ' . substr($close, 0, 5) . ' WIB.');
        }
    }

    private function validateOperationalEnd(string $date, string $availableAgain): void
    {
        $close = $this->normalizeTime($this->settings->closeTime());
        if ($availableAgain > $close) {
            throw new RuntimeException('Durasi dan buffer melewati jam tutup laundry.');
        }
    }

    private function generateBookingCode($db): string
    {
        do {
            $code = 'BK-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));
            $exists = $db->table('bookings')->where('booking_code', $code)->countAllResults() > 0;
        } while ($exists);
        return $code;
    }

    private function normalizeTime(string $time): string
    {
        return strlen($time) === 5 ? $time . ':00' : $time;
    }

    private function addMinutes(string $date, string $time, int $minutes): string
    {
        $timezone = new DateTimeZone($this->settings->timezone());
        $dt = new DateTimeImmutable($date . ' ' . $this->normalizeTime($time), $timezone);
        return $dt->add(new DateInterval('PT' . $minutes . 'M'))->format('H:i:s');
    }
}
