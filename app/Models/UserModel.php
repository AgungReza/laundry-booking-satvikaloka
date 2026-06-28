<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'name', 'email', 'password', 'role', 'phone', 'is_active', 'last_login_at'
    ];
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|max_length[150]',
        'password' => 'required|min_length[8]',
        'role' => 'required|in_list[admin,customer]',
    ];
}
