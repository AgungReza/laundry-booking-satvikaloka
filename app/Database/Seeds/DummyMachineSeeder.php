<?php

namespace App\Database\Seeds;

use App\Models\MachineModel;
use CodeIgniter\Database\Seeder;

class DummyMachineSeeder extends Seeder
{
    public function run()
    {
        $model = new MachineModel();
        if ($model->countAllResults() > 0) {
            echo "Data mesin sudah tersedia.\n";
            return;
        }

        $machines = [
            ['MC-01', 'Mesin Cuci 01', 'washer', 8, 20000],
            ['MC-02', 'Mesin Cuci 02', 'washer', 8, 20000],
            ['DR-01', 'Mesin Dryer 01', 'dryer', 8, 15000],
            ['DR-02', 'Mesin Dryer 02', 'dryer', 8, 15000],
        ];

        foreach ($machines as $m) {
            $model->insert([
                'code' => $m[0],
                'name' => $m[1],
                'type' => $m[2],
                'capacity_kg' => $m[3],
                'price_per_hour' => $m[4],
                'minimum_duration_minutes' => 30,
                'duration_step_minutes' => 30,
                'status' => 'available',
            ]);
        }

        echo "Dummy mesin berhasil dibuat.\n";
    }
}
