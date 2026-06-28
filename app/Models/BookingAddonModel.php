<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingAddonModel extends Model
{
    protected $table = 'booking_addons';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'booking_id', 'addon_id', 'addon_name_snapshot', 'unit_price_snapshot', 'quantity', 'subtotal'
    ];
}
