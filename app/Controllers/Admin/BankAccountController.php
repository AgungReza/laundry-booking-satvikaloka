<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BankAccountModel;

class BankAccountController extends BaseController
{
    public function index()
    {
        $accounts = (new BankAccountModel())->orderBy('is_active', 'DESC')->findAll();
        return view('layouts/admin', ['title' => 'Rekening Transfer', 'content' => view('admin/bank_accounts/index', compact('accounts'))]);
    }

    public function store()
    {
        (new BankAccountModel())->insert([
            'bank_name' => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'account_name' => $this->request->getPost('account_name'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ]);
        return redirect()->back()->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function toggle(int $id)
    {
        $model = new BankAccountModel();
        $account = $model->find($id);
        if ($account) {
            $model->update($id, ['is_active' => (int) !$account['is_active']]);
        }
        return redirect()->back()->with('success', 'Status rekening diperbarui.');
    }
}
