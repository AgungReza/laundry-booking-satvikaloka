<?php

namespace App\Services;

class ReportService
{
    public function summary(?string $startDate, ?string $endDate): array
    {
        $db = db_connect();
        $startDate = $startDate ?: date('Y-m-01');
        $endDate = $endDate ?: date('Y-m-d');

        $income = $db->table('payments')
            ->selectSum('amount', 'total')
            ->where('payment_status', 'verified')
            ->where('DATE(verified_at) >=', $startDate)
            ->where('DATE(verified_at) <=', $endDate)
            ->get()->getRowArray()['total'] ?? 0;

        $expense = $db->table('expenses')
            ->selectSum('amount', 'total')
            ->where('deleted_at IS NULL', null, false)
            ->where('expense_date >=', $startDate)
            ->where('expense_date <=', $endDate)
            ->get()->getRowArray()['total'] ?? 0;

        $pendingPayments = $db->table('payments')->where('payment_status', 'pending')->countAllResults();
        $activeBookings = $db->table('bookings')
            ->whereIn('booking_status', ['pending_payment', 'pending_verification', 'confirmed'])
            ->countAllResults();

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'income' => (float) $income,
            'expense' => (float) $expense,
            'profit' => (float) $income - (float) $expense,
            'pending_payments' => $pendingPayments,
            'active_bookings' => $activeBookings,
        ];
    }
}
