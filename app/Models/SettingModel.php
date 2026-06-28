<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'array';
    protected $allowedFields = ['setting_key', 'setting_value', 'setting_type', 'description', 'updated_by'];
}
