<?php

namespace App\Services;

use App\Models\MachineModel;
use DateInterval;
use DateTimeImmutable;

class MachineAvailabilityService
{
    private SettingService $settingService;

    public function __construct()
    {
        $this->settingService = new SettingService();
    }

    public function getCustomerMachines(string $bookingDate, string $startTime): array
    {
        $machineModel = new MachineModel();
        $machines = $machineModel->where('status', 'available')->orderBy('code', 'ASC')->findAll();
        $result = [];

        foreach ($machines as $machine) {
            $duration = (int) $machine['minimum_duration_minutes'];
            $availability = $this->checkMachine($machine['id'], $bookingDate, $startTime, $duration);
            $machine['dynamic_status'] = $availability['available'] ? 'available' : 'booked';
            $machine['available_again_time'] = $availability['available_again_time'];
            $result[] = $machine;
        }

        return $result;
    }

    public function checkMachine(int $machineId, string $bookingDate, string $startTime, int $durationMinutes): array
    {
        $buffer = $this->settingService->bookingBufferMinutes();
        $newStart = $this->normalizeTime($startTime);
        $newAvailableAgain = $this->addMinutes($bookingDate, $newStart, $durationMinutes + $buffer);

        $db = db_connect();
        $rows = $db->table('bookings b')
            ->select('b.id, bm.machine_id, bm.machine_start_time, bm.machine_end_time, bm.available_again_time')
            ->join('booking_machines bm', 'bm.booking_id = b.id')
            ->where('bm.machine_id', $machineId)
            ->where('b.booking_date', $bookingDate)
            ->whereIn('b.booking_status', ['pending_payment', 'pending_verification', 'confirmed'])
            ->where('bm.machine_start_time <', $newAvailableAgain)
            ->where('bm.available_again_time >', $newStart)
            ->orderBy('bm.available_again_time', 'DESC')
            ->get()
            ->getResultArray();

        if (empty($rows)) {
            return ['available' => true, 'available_again_time' => null, 'conflicts' => []];
        }

        return [
            'available' => false,
            'available_again_time' => $rows[0]['available_again_time'],
            'conflicts' => $rows,
        ];
    }

    private function normalizeTime(string $time): string
    {
        return strlen($time) === 5 ? $time . ':00' : $time;
    }

    private function addMinutes(string $date, string $time, int $minutes): string
    {
        $timezone = new \DateTimeZone($this->settingService->timezone());
        $dt = new DateTimeImmutable($date . ' ' . $this->normalizeTime($time), $timezone);
        return $dt->add(new DateInterval('PT' . $minutes . 'M'))->format('H:i:s');
    }
}
