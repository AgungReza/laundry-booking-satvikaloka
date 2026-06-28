<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id', 'booking_code', 'booking_date', 'booking_start_time', 'booking_end_time',
        'buffer_minutes_snapshot', 'payment_type', 'total_price', 'dp_amount', 'remaining_amount',
        'booking_status', 'payment_deadline_at', 'cancel_reason', 'status_reason',
        'cancelled_at', 'completed_at', 'notes'
    ];
}
