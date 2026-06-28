<?php

namespace App\Models;

use CodeIgniter\Model;

class BankAccountModel extends Model
{
    protected $table = 'bank_accounts';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $returnType = 'array';
    protected $allowedFields = ['bank_name', 'account_number', 'account_name', 'is_active'];
}
