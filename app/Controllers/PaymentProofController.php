<?php

namespace App\Controllers;

use App\Models\PaymentModel;

class PaymentProofController extends BaseController
{
    public function show(int $paymentId)
    {
        $payment = (new PaymentModel())->find($paymentId);
        if (!$payment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File tidak ditemukan.');
        }

        $db = db_connect();
        $booking = $db->table('bookings')->where('id', $payment['booking_id'])->get()->getRowArray();
        $isAdmin = session()->get('role') === 'admin';
        $isOwner = $booking && (int) $booking['user_id'] === (int) session()->get('user_id');

        if (!$isAdmin && !$isOwner) {
            return redirect()->back()->with('error', 'Akses file ditolak.');
        }

        $path = WRITEPATH . $payment['proof_file_path'];
        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File tidak ditemukan.');
        }

        return $this->response->download($path, null)->inline();
    }
}
