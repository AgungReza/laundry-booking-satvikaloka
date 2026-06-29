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

$isFinished = in_array($status, ['completed', 'cancelled', 'canceled'], true);
?>

<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <a href="/admin/bookings" class="mb-3 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5"></path>
                <path d="m12 19-7-7 7-7"></path>
            </svg>
            Kembali ke daftar booking
        </a>

        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-950">
            Detail Booking Admin
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Kelola detail booking, pembayaran, dan status transaksi customer.
        </p>
    </div>

    <span class="inline-flex w-fit rounded-full border px-4 py-2 text-sm font-bold <?= $statusBadgeClass ?>">
        <?= esc($statusLabel) ?>
    </span>
</div>


<div class="grid gap-6 lg:grid-cols-3">

    <!-- KONTEN UTAMA -->
    <div class="space-y-6 lg:col-span-2">

        <!-- RINGKASAN BOOKING -->
        <section class="overflow-hidden rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-teal-50 p-6 shadow-sm">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <!-- receipt -->
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
                        Kode booking customer untuk transaksi laundry.
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
                        <!-- user -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 21a8 8 0 0 1 16 0"></path>
                        </svg>
                    </div>

                    <p class="text-sm text-slate-500">Customer</p>
                    <p class="mt-1 font-bold text-slate-950">
                        <?= esc($booking['customer_name']) ?>
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        <?= esc($booking['phone'] ?: '-') ?>
                    </p>
                </div>

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
            </div>
        </section>


        <!-- DETAIL MESIN -->
        <section class="rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
            <div class="mb-5 flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <!-- washing machine -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                        <path d="M8 6h.01"></path>
                        <path d="M11 6h5"></path>
                        <circle cx="12" cy="14" r="4"></circle>
                    </svg>
                </div>

                <div>
                    <h3 class="text-xl font-extrabold text-slate-950">Mesin yang Dibooking</h3>
                    <p class="text-sm text-slate-500">Detail mesin, jam pakai, dan subtotal.</p>
                </div>
            </div>

            <div class="space-y-4">
                <?php if (empty($machines)): ?>

                    <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-center text-sm text-slate-500">
                        Tidak ada data mesin.
                    </div>

                <?php else: ?>

                    <?php foreach ($machines as $m): ?>
                        <div class="rounded-[1.5rem] border border-slate-100 bg-slate-50 p-5">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div class="flex items-start gap-4">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                                            <path d="M8 6h.01"></path>
                                            <path d="M11 6h5"></path>
                                            <circle cx="12" cy="14" r="4"></circle>
                                        </svg>
                                    </div>

                                    <div>
                                        <h4 class="font-extrabold text-slate-950">
                                            <?= esc($m['machine_name_snapshot']) ?>
                                        </h4>

                                        <p class="mt-2 text-sm leading-6 text-slate-500">
                                            Jam pakai:
                                            <span class="font-semibold text-slate-700">
                                                <?= substr($m['machine_start_time'], 0, 5) ?> - <?= substr($m['machine_end_time'], 0, 5) ?> WIB
                                            </span>
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Tersedia lagi:
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

                <?php endif; ?>
            </div>
        </section>


        <!-- ADD ON -->
        <?php if (!empty($addons)): ?>
            <section class="rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <!-- package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                            <path d="m3.3 7 8.7 5 8.7-5"></path>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-extrabold text-slate-950">Add On</h3>
                        <p class="text-sm text-slate-500">Layanan tambahan yang dipilih customer.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <?php foreach ($addons as $a): ?>
                        <div class="rounded-[1.5rem] border border-slate-100 bg-slate-50 p-5">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <h4 class="font-extrabold text-slate-950">
                                        <?= esc($a['addon_name_snapshot']) ?>
                                    </h4>

                                    <p class="mt-2 text-sm text-slate-500">
                                        <?= esc((string) $a['quantity']) ?> x
                                        Rp<?= number_format($a['unit_price_snapshot'], 0, ',', '.') ?>
                                    </p>
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


    <!-- SIDEBAR AKSI -->
    <aside class="lg:col-span-1">
        <div class="sticky top-24 space-y-6">

            <!-- PAYMENT CARD -->
            <section class="rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <!-- payment -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                        <path d="M3 10h18"></path>
                        <path d="M7 15h3"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-extrabold text-slate-950">Pembayaran</h3>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Informasi status pembayaran dan bukti transfer customer.
                </p>

                <div class="my-5 border-t border-slate-100"></div>

                <?php if ($payment): ?>

                    <div class="rounded-2xl border <?= $paymentBadgeClass ?> p-4">
                        <p class="text-sm">Status Payment</p>
                        <p class="mt-1 font-extrabold">
                            <?= esc($paymentLabel) ?>
                        </p>
                    </div>

                    <a
                        href="/payment-proof/<?= $payment['id'] ?>"
                        class="mt-4 flex w-full items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-sm font-bold text-emerald-700 transition hover:bg-emerald-100"
                    >
                        Lihat Bukti

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M14 3h7v7"></path>
                            <path d="M10 14 21 3"></path>
                            <path d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5"></path>
                        </svg>
                    </a>

                <?php else: ?>

                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">
                            Belum ada data pembayaran.
                        </p>
                    </div>

                <?php endif; ?>
            </section>


            <!-- ACTION CARD -->
            <section class="rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
                    <!-- setting/action -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                        <path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.6-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3h.1a1.7 1.7 0 0 0 1-1.6V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.6h.1a1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9v.1a1.7 1.7 0 0 0 1.6 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-extrabold text-slate-950">Aksi Booking</h3>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Gunakan aksi ini untuk menyelesaikan atau membatalkan booking.
                </p>

                <div class="my-5 border-t border-slate-100"></div>

                <?php if ($isFinished): ?>

                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">
                            Booking ini sudah berada pada status akhir sehingga aksi tidak tersedia.
                        </p>
                    </div>

                <?php else: ?>

                    <form
                        method="post"
                        action="/admin/bookings/<?= $booking['id'] ?>/complete"
                        onsubmit="return confirm('Tandai booking ini sebagai selesai?')"
                    >
                        <?= csrf_field() ?>

                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]"
                        >
                            Tandai Selesai

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="m9 12 2 2 4-4"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg>
                        </button>
                    </form>

                    <form
                        method="post"
                        action="/admin/bookings/<?= $booking['id'] ?>/cancel"
                        class="mt-4"
                        onsubmit="return confirm('Batalkan booking ini?')"
                    >
                        <?= csrf_field() ?>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Alasan Pembatalan
                        </label>

                        <textarea
                            name="cancel_reason"
                            rows="3"
                            placeholder="Contoh: Customer tidak melakukan pembayaran."
                            class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-3 text-sm outline-none transition focus:border-red-300 focus:bg-white focus:ring-4 focus:ring-red-100"
                        ></textarea>

                        <button
                            type="submit"
                            class="mt-3 flex w-full items-center justify-center gap-2 rounded-2xl bg-red-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-red-200 transition hover:bg-red-600 active:scale-[0.98]"
                        >
                            Batalkan Booking

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M6 18 18 6"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </form>

                <?php endif; ?>
            </section>

        </div>
    </aside>

</div>