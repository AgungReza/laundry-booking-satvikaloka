<?php
$status = strtolower($booking['booking_status'] ?? '');

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

$statusBadgeClass = $statusClasses[$status] ?? 'bg-slate-50 text-slate-700 border-slate-100';
$statusLabel = ucwords(str_replace('_', ' ', $booking['booking_status'] ?? '-'));

$paymentStatus = strtolower($payment['payment_status'] ?? '');

$paymentClasses = [
    'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
    'waiting_verification' => 'bg-blue-50 text-blue-700 border-blue-100',
    'verified' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'rejected' => 'bg-red-50 text-red-700 border-red-100',
];

$paymentBadgeClass = $paymentClasses[$paymentStatus] ?? 'bg-slate-50 text-slate-700 border-slate-100';
$paymentLabel = ucwords(str_replace('_', ' ', $payment['payment_status'] ?? '-'));
?>

<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <a href="/customer/bookings" class="mb-3 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5"></path>
                <path d="m12 19-7-7 7-7"></path>
            </svg>
            Kembali ke daftar booking
        </a>

        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-950">
            Detail Booking
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Informasi lengkap booking mesin laundry Anda.
        </p>
    </div>

    <span class="inline-flex w-fit rounded-full border px-4 py-2 text-sm font-bold <?= $statusBadgeClass ?>">
        <?= esc($statusLabel) ?>
    </span>
</div>


<div class="grid gap-6 lg:grid-cols-3">

    <!-- LEFT CONTENT -->
    <div class="space-y-6 lg:col-span-2">

        <!-- BOOKING SUMMARY -->
        <section class="overflow-hidden rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-teal-50 p-6 shadow-sm">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <!-- receipt icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3z"></path>
                            <path d="M9 8h6"></path>
                            <path d="M9 12h6"></path>
                            <path d="M9 16h4"></path>
                        </svg>
                    </div>

                    <h2 class="text-2xl font-extrabold text-slate-950">
                        <?= esc($booking['booking_code']) ?>
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Kode booking untuk transaksi laundry Anda.
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-4 shadow-sm sm:text-right">
                    <p class="text-sm text-slate-500">Total Pembayaran</p>
                    <p class="mt-1 text-2xl font-extrabold text-slate-950">
                        Rp<?= number_format($booking['total_price'], 0, ',', '.') ?>
                    </p>
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-emerald-100 bg-white p-4">
                    <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                        <!-- calendar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                            <path d="M16 3v4M8 3v4M3 10h18"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-slate-500">Tanggal & Jam Booking</p>
                    <p class="mt-1 font-bold text-slate-950">
                        <?= esc($booking['booking_date']) ?>,
                        <?= substr($booking['booking_start_time'], 0, 5) ?> WIB
                    </p>
                </div>

                <div class="rounded-2xl border border-amber-100 bg-white p-4">
                    <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                        <!-- clock -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M12 7v5l3 2"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-slate-500">Deadline Pembayaran</p>
                    <p class="mt-1 font-bold text-slate-950">
                        <?= esc($booking['payment_deadline_at']) ?> WIB
                    </p>
                </div>
            </div>
        </section>


        <!-- DETAIL MESIN -->
        <section class="rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h3 class="text-xl font-extrabold text-slate-950">Detail Mesin</h3>
                <p class="mt-1 text-sm text-slate-500">
                    Daftar mesin yang dipilih pada booking ini.
                </p>
            </div>

            <div class="space-y-4">
                <?php foreach ($machines as $m): ?>
                    <div class="rounded-[1.5rem] border border-slate-100 bg-slate-50 p-5">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                    <!-- washing machine -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                                        <path d="M8 6h.01"></path>
                                        <path d="M11 6h5"></path>
                                        <circle cx="12" cy="14" r="4"></circle>
                                        <path d="M9.5 14a3.5 3.5 0 0 0 5 0"></path>
                                    </svg>
                                </div>

                                <div>
                                    <h4 class="font-extrabold text-slate-950">
                                        <?= esc($m['machine_name_snapshot']) ?>
                                    </h4>

                                    <p class="mt-2 text-sm leading-6 text-slate-500">
                                        Durasi <?= esc((string) $m['duration_minutes']) ?> menit
                                        •
                                        <?= substr($m['machine_start_time'], 0, 5) ?> - <?= substr($m['machine_end_time'], 0, 5) ?> WIB
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tersedia lagi pukul
                                        <span class="font-semibold text-slate-700">
                                            <?= substr($m['available_again_time'], 0, 5) ?> WIB
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="rounded-2xl bg-white px-4 py-3 sm:text-right">
                                <p class="text-xs font-semibold text-slate-500">Subtotal</p>
                                <p class="mt-1 text-lg font-extrabold text-slate-950">
                                    Rp<?= number_format($m['subtotal'], 0, ',', '.') ?>
                                </p>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <!-- ADD ON -->
        <?php if (!empty($addons)): ?>
            <section class="rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
                <div class="mb-5">
                    <h3 class="text-xl font-extrabold text-slate-950">Add On</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Layanan atau produk tambahan pada booking ini.
                    </p>
                </div>

                <div class="space-y-4">
                    <?php foreach ($addons as $a): ?>
                        <div class="rounded-[1.5rem] border border-slate-100 bg-slate-50 p-5">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                <div class="flex items-start gap-4">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                        <!-- package icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                                            <path d="m3.3 7 8.7 5 8.7-5"></path>
                                            <path d="M12 22V12"></path>
                                        </svg>
                                    </div>

                                    <div>
                                        <h4 class="font-extrabold text-slate-950">
                                            <?= esc($a['addon_name_snapshot']) ?>
                                        </h4>

                                        <p class="mt-2 text-sm text-slate-500">
                                            <?= esc((string) $a['quantity']) ?> x
                                            Rp<?= number_format($a['unit_price_snapshot'], 0, ',', '.') ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="rounded-2xl bg-white px-4 py-3 sm:text-right">
                                    <p class="text-xs font-semibold text-slate-500">Subtotal</p>
                                    <p class="mt-1 text-lg font-extrabold text-slate-950">
                                        Rp<?= number_format($a['subtotal'], 0, ',', '.') ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

    </div>


    <!-- RIGHT SIDEBAR PAYMENT -->
    <aside class="lg:col-span-1">
        <div class="sticky top-5 rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">

            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <!-- payment icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                    <path d="M3 10h18"></path>
                    <path d="M7 15h3"></path>
                </svg>
            </div>

            <h3 class="text-xl font-extrabold text-slate-950">
                Pembayaran
            </h3>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Lakukan upload bukti pembayaran agar admin dapat melakukan verifikasi booking Anda.
            </p>

            <div class="my-5 border-t border-slate-100"></div>

            <div class="mb-5 rounded-2xl bg-slate-50 p-4">
                <p class="text-sm text-slate-500">Total yang harus dibayar</p>
                <p class="mt-1 text-2xl font-extrabold text-slate-950">
                    Rp<?= number_format($booking['total_price'], 0, ',', '.') ?>
                </p>
            </div>

            <?php if ($booking['booking_status'] === 'pending_payment'): ?>

                <a
                    href="/customer/payments/<?= $booking['id'] ?>/upload"
                    class="flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]">
                    Upload Bukti

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 16V8"></path>
                        <path d="M8.5 11.5 12 8l3.5 3.5"></path>
                        <path d="M20 16.5v1A2.5 2.5 0 0 1 17.5 20h-11A2.5 2.5 0 0 1 4 17.5v-1"></path>
                    </svg>
                </a>

                <div class="mt-4 rounded-2xl border border-amber-100 bg-amber-50 p-4">
                    <p class="text-xs leading-5 text-amber-700">
                        Upload bukti pembayaran maksimal
                        <b>60 menit</b>
                        setelah booking dibuat. Jika melewati batas waktu, booking dapat dibatalkan otomatis.
                    </p>
                </div>

            <?php elseif ($payment): ?>

                <div class="rounded-2xl border <?= $paymentBadgeClass ?> p-4">
                    <p class="text-sm">Status Payment</p>
                    <p class="mt-1 font-extrabold">
                        <?= esc($paymentLabel) ?>
                    </p>
                </div>

                <a
                    href="/payment-proof/<?= $payment['id'] ?>"
                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-sm font-bold text-emerald-700 transition hover:bg-emerald-100">
                    Lihat Bukti Pembayaran

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M14 3h7v7"></path>
                        <path d="M10 14 21 3"></path>
                        <path d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5"></path>
                    </svg>
                </a>

            <?php else: ?>

                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">
                        Tidak ada data pembayaran untuk booking ini.
                    </p>
                </div>

            <?php endif; ?>

        </div>
    </aside>

</div>