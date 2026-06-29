<?php
$statusClasses = [
    'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
    'pending_payment' => 'bg-amber-50 text-amber-700 border-amber-100',
    'waiting_verification' => 'bg-blue-50 text-blue-700 border-blue-100',
    'verified' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'confirmed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'completed' => 'bg-slate-50 text-slate-700 border-slate-100',
    'cancelled' => 'bg-red-50 text-red-700 border-red-100',
    'canceled' => 'bg-red-50 text-red-700 border-red-100',
];
?>

<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-950">Data Booking</h1>
        <p class="mt-1 text-sm text-slate-500">
            Kelola dan pantau seluruh booking mesin laundry customer.
        </p>
    </div>

    <div class="inline-flex w-fit items-center gap-2 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-2 text-sm font-bold text-emerald-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <rect x="3" y="5" width="18" height="16" rx="2"></rect>
            <path d="M16 3v4M8 3v4M3 10h18"></path>
        </svg>
        Total Booking: <?= count($bookings ?? []) ?>
    </div>
</div>


<!-- TABLE CARD -->
<div class="overflow-hidden rounded-[2rem] border border-slate-100 bg-white shadow-sm">

    <!-- CARD HEADER -->
    <div class="border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-white p-5">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3z"></path>
                    <path d="M9 8h6"></path>
                    <path d="M9 12h6"></path>
                    <path d="M9 16h4"></path>
                </svg>
            </div>

            <div>
                <h2 class="font-extrabold text-slate-950">Daftar Booking Masuk</h2>
                <p class="text-sm text-slate-500">
                    Klik detail untuk melihat informasi booking dan pembayaran.
                </p>
            </div>
        </div>
    </div>


    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full min-w-[950px] text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-extrabold uppercase tracking-wide text-slate-500">
                    <th class="px-5 py-4 text-left">Kode Booking</th>
                    <th class="px-5 py-4 text-left">Customer</th>
                    <th class="px-5 py-4 text-left">Tanggal</th>
                    <th class="px-5 py-4 text-center">Jam</th>
                    <th class="px-5 py-4 text-right">Total</th>
                    <th class="px-5 py-4 text-center">Status</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                <?php if (empty($bookings)): ?>
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center">
                            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                                    <path d="M16 3v4M8 3v4M3 10h18"></path>
                                    <path d="M9 15h6"></path>
                                </svg>
                            </div>

                            <h3 class="font-extrabold text-slate-950">
                                Belum ada booking
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Booking customer akan muncul di halaman ini.
                            </p>
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($bookings as $b): ?>
                        <?php
                        $status = strtolower($b['booking_status'] ?? '');
                        $badgeClass = $statusClasses[$status] ?? 'bg-slate-50 text-slate-700 border-slate-100';
                        $statusLabel = ucwords(str_replace('_', ' ', $b['booking_status'] ?? '-'));
                        ?>

                        <tr class="transition hover:bg-emerald-50/40">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3z"></path>
                                            <path d="M9 8h6"></path>
                                            <path d="M9 12h6"></path>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-extrabold text-slate-950">
                                            <?= esc($b['booking_code']) ?>
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            ID: <?= esc((string) $b['id']) ?>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-800">
                                    <?= esc($b['customer_name']) ?>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                <?= esc($b['booking_date']) ?>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold text-slate-700">
                                    <?= substr($b['booking_start_time'], 0, 5) ?> WIB
                                </span>
                            </td>

                            <td class="px-5 py-4 text-right font-extrabold text-slate-950">
                                Rp<?= number_format($b['total_price'], 0, ',', '.') ?>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full border px-3 py-1 text-xs font-bold <?= $badgeClass ?>">
                                    <?= esc($statusLabel) ?>
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <a
                                    href="/admin/bookings/<?= $b['id'] ?>"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100">
                                    Detail

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M9 18l6-6-6-6"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>