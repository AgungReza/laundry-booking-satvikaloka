<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AddonModel;

class AddonController extends BaseController
{
    public function index()
    {
        $addons = (new AddonModel())->orderBy('name', 'ASC')->findAll();
        return view('layouts/admin', [
            'title' => 'Add On',
            'content' => view('admin/addons/index', compact('addons'))
        ]);
    }

    public function create()
    {
        return view('layouts/admin', [
            'title' => 'Tambah Add On',
            'content' => view('admin/addons/form', ['addon' => null])
        ]);
    }

    public function store()
    {
        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new AddonModel())->insert($this->payload());
        return redirect()->to('/admin/addons')->with('success', 'Add on berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $addon = (new AddonModel())->find($id);
        if (!$addon) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Add on tidak ditemukan.');
        }

        return view('layouts/admin', [
            'title' => 'Edit Add On',
            'content' => view('admin/addons/form', compact('addon'))
        ]);
    }

    public function update(int $id)
    {
        $model = new AddonModel();
        $addon = $model->find($id);
        if (!$addon) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Add on tidak ditemukan.');
        }

        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, $this->payload());
        return redirect()->to('/admin/addons')->with('success', 'Add on berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        (new AddonModel())->delete($id);
        return redirect()->to('/admin/addons')->with('success', 'Add on berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'name' => 'required|min_length[2]|max_length[120]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_enabled' => 'permit_empty|in_list[0,1]',
            'stock_qty' => 'permit_empty|integer|greater_than_equal_to[0]',
            'is_active' => 'permit_empty|in_list[0,1]',
        ];
    }

    private function payload(): array
    {
        $stockEnabled = (int) ($this->request->getPost('stock_enabled') ?? 0);

        return [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price') ?: 0,
            'stock_enabled' => $stockEnabled,
            'stock_qty' => $stockEnabled ? (int) ($this->request->getPost('stock_qty') ?: 0) : null,
            'is_active' => (int) ($this->request->getPost('is_active') ?? 1),
        ];
    }
}
