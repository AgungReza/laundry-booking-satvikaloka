<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\BankAccountModel;
use App\Services\PaymentService;

class PaymentController extends BaseController
{
    public function uploadForm(int $bookingId)
    {
        $booking = db_connect()->table('bookings')
            ->where('id', $bookingId)
            ->where('user_id', session()->get('user_id'))
            ->get()->getRowArray();
        if (!$booking) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Booking tidak ditemukan.');
        }
        $accounts = (new BankAccountModel())->where('is_active', 1)->findAll();
        return view('layouts/customer', ['title' => 'Upload Bukti Pembayaran', 'content' => view('customer/payments/upload', compact('booking', 'accounts'))]);
    }

    public function upload(int $bookingId)
    {
        $rules = [
            'bank_account_id' => 'required|integer',
            'sender_account_name' => 'required',
            'paid_at' => 'required|valid_date',
            'proof' => 'uploaded[proof]|max_size[proof,2048]|ext_in[proof,jpg,jpeg,png,pdf]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            (new PaymentService())->uploadProof(
                $bookingId,
                (int) session()->get('user_id'),
                (int) $this->request->getPost('bank_account_id'),
                $this->request->getPost(),
                $this->request->getFile('proof')
            );
            return redirect()->to('/customer/bookings/' . $bookingId)->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
