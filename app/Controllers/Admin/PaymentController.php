<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\PaymentService;

class PaymentController extends BaseController
{
    public function index()
    {
        $payments = db_connect()->table('payments p')
            ->select('p.*, b.booking_code, b.total_price, u.name AS customer_name')
            ->join('bookings b', 'b.id = p.booking_id')
            ->join('users u', 'u.id = b.user_id')
            ->orderBy('p.created_at', 'DESC')
            ->get()->getResultArray();
        return view('layouts/admin', ['title' => 'Verifikasi Pembayaran', 'content' => view('admin/payments/index', compact('payments'))]);
    }

    public function approve(int $id)
    {
        try {
            (new PaymentService())->approve($id, (int) session()->get('user_id'));
            return redirect()->back()->with('success', 'Pembayaran berhasil disetujui.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reject(int $id)
    {
        try {
            (new PaymentService())->reject($id, (int) session()->get('user_id'), (string) $this->request->getPost('reject_reason'));
            return redirect()->back()->with('success', 'Pembayaran ditolak.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
