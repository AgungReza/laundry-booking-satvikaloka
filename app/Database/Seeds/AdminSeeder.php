<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $model = new UserModel();
        $email = env('ADMIN_EMAIL', 'admin@laundry.test');

        if ($model->where('email', $email)->first()) {
            echo "Admin sudah ada: {$email}\n";
            return;
        }

        $model->insert([
            'name' => env('ADMIN_NAME', 'Admin Laundry'),
            'email' => $email,
            'password' => password_hash(env('ADMIN_PASSWORD', 'Admin12345'), PASSWORD_BCRYPT),
            'role' => 'admin',
            'phone' => env('ADMIN_PHONE', null),
            'is_active' => 1,
        ]);

        echo "Admin dibuat: {$email}\n";
    }
}
