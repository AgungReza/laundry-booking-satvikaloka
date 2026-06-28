<?php

namespace App\Services;

use App\Models\BookingModel;
use DateTimeImmutable;
use DateTimeZone;

class AutoCancelService
{
    public function run(): int
    {
        $settings = new SettingService();
        $now = new DateTimeImmutable('now', new DateTimeZone($settings->timezone()));
        $bookingModel = new BookingModel();

        $expired = $bookingModel
            ->where('booking_status', 'pending_payment')
            ->where('payment_deadline_at <', $now->format('Y-m-d H:i:s'))
            ->findAll();

        foreach ($expired as $booking) {
            $bookingModel->update($booking['id'], [
                'booking_status' => 'cancelled',
                'cancel_reason' => 'Melewati batas waktu pembayaran',
                'cancelled_at' => $now->format('Y-m-d H:i:s'),
            ]);
        }

        return count($expired);
    }
}
