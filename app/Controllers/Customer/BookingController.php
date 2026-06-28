<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\AddonModel;
use App\Services\BookingService;
use App\Services\MachineAvailabilityService;

class BookingController extends BaseController
{
    public function index()
    {
        $bookings = db_connect()->table('bookings')
            ->where('user_id', session()->get('user_id'))
            ->orderBy('created_at', 'DESC')
            ->get()->getResultArray();
        return view('layouts/customer', ['title' => 'Riwayat Booking', 'content' => view('customer/bookings/index', compact('bookings'))]);
    }

    public function create()
    {
        $date = $this->request->getGet('booking_date') ?: date('Y-m-d');
        $startTime = $this->request->getGet('booking_start_time') ?: '08:00';
        $machines = (new MachineAvailabilityService())->getCustomerMachines($date, $startTime);
        $addons = (new AddonModel())
            ->where('is_active', 1)
            ->groupStart()
                ->where('stock_enabled', 0)
                ->orWhere('stock_qty >', 0)
            ->groupEnd()
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('layouts/customer', [
            'title' => 'Buat Booking',
            'content' => view('customer/bookings/create', compact('machines', 'addons', 'date', 'startTime'))
        ]);
    }

    public function store()
    {
        $machineIds = $this->request->getPost('machine_ids') ?? [];
        $durations = $this->request->getPost('durations') ?? [];
        $addonQuantities = $this->request->getPost('addon_quantities') ?? [];

        $machineDurations = [];
        foreach ($machineIds as $id) {
            $machineDurations[(int) $id] = (int) ($durations[$id] ?? 0);
        }

        try {
            $bookingId = (new BookingService())->createBooking(
                (int) session()->get('user_id'),
                (string) $this->request->getPost('booking_date'),
                (string) $this->request->getPost('booking_start_time'),
                $machineDurations,
                $addonQuantities,
                $this->request->getPost('notes')
            );
            return redirect()->to('/customer/bookings/' . $bookingId)->with('success', 'Booking berhasil dibuat. Silakan upload bukti pembayaran dalam 60 menit.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        $db = db_connect();
        $booking = $db->table('bookings')
            ->where('id', $id)
            ->where('user_id', session()->get('user_id'))
            ->get()->getRowArray();
        if (!$booking) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Booking tidak ditemukan.');
        }
        $machines = $db->table('booking_machines')->where('booking_id', $id)->get()->getResultArray();
        $addons = $db->table('booking_addons')->where('booking_id', $id)->get()->getResultArray();
        $payment = $db->table('payments')->where('booking_id', $id)->get()->getRowArray();
        return view('layouts/customer', ['title' => 'Detail Booking', 'content' => view('customer/bookings/show', compact('booking', 'machines', 'addons', 'payment'))]);
    }
}