<?php

namespace App\Database\Seeds;

use App\Models\BankAccountModel;
use CodeIgniter\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    public function run()
    {
        $model = new BankAccountModel();
        if ($model->countAllResults() > 0) {
            echo "Rekening sudah tersedia.\n";
            return;
        }

        $model->insert([
            'bank_name' => env('BANK_NAME', 'BCA'),
            'account_number' => env('BANK_ACCOUNT_NUMBER', '1234567890'),
            'account_name' => env('BANK_ACCOUNT_NAME', 'Laundry Booking'),
            'is_active' => 1,
        ]);

        echo "Rekening default berhasil dibuat.\n";
    }
}
