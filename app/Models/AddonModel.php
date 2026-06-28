<?php

namespace App\Models;

use CodeIgniter\Model;

class AddonModel extends Model
{
    protected $table = 'addons';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'name', 'description', 'price', 'stock_enabled', 'stock_qty', 'is_active'
    ];
}
