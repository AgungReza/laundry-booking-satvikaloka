<?php
$totalMachines = (int) ($totalMachines ?? 0);
$activeBookings = (int) ($activeBookings ?? 0);
$pendingPayments = (int) ($pendingPayments ?? 0);
$customers = is_array($customers ?? null) ? count($customers) : (int) ($customers ?? 0);

$needAttention = $activeBookings + $pendingPayments;
?>

<!-- WELCOME / MONITORING HEADER -->
<div class="mb-6 overflow-hidden rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-teal-50 p-6 shadow-sm">
    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white/80 px-4 py-2 text-xs font-bold text-emerald-700 shadow-sm">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                Monitoring Operasional Wish Laundry
            </div>

            <h2 class="text-2xl sm:text-3xl font-extrabold leading-tight text-slate-950">
                Ringkasan cepat operasional hari ini
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                Pantau mesin, booking aktif, pembayaran yang perlu diverifikasi,
                dan jumlah customer dari satu halaman dashboard admin.
            </p>
        </div>

        <div class="rounded-3xl bg-white p-5 shadow-sm">
            <p class="text-sm font-semibold text-slate-500">Perlu Perhatian</p>

            <div class="mt-2 flex items-end gap-2">
                <p class="text-4xl font-extrabold <?= $needAttention > 0 ? 'text-amber-600' : 'text-emerald-600' ?>">
                    <?= $needAttention ?>
                </p>
                <p class="mb-1 text-sm text-slate-500">item</p>
            </div>

            <p class="mt-2 text-xs leading-5 text-slate-500">
                <?= $needAttention > 0
                    ? 'Ada booking atau pembayaran yang perlu dicek admin.'
                    : 'Tidak ada notifikasi penting saat ini.' ?>
            </p>
        </div>
    </div>
</div>


<!-- NOTIFIKASI PRIORITAS -->
<div class="mb-6 grid gap-4 lg:grid-cols-2">

    <?php if ($pendingPayments > 0): ?>
        <a
            href="/admin/payments"
            class="group rounded-[2rem] border border-amber-100 bg-amber-50 p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-amber-600 shadow-sm">
                    <!-- clock/payment icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="font-extrabold text-amber-900">
                            Verifikasi Pembayaran
                        </h3>

                        <span class="rounded-full bg-white px-3 py-1 text-xs font-extrabold text-amber-700">
                            <?= $pendingPayments ?> pending
                        </span>
                    </div>

                    <p class="mt-2 text-sm leading-6 text-amber-800">
                        Ada pembayaran customer yang menunggu pengecekan bukti transfer.
                        Klik untuk membuka halaman verifikasi pembayaran.
                    </p>
                </div>
            </div>
        </a>
    <?php else: ?>
        <div class="rounded-[2rem] border border-emerald-100 bg-emerald-50 p-5 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-emerald-600 shadow-sm">
                    <!-- check icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </div>

                <div>
                    <h3 class="font-extrabold text-emerald-900">
                        Pembayaran Aman
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-emerald-800">
                        Tidak ada pembayaran pending yang perlu diverifikasi saat ini.
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <?php if ($activeBookings > 0): ?>
        <a
            href="/admin/bookings"
            class="group rounded-[2rem] border border-blue-100 bg-blue-50 p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-blue-600 shadow-sm">
                    <!-- calendar icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                        <path d="M16 3v4M8 3v4M3 10h18"></path>
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="font-extrabold text-blue-900">
                            Booking Aktif
                        </h3>

                        <span class="rounded-full bg-white px-3 py-1 text-xs font-extrabold text-blue-700">
                            <?= $activeBookings ?> aktif
                        </span>
                    </div>

                    <p class="mt-2 text-sm leading-6 text-blue-800">
                        Ada booking mesin yang sedang berjalan atau belum selesai.
                        Pantau status booking agar operasional tetap aman.
                    </p>
                </div>
            </div>
        </a>
    <?php else: ?>
        <div class="rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-600">
                    <!-- calendar check icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                        <path d="M16 3v4M8 3v4M3 10h18"></path>
                        <path d="m9 15 2 2 4-4"></path>
                    </svg>
                </div>

                <div>
                    <h3 class="font-extrabold text-slate-950">
                        Tidak Ada Booking Aktif
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Belum ada booking yang perlu dipantau saat ini.
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>


<!-- RINGKASAN UTAMA -->
<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">

    <!-- TOTAL MESIN -->
    <a
        href="/admin/machines"
        class="group rounded-[2rem] border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 transition group-hover:bg-emerald-500 group-hover:text-white">
            <!-- machine icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                <path d="M8 6h.01"></path>
                <path d="M11 6h5"></path>
                <circle cx="12" cy="14" r="4"></circle>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Total Mesin</p>
        <p class="mt-2 text-3xl font-extrabold text-slate-950">
            <?= $totalMachines ?>
        </p>

        <p class="mt-2 text-xs leading-5 text-slate-500">
            Jumlah seluruh mesin laundry yang terdaftar di sistem.
        </p>
    </a>


    <!-- BOOKING AKTIF -->
    <a
        href="/admin/bookings"
        class="group rounded-[2rem] border <?= $activeBookings > 0 ? 'border-blue-100 bg-blue-50' : 'border-slate-100 bg-white' ?> p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl <?= $activeBookings > 0 ? 'bg-white text-blue-600' : 'bg-slate-100 text-slate-600' ?>">
            <!-- booking icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                <path d="M16 3v4M8 3v4M3 10h18"></path>
            </svg>
        </div>

        <div class="flex items-center justify-between gap-3">
            <p class="text-sm font-semibold text-slate-500">Booking Aktif</p>

            <?php if ($activeBookings > 0): ?>
                <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-extrabold text-blue-700">
                    Perlu dipantau
                </span>
            <?php endif; ?>
        </div>

        <p class="mt-2 text-3xl font-extrabold text-slate-950">
            <?= $activeBookings ?>
        </p>

        <p class="mt-2 text-xs leading-5 text-slate-500">
            Booking yang masih berjalan, belum selesai, atau sedang menunggu proses.
        </p>
    </a>


    <!-- PAYMENT PENDING -->
    <a
        href="/admin/payments"
        class="group rounded-[2rem] border <?= $pendingPayments > 0 ? 'border-amber-100 bg-amber-50' : 'border-slate-100 bg-white' ?> p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl <?= $pendingPayments > 0 ? 'bg-white text-amber-600' : 'bg-slate-100 text-slate-600' ?>">
            <!-- payment icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                <path d="M3 10h18"></path>
                <path d="M7 15h3"></path>
            </svg>
        </div>

        <div class="flex items-center justify-between gap-3">
            <p class="text-sm font-semibold text-slate-500">Payment Pending</p>

            <?php if ($pendingPayments > 0): ?>
                <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-extrabold text-amber-700">
                    Cek bukti
                </span>
            <?php endif; ?>
        </div>

        <p class="mt-2 text-3xl font-extrabold text-slate-950">
            <?= $pendingPayments ?>
        </p>

        <p class="mt-2 text-xs leading-5 text-slate-500">
            Pembayaran customer yang masih menunggu verifikasi admin.
        </p>
    </a>


    <!-- CUSTOMER -->
    <div class="rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
            <!-- user icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 21a8 8 0 0 1 16 0"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Customer</p>
        <p class="mt-2 text-3xl font-extrabold text-slate-950">
            <?= $customers ?>
        </p>

        <p class="mt-2 text-xs leading-5 text-slate-500">
            Jumlah customer yang terdaftar atau pernah melakukan booking.
        </p>
    </div>

</div>


<!-- QUICK ACTION -->
<div class="mt-6 rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
    <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-lg font-extrabold text-slate-950">Akses Cepat Admin</h3>
            <p class="mt-1 text-sm text-slate-500">
                Gunakan menu cepat berikut untuk menindaklanjuti aktivitas operasional.
            </p>
        </div>
    </div>

    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <a
            href="/admin/bookings"
            class="rounded-2xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm font-bold text-blue-700 transition hover:bg-blue-100">
            Lihat Booking
        </a>

        <a
            href="/admin/payments"
            class="rounded-2xl border border-amber-100 bg-amber-50 px-4 py-3 text-sm font-bold text-amber-700 transition hover:bg-amber-100">
            Verifikasi Pembayaran
        </a>

        <a
            href="/admin/machines"
            class="rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700 transition hover:bg-emerald-100">
            Kelola Mesin
        </a>

        <a
            href="/admin/reports"
            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-100">
            Lihat Laporan
        </a>
    </div>
</div>