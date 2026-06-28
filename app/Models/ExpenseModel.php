<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $returnType = 'array';
    protected $allowedFields = ['title', 'category', 'amount', 'expense_date', 'note', 'created_by'];
}
