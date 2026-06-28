<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExpenseModel;

class ExpenseController extends BaseController
{
    public function index()
    {
        $expenses = (new ExpenseModel())->orderBy('expense_date', 'DESC')->findAll();
        return view('layouts/admin', ['title' => 'Pengeluaran', 'content' => view('admin/expenses/index', compact('expenses'))]);
    }

    public function store()
    {
        $rules = [
            'title' => 'required',
            'category' => 'required',
            'amount' => 'required|decimal|greater_than[0]',
            'expense_date' => 'required|valid_date',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        (new ExpenseModel())->insert([
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'amount' => $this->request->getPost('amount'),
            'expense_date' => $this->request->getPost('expense_date'),
            'note' => $this->request->getPost('note'),
            'created_by' => session()->get('user_id'),
        ]);
        return redirect()->back()->with('success', 'Pengeluaran berhasil dicatat.');
    }
}
