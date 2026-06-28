<?php

namespace App\Models;

use CodeIgniter\Model;

class MachineModel extends Model
{
    protected $table = 'machines';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'code', 'name', 'type', 'capacity_kg', 'price_per_hour',
        'minimum_duration_minutes', 'duration_step_minutes', 'max_duration_minutes',
        'status', 'status_note'
    ];
}
