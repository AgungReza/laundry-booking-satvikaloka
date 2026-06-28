<?php

namespace App\Commands;

use App\Services\AutoCancelService;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class AutoCancelBooking extends BaseCommand
{
    protected $group = 'Booking';
    protected $name = 'booking:auto-cancel';
    protected $description = 'Membatalkan booking pending_payment yang melewati deadline pembayaran.';

    public function run(array $params)
    {
        $count = (new AutoCancelService())->run();
        CLI::write("Auto-cancel selesai. Total booking dibatalkan: {$count}", 'green');
    }
}
