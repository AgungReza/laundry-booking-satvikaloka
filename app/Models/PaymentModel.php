<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'booking_id', 'bank_account_id', 'bank_name_snapshot', 'account_number_snapshot',
        'account_name_snapshot', 'payment_stage', 'amount', 'sender_bank_name',
        'sender_account_name', 'sender_account_number', 'paid_at', 'uploaded_at',
        'proof_file_path', 'proof_original_name', 'payment_status', 'verified_by',
        'verified_at', 'reject_reason'
    ];
}
