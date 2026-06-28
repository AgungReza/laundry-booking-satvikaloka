<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $bookings = db_connect()->table('bookings')
            ->where('user_id', session()->get('user_id'))
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()->getResultArray();
        return view('layouts/customer', ['title' => 'Dashboard Customer', 'content' => view('customer/dashboard', compact('bookings'))]);
    }
}
