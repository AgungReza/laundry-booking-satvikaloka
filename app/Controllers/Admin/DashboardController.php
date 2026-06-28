<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $data = [
            'totalMachines' => $db->table('machines')->where('deleted_at IS NULL', null, false)->countAllResults(),
            'pendingPayments' => $db->table('payments')->where('payment_status', 'pending')->countAllResults(),
            'activeBookings' => $db->table('bookings')->whereIn('booking_status', ['pending_payment', 'pending_verification', 'confirmed'])->countAllResults(),
            'customers' => $db->table('users')->where('role', 'customer')->where('deleted_at IS NULL', null, false)->countAllResults(),
        ];
        return view('layouts/admin', ['title' => 'Dashboard Admin', 'content' => view('admin/dashboard', $data)]);
    }
}
