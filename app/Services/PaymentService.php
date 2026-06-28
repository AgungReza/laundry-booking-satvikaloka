<?php

namespace App\Services;

use App\Models\BankAccountModel;
use App\Models\BookingModel;
use App\Models\PaymentModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use DateTimeImmutable;
use DateTimeZone;
use RuntimeException;

class PaymentService
{
    private SettingService $settings;

    public function __construct()
    {
        $this->settings = new SettingService();
    }

    public function uploadProof(int $bookingId, int $userId, int $bankAccountId, array $payload, UploadedFile $file): int
    {
        $bookingModel = new BookingModel();
        $booking = $bookingModel->where('id', $bookingId)->where('user_id', $userId)->first();
        if (!$booking) {
            throw new RuntimeException('Booking tidak ditemukan.');
        }
        if ($booking['booking_status'] !== 'pending_payment') {
            throw new RuntimeException('Booking ini tidak berada pada status menunggu pembayaran.');
        }

        $timezone = new DateTimeZone($this->settings->timezone());
        $now = new DateTimeImmutable('now', $timezone);
        $deadline = new DateTimeImmutable($booking['payment_deadline_at'], $timezone);
        if ($now > $deadline) {
            $bookingModel->update($bookingId, [
                'booking_status' => 'cancelled',
                'cancel_reason' => 'Melewati batas waktu pembayaran',
                'cancelled_at' => $now->format('Y-m-d H:i:s'),
            ]);
            throw new RuntimeException('Deadline pembayaran sudah lewat. Booking dibatalkan.');
        }

        if (!$file->isValid()) {
            throw new RuntimeException('File bukti pembayaran tidak valid.');
        }
        if ($file->getSizeByUnit('mb') > 2) {
            throw new RuntimeException('Ukuran file maksimal 2MB.');
        }

        $allowedMime = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($file->getMimeType(), $allowedMime, true)) {
            throw new RuntimeException('File harus jpg, jpeg, png, atau pdf.');
        }

        $bank = (new BankAccountModel())->where('is_active', 1)->find($bankAccountId);
        if (!$bank) {
            throw new RuntimeException('Rekening tujuan tidak valid atau tidak aktif.');
        }

        $uploadDir = WRITEPATH . 'uploads/payments';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $newName = $file->getRandomName();
        $file->move($uploadDir, $newName);
        $relativePath = 'uploads/payments/' . $newName;

        $db = db_connect();
        $db->transStart();
        try {
            $paymentId = (new PaymentModel())->insert([
                'booking_id' => $bookingId,
                'bank_account_id' => $bank['id'],
                'bank_name_snapshot' => $bank['bank_name'],
                'account_number_snapshot' => $bank['account_number'],
                'account_name_snapshot' => $bank['account_name'],
                'payment_stage' => 'full',
                'amount' => $booking['total_price'],
                'sender_bank_name' => $payload['sender_bank_name'] ?? null,
                'sender_account_name' => $payload['sender_account_name'],
                'sender_account_number' => $payload['sender_account_number'] ?? null,
                'paid_at' => $payload['paid_at'],
                'uploaded_at' => $now->format('Y-m-d H:i:s'),
                'proof_file_path' => $relativePath,
                'proof_original_name' => $file->getClientName(),
                'payment_status' => 'pending',
            ], true);

            $bookingModel->update($bookingId, ['booking_status' => 'pending_verification']);
            $db->transComplete();
            return (int) $paymentId;
        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }

    public function approve(int $paymentId, int $adminId): void
    {
        $paymentModel = new PaymentModel();
        $payment = $paymentModel->find($paymentId);
        if (!$payment || $payment['payment_status'] !== 'pending') {
            throw new RuntimeException('Payment tidak valid.');
        }

        $now = (new DateTimeImmutable('now', new DateTimeZone($this->settings->timezone())))->format('Y-m-d H:i:s');
        $paymentModel->update($paymentId, [
            'payment_status' => 'verified',
            'verified_by' => $adminId,
            'verified_at' => $now,
        ]);
        (new BookingModel())->update($payment['booking_id'], ['booking_status' => 'confirmed']);
    }

    public function reject(int $paymentId, int $adminId, string $reason): void
    {
        if (trim($reason) === '') {
            throw new RuntimeException('Alasan penolakan wajib diisi.');
        }

        $paymentModel = new PaymentModel();
        $payment = $paymentModel->find($paymentId);
        if (!$payment || $payment['payment_status'] !== 'pending') {
            throw new RuntimeException('Payment tidak valid.');
        }

        $paymentModel->update($paymentId, [
            'payment_status' => 'rejected',
            'verified_by' => $adminId,
            'verified_at' => date('Y-m-d H:i:s'),
            'reject_reason' => $reason,
        ]);
        (new BookingModel())->update($payment['booking_id'], [
            'booking_status' => 'rejected',
            'status_reason' => $reason,
        ]);
    }
}
