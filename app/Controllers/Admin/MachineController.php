<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MachineModel;

class MachineController extends BaseController
{
    public function index()
    {
        $machines = (new MachineModel())->orderBy('code', 'ASC')->findAll();
        return view('layouts/admin', ['title' => 'Mesin Laundry', 'content' => view('admin/machines/index', compact('machines'))]);
    }

    public function create()
    {
        return view('layouts/admin', ['title' => 'Tambah Mesin', 'content' => view('admin/machines/form', ['machine' => null])]);
    }

    public function store()
    {
        $rules = [
            'code' => 'required|is_unique[machines.code]',
            'name' => 'required',
            'type' => 'required|in_list[washer,dryer,combo]',
            'price_per_hour' => 'required|decimal|greater_than[0]',
            'minimum_duration_minutes' => 'required|integer|greater_than_equal_to[1]',
            'duration_step_minutes' => 'required|integer|greater_than_equal_to[1]',
            'status' => 'required|in_list[available,maintenance,broken,inactive]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        (new MachineModel())->insert($this->machinePayload());
        return redirect()->to('/admin/machines')->with('success', 'Mesin berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $machine = (new MachineModel())->find($id);
        if (!$machine) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mesin tidak ditemukan.');
        }
        return view('layouts/admin', ['title' => 'Edit Mesin', 'content' => view('admin/machines/form', compact('machine'))]);
    }

    public function update(int $id)
    {
        $model = new MachineModel();
        $machine = $model->find($id);
        if (!$machine) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mesin tidak ditemukan.');
        }

        $newStatus = $this->request->getPost('status');
        if ($machine['status'] === 'available' && in_array($newStatus, ['maintenance', 'broken', 'inactive'], true)) {
            $active = db_connect()->table('bookings b')
                ->join('booking_machines bm', 'bm.booking_id = b.id')
                ->where('bm.machine_id', $id)
                ->whereIn('b.booking_status', ['pending_payment', 'pending_verification', 'confirmed'])
                ->where('b.booking_date >=', date('Y-m-d'))
                ->countAllResults();
            if ($active > 0) {
                return redirect()->back()->withInput()->with('error', 'Mesin masih memiliki booking aktif/mendatang. Batalkan/selesaikan booking terlebih dahulu.');
            }
        }

        $model->update($id, $this->machinePayload());
        return redirect()->to('/admin/machines')->with('success', 'Mesin berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        (new MachineModel())->delete($id);
        return redirect()->to('/admin/machines')->with('success', 'Mesin berhasil dihapus.');
    }

    private function machinePayload(): array
    {
        return [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'capacity_kg' => $this->request->getPost('capacity_kg') ?: 0,
            'price_per_hour' => $this->request->getPost('price_per_hour'),
            'minimum_duration_minutes' => $this->request->getPost('minimum_duration_minutes') ?: 30,
            'duration_step_minutes' => $this->request->getPost('duration_step_minutes') ?: 30,
            'max_duration_minutes' => $this->request->getPost('max_duration_minutes') ?: null,
            'status' => $this->request->getPost('status'),
            'status_note' => $this->request->getPost('status_note'),
        ];
    }
}
