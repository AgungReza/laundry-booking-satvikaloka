<?php
$totalBookings = count($bookings ?? []);
?>

<!-- HERO SECTION -->
<div class="relative overflow-hidden rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-teal-50 p-6 sm:p-8 mb-8 shadow-sm">

    <!-- background grid -->
    <div
        class="absolute inset-0 opacity-50"
        style="background-image: linear-gradient(to right, rgba(15,23,42,0.04) 1px, transparent 1px), linear-gradient(to bottom, rgba(15,23,42,0.04) 1px, transparent 1px); background-size: 32px 32px;">
    </div>

    <div class="relative z-10 grid gap-8 lg:grid-cols-[1.4fr_.8fr] lg:items-center">

        <!-- LEFT CONTENT -->
        <div>
            <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white/80 px-4 py-2 text-xs font-bold text-emerald-700 shadow-sm">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                Self laundry dengan sistem booking mesin
            </div>

            <h2 class="max-w-2xl text-3xl sm:text-4xl font-extrabold leading-tight tracking-tight text-slate-950">
                Selamat datang di
                <span class="text-emerald-500">Wish Laundry</span>
            </h2>

            <p class="mt-4 max-w-2xl text-sm sm:text-base leading-7 text-slate-600">
                Buat booking mesin laundry, pilih tanggal dan jam kedatangan,
                upload bukti pembayaran, lalu tunggu verifikasi dari admin.
            </p>

            <div class="mt-7 flex flex-wrap gap-3">
                <a
                    href="/customer/bookings/create"
                    class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]">
                    Buat Booking

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14"></path>
                        <path d="m13 6 6 6-6 6"></path>
                    </svg>
                </a>

                <a
                    href="#booking-terbaru"
                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:border-emerald-300 hover:text-emerald-700">
                    Lihat Booking
                </a>
            </div>
        </div>

        <!-- RIGHT CARD -->
        <div class="rounded-3xl border border-emerald-100 bg-white/90 p-5 shadow-sm backdrop-blur">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <!-- washing machine icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                    <path d="M8 6h.01"></path>
                    <path d="M11 6h5"></path>
                    <circle cx="12" cy="14" r="4"></circle>
                    <path d="M9.5 14a3.5 3.5 0 0 0 5 0"></path>
                </svg>
            </div>

            <h3 class="text-lg font-extrabold text-slate-950">
                Booking Lebih Mudah
            </h3>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Cek mesin tersedia secara cepat dan amankan jadwal laundry sebelum datang ke lokasi.
            </p>

            <div class="mt-5 grid grid-cols-2 gap-3">
                <div class="rounded-2xl bg-emerald-50 p-4">
                    <p class="text-2xl font-extrabold text-slate-950"><?= $totalBookings ?></p>
                    <p class="mt-1 text-xs font-medium text-slate-500">Total Booking</p>
                </div>

                <div class="rounded-2xl bg-teal-50 p-4">
                    <p class="text-2xl font-extrabold text-slate-950">60</p>
                    <p class="mt-1 text-xs font-medium text-slate-500">Menit Upload</p>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- QUICK INFO -->
<div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

    <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <!-- calendar -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                <path d="M16 3v4M8 3v4M3 10h18"></path>
            </svg>
        </div>
        <h3 class="font-extrabold text-slate-950">Pilih Jadwal</h3>
        <p class="mt-1 text-sm text-slate-500">Tanggal dan jam kedatangan.</p>
    </div>

    <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <!-- clock -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 7v5l3 2"></path>
            </svg>
        </div>
        <h3 class="font-extrabold text-slate-950">Pilih Durasi</h3>
        <p class="mt-1 text-sm text-slate-500">Sesuaikan kebutuhan laundry.</p>
    </div>

    <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <!-- upload -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 16V8"></path>
                <path d="M8.5 11.5 12 8l3.5 3.5"></path>
                <path d="M20 16.5v1A2.5 2.5 0 0 1 17.5 20h-11A2.5 2.5 0 0 1 4 17.5v-1"></path>
            </svg>
        </div>
        <h3 class="font-extrabold text-slate-950">Upload Bukti</h3>
        <p class="mt-1 text-sm text-slate-500">Kirim bukti pembayaran.</p>
    </div>

    <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <!-- shield -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 3l7 3v6c0 5-3.5 8-7 9-3.5-1-7-4-7-9V6l7-3z"></path>
                <path d="m9.5 12 1.8 1.8L15 10.2"></path>
            </svg>
        </div>
        <h3 class="font-extrabold text-slate-950">Verifikasi</h3>
        <p class="mt-1 text-sm text-slate-500">Admin cek pembayaran.</p>
    </div>

</div>


<!-- BOOKING TERBARU -->
<div id="booking-terbaru" class="mb-4 flex items-center justify-between gap-4">
    <div>
        <h2 class="text-xl font-extrabold text-slate-950">Booking Terbaru</h2>
        <p class="mt-1 text-sm text-slate-500">Riwayat booking mesin laundry Anda.</p>
    </div>

    <a href="/customer/bookings/create" class="hidden sm:inline-flex rounded-full bg-emerald-50 px-4 py-2 text-sm font-bold text-emerald-700 transition hover:bg-emerald-100">
        + Booking Baru
    </a>
</div>

<div class="space-y-4">
    <?php if (empty($bookings)): ?>

        <div class="rounded-3xl border border-dashed border-emerald-200 bg-white p-8 text-center shadow-sm">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <!-- empty calendar -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                    <path d="M16 3v4M8 3v4M3 10h18"></path>
                    <path d="M9 15h6"></path>
                </svg>
            </div>

            <h3 class="text-lg font-extrabold text-slate-950">
                Belum ada booking
            </h3>

            <p class="mt-2 text-sm text-slate-500">
                Silakan buat booking mesin laundry pertama Anda.
            </p>

            <a href="/customer/bookings/create" class="mt-5 inline-flex rounded-full bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600">
                Buat Booking
            </a>
        </div>

    <?php else: ?>

        <?php foreach ($bookings as $b): ?>
            <?php
            $status = strtolower($b['booking_status'] ?? '');

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

            $badgeClass = $statusClasses[$status] ?? 'bg-slate-50 text-slate-700 border-slate-100';
            $statusLabel = ucwords(str_replace('_', ' ', $b['booking_status'] ?? '-'));
            ?>

            <a
                href="/customer/bookings/<?= $b['id'] ?>"
                class="group block rounded-3xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 transition group-hover:bg-emerald-500 group-hover:text-white">
                            <!-- receipt -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3z"></path>
                                <path d="M9 8h6"></path>
                                <path d="M9 12h6"></path>
                                <path d="M9 16h4"></path>
                            </svg>
                        </div>

                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <h3 class="font-extrabold text-slate-950">
                                    <?= esc($b['booking_code']) ?>
                                </h3>

                                <span class="inline-flex rounded-full border px-3 py-1 text-xs font-bold <?= $badgeClass ?>">
                                    <?= esc($statusLabel) ?>
                                </span>
                            </div>

                            <p class="mt-2 text-sm text-slate-500">
                                <?= esc($b['booking_date']) ?>
                                •
                                <?= substr($b['booking_start_time'], 0, 5) ?> WIB
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-4 sm:block sm:text-right">
                        <p class="text-sm text-slate-500">Total Bayar</p>
                        <p class="mt-1 text-lg font-extrabold text-slate-950">
                            Rp<?= number_format($b['total_price'], 0, ',', '.') ?>
                        </p>
                    </div>

                </div>
            </a>

        <?php endforeach; ?>

    <?php endif; ?>
</div>