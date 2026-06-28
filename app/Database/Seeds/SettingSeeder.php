<?php

namespace App\Database\Seeds;

use App\Models\SettingModel;
use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['payment_deadline_minutes', '60', 'integer', 'Batas upload bukti pembayaran dalam menit.'],
            ['open_time', '08:00', 'string', 'Jam buka laundry WIB.'],
            ['close_time', '22:00', 'string', 'Jam tutup laundry WIB.'],
            ['default_minimum_duration_minutes', '30', 'integer', 'Durasi minimal default.'],
            ['default_duration_step_minutes', '30', 'integer', 'Kelipatan durasi default.'],
            ['booking_buffer_minutes', '15', 'integer', 'Buffer antar booking dalam menit.'],
            ['app_timezone', 'Asia/Jakarta', 'string', 'Timezone aplikasi.'],
            ['price_rounding_mode', 'normal', 'string', 'Mode pembulatan harga.'],
        ];

        $model = new SettingModel();
        foreach ($settings as $item) {
            [$key, $value, $type, $desc] = $item;
            $exists = $model->where('setting_key', $key)->first();
            if ($exists) {
                $model->update($exists['id'], [
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'description' => $desc,
                ]);
            } else {
                $model->insert([
                    'setting_key' => $key,
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'description' => $desc,
                ]);
            }
        }

        echo "Settings berhasil dibuat/diperbarui.\n";
    }
}
