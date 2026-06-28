<?php

namespace App\Services;

use App\Models\SettingModel;

class SettingService
{
    private SettingModel $settings;
    private array $cache = [];

    public function __construct()
    {
        $this->settings = new SettingModel();
    }

    public function get(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, $this->cache)) {
            return $this->cache[$key];
        }

        $row = $this->settings->where('setting_key', $key)->first();
        if (!$row) {
            return $default;
        }

        $value = $row['setting_value'];
        if (($row['setting_type'] ?? 'string') === 'integer') {
            $value = (int) $value;
        } elseif (($row['setting_type'] ?? 'string') === 'decimal') {
            $value = (float) $value;
        } elseif (($row['setting_type'] ?? 'string') === 'boolean') {
            $value = (bool) $value;
        }

        $this->cache[$key] = $value;
        return $value;
    }

    public function timezone(): string
    {
        return (string) $this->get('app_timezone', 'Asia/Jakarta');
    }

    public function paymentDeadlineMinutes(): int
    {
        return (int) $this->get('payment_deadline_minutes', 60);
    }

    public function bookingBufferMinutes(): int
    {
        return (int) $this->get('booking_buffer_minutes', 15);
    }

    public function openTime(): string
    {
        return (string) $this->get('open_time', '08:00');
    }

    public function closeTime(): string
    {
        return (string) $this->get('close_time', '22:00');
    }
}
