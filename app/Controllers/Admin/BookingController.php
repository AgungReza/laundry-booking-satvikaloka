<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;

class BookingController extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $bookings = $db->table('bookings b')
            ->select('b.*, u.name AS customer_name, u.phone')
            ->join('users u', 'u.id = b.user_id')
            ->orderBy('b.created_at', 'DESC')
            ->get()->getResultArray();
        return view('layouts/admin', ['title' => 'Booking', 'content' => view('admin/bookings/index', compact('bookings'))]);
    }

    public function show(int $id)
    {
        $db = db_connect();
        $booking = $db->table('bookings b')
            ->select('b.*, u.name AS customer_name, u.email, u.phone')
            ->join('users u', 'u.id = b.user_id')
            ->where('b.id', $id)->get()->getRowArray();
        if (!$booking) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Booking tidak ditemukan.');
        }
        $machines = $db->table('booking_machines')->where('booking_id', $id)->get()->getResultArray();
        $addons = $db->table('booking_addons')->where('booking_id', $id)->get()->getResultArray();
        $payment = $db->table('payments')->where('booking_id', $id)->get()->getRowArray();
        return view('layouts/admin', ['title' => 'Detail Booking', 'content' => view('admin/bookings/show', compact('booking', 'machines', 'addons', 'payment'))]);
    }

    public function complete(int $id)
    {
        (new BookingModel())->update($id, [
            'booking_status' => 'completed',
            'completed_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->back()->with('success', 'Booking ditandai selesai.');
    }

    public function cancel(int $id)
    {
        $reason = $this->request->getPost('cancel_reason') ?: 'Dibatalkan admin';
        (new BookingModel())->update($id, [
            'booking_status' => 'cancelled',
            'cancel_reason' => $reason,
            'cancelled_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->back()->with('success', 'Booking dibatalkan.');
    }
}
