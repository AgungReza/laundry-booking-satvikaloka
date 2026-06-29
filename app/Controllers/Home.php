<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $machines = [];
        $bookedMachines = [];
        $totalMachines = 0;

        try {
            $machines = $db->table('machines')
                ->select('id, code, name, type, capacity_kg, price_per_hour, minimum_duration_minutes, duration_step_minutes, max_duration_minutes, status, status_note')
                ->whereIn('status', ['available', 'booked', 'in_use', 'active'])
                ->orderBy('id', 'ASC')
                ->get()
                ->getResultArray();

            $totalMachines = count($machines);

            $activeBookings = $db->table('bookings')
                ->select('id, machine_id, booking_date, machine_start_time, machine_end_time, status')
                ->whereIn('status', ['confirmed', 'paid', 'active', 'in_progress'])
                ->where('booking_date', date('Y-m-d'))
                ->get()
                ->getResultArray();

            foreach ($activeBookings as $booking) {
                if (empty($booking['machine_id'])) {
                    continue;
                }

                $booking['available_again_time'] = $booking['machine_end_time'] ?? null;
                $bookedMachines[$booking['machine_id']] = $booking;
            }
        } catch (\Throwable $e) {
            log_message('error', 'Landing page data error: ' . $e->getMessage());
        }

        return view('landing', [
            'machines' => $machines,
            'bookedMachines' => $bookedMachines,
            'totalMachines' => $totalMachines,
        ]);
    }
}
