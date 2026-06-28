<?php

namespace App\Services;

class PricingService
{
    public function subtotal(float $pricePerHour, int $durationMinutes): float
    {
        $subtotal = $pricePerHour * ($durationMinutes / 60);
        return round($subtotal, 0);
    }

    public function total(array $machineRowsWithDuration): float
    {
        $total = 0;
        foreach ($machineRowsWithDuration as $item) {
            $total += $this->subtotal((float) $item['price_per_hour'], (int) $item['duration_minutes']);
        }
        return round($total, 0);
    }
}
