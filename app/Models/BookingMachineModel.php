<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingMachineModel extends Model
{
    protected $table = 'booking_machines';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'booking_id', 'machine_id', 'machine_name_snapshot', 'machine_code_snapshot',
        'machine_start_time', 'machine_end_time', 'available_again_time',
        'duration_minutes', 'price_per_hour_snapshot', 'subtotal'
    ];
}
