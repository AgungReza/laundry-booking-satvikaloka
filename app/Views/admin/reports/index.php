<?php
$income = (int) ($summary['income'] ?? 0);
$expense = (int) ($summary['expense'] ?? 0);
$profit = (int) ($summary['profit'] ?? 0);
$pendingPayments = (int) ($summary['pending_payments'] ?? 0);
$activeBookings = (int) ($summary['active_bookings'] ?? 0);

$profitMargin = $income > 0 ? round(($profit / $income) * 100, 1) : 0;

$isProfit = $profit >= 0;
$profitStatusText = $isProfit ? 'Laba' : 'Rugi';
$profitStatusClass = $isProfit
    ? 'border-emerald-100 bg-emerald-50 text-emerald-700'
    : 'border-red-100 bg-red-50 text-red-700';
?>

<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-950">Laporan Keuangan</h1>
        <p class="mt-1 text-sm text-slate-500">
            Pantau pendapatan, pengeluaran, laba bersih, pembayaran pending, dan booking aktif.
        </p>
    </div>

    <div class="inline-flex w-fit items-center gap-2 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-2 text-sm font-bold text-emerald-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M4 19V5"></path>
            <path d="M4 19h16"></path>
            <path d="M8 16v-5"></path>
            <path d="M12 16V8"></path>
            <path d="M16 16v-3"></path>
        </svg>
        Ringkasan Bisnis
    </div>
</div>


<!-- FILTER -->
<form method="get" class="mb-6 overflow-hidden rounded-[2rem] border border-slate-100 bg-white shadow-sm">

    <div class="border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-white p-5">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                    <path d="M16 3v4M8 3v4M3 10h18"></path>
                </svg>
            </div>

            <div>
                <h2 class="font-extrabold text-slate-950">Filter Periode Laporan</h2>
                <p class="text-sm text-slate-500">
                    Pilih rentang tanggal untuk melihat laporan sesuai periode tertentu.
                </p>
            </div>
        </div>
    </div>

    <div class="grid gap-4 p-5 md:grid-cols-[1fr_1fr_auto] md:items-end">
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">
                Tanggal Mulai
            </label>

            <input
                type="date"
                name="start_date"
                value="<?= esc($summary['start_date']) ?>"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
        </div>

        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">
                Tanggal Akhir
            </label>

            <input
                type="date"
                name="end_date"
                value="<?= esc($summary['end_date']) ?>"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
        </div>

        <button
            type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]">
            Filter Laporan

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M22 3H2l8 9.5V20l4 2v-9.5L22 3z"></path>
            </svg>
        </button>
    </div>
</form>


<!-- PERIODE INFO -->
<div class="mb-6 rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-teal-50 p-5 shadow-sm">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-slate-500">Periode laporan aktif</p>
            <h2 class="mt-1 text-xl font-extrabold text-slate-950">
                <?= esc($summary['start_date']) ?> sampai <?= esc($summary['end_date']) ?>
            </h2>
        </div>

        <span class="inline-flex w-fit rounded-full border px-4 py-2 text-sm font-bold <?= $profitStatusClass ?>">
            Status: <?= $profitStatusText ?>
        </span>
    </div>
</div>


<!-- SUMMARY CARDS -->
<div class="mb-6 grid gap-4 md:grid-cols-2 xl:grid-cols-5">

    <!-- PENDAPATAN -->
    <div class="rounded-[2rem] border border-emerald-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 1v22"></path>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Pendapatan</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            Rp<?= number_format($income, 0, ',', '.') ?>
        </p>
        <p class="mt-2 text-xs leading-5 text-slate-500">
            Total pemasukan dari pembayaran booking yang masuk pada periode ini.
        </p>
    </div>


    <!-- PENGELUARAN -->
    <div class="rounded-[2rem] border border-red-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 1v22"></path>
                <path d="M17 19H9.5a3.5 3.5 0 0 1 0-7H14a3.5 3.5 0 0 0 0-7H6"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Pengeluaran</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            Rp<?= number_format($expense, 0, ',', '.') ?>
        </p>
        <p class="mt-2 text-xs leading-5 text-slate-500">
            Total biaya operasional yang dicatat pada periode laporan ini.
        </p>
    </div>


    <!-- LABA BERSIH -->
    <div class="rounded-[2rem] border <?= $isProfit ? 'border-emerald-100' : 'border-red-100' ?> bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl <?= $isProfit ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M4 19V5"></path>
                <path d="M4 19h16"></path>
                <path d="M8 16v-5"></path>
                <path d="M12 16V8"></path>
                <path d="M16 16v-3"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Laba Bersih</p>
        <p class="mt-2 text-2xl font-extrabold <?= $isProfit ? 'text-emerald-600' : 'text-red-600' ?>">
            Rp<?= number_format($profit, 0, ',', '.') ?>
        </p>
        <p class="mt-2 text-xs leading-5 text-slate-500">
            Pendapatan dikurangi pengeluaran pada periode yang dipilih.
        </p>
    </div>


    <!-- PAYMENT PENDING -->
    <div class="rounded-[2rem] border border-amber-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 7v5l3 2"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Payment Pending</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            <?= $pendingPayments ?>
        </p>
        <p class="mt-2 text-xs leading-5 text-slate-500">
            Pembayaran yang masih perlu dicek atau diverifikasi admin.
        </p>
    </div>


    <!-- BOOKING AKTIF -->
    <div class="rounded-[2rem] border border-blue-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                <path d="M16 3v4M8 3v4M3 10h18"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Booking Aktif</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            <?= $activeBookings ?>
        </p>
        <p class="mt-2 text-xs leading-5 text-slate-500">
            Booking yang masih berjalan atau belum selesai.
        </p>
    </div>

</div>


<!-- DETAIL ANALISIS -->
<div class="grid gap-6 lg:grid-cols-3">

    <!-- ANALISIS KEUANGAN -->
    <div class="lg:col-span-2 rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M4 19V5"></path>
                    <path d="M4 19h16"></path>
                    <path d="M8 16v-5"></path>
                    <path d="M12 16V8"></path>
                    <path d="M16 16v-3"></path>
                </svg>
            </div>

            <div>
                <h2 class="font-extrabold text-slate-950">Analisis Singkat</h2>
                <p class="text-sm text-slate-500">
                    Ringkasan kondisi laporan berdasarkan angka periode ini.
                </p>
            </div>
        </div>

        <div class="space-y-4">

            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-bold text-slate-950">Margin Laba</p>
                        <p class="mt-1 text-sm text-slate-500">
                            Persentase laba bersih dibandingkan total pendapatan.
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full border <?= $profitMargin >= 20 ? 'border-emerald-100 bg-emerald-50 text-emerald-700' : 'border-amber-100 bg-amber-50 text-amber-700' ?> px-4 py-2 text-sm font-extrabold">
                        <?= $profitMargin ?>%
                    </span>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-bold text-slate-950">Rasio Pengeluaran</p>
                        <p class="mt-1 text-sm text-slate-500">
                            Perbandingan pengeluaran terhadap pendapatan.
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-extrabold text-slate-700">
                        <?= $income > 0 ? round(($expense / $income) * 100, 1) : 0 ?>%
                    </span>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                <p class="font-bold text-slate-950">Kesimpulan</p>

                <?php if ($income <= 0): ?>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Belum ada pendapatan yang tercatat pada periode ini. Periksa apakah belum ada pembayaran yang disetujui atau periode filter terlalu sempit.
                    </p>
                <?php elseif ($profit < 0): ?>
                    <p class="mt-2 text-sm leading-6 text-red-600">
                        Pengeluaran lebih besar dari pendapatan. Perlu evaluasi biaya operasional pada periode ini.
                    </p>
                <?php elseif ($pendingPayments > 0): ?>
                    <p class="mt-2 text-sm leading-6 text-amber-700">
                        Bisnis masih mencatat laba, tetapi ada pembayaran pending yang perlu segera diverifikasi agar laporan lebih akurat.
                    </p>
                <?php else: ?>
                    <p class="mt-2 text-sm leading-6 text-emerald-700">
                        Kondisi laporan terlihat baik. Pendapatan lebih besar dari pengeluaran dan tidak ada pembayaran pending.
                    </p>
                <?php endif; ?>
            </div>

        </div>
    </div>


    <!-- TO DO ADMIN -->
    <div class="rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
        <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M9 11l3 3L22 4"></path>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
        </div>

        <h2 class="font-extrabold text-slate-950">Prioritas Admin</h2>
        <p class="mt-1 text-sm text-slate-500">
            Hal yang perlu diperhatikan berdasarkan laporan.
        </p>

        <div class="mt-5 space-y-3">
            <div class="rounded-2xl border border-amber-100 bg-amber-50 p-4">
                <p class="text-sm font-bold text-amber-800">
                    Verifikasi Pembayaran
                </p>
                <p class="mt-1 text-sm text-amber-700">
                    Ada <?= $pendingPayments ?> payment pending yang perlu dicek.
                </p>
            </div>

            <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4">
                <p class="text-sm font-bold text-blue-800">
                    Pantau Booking Aktif
                </p>
                <p class="mt-1 text-sm text-blue-700">
                    Ada <?= $activeBookings ?> booking aktif yang perlu dipantau.
                </p>
            </div>

            <div class="rounded-2xl border <?= $isProfit ? 'border-emerald-100 bg-emerald-50' : 'border-red-100 bg-red-50' ?> p-4">
                <p class="text-sm font-bold <?= $isProfit ? 'text-emerald-800' : 'text-red-800' ?>">
                    Kondisi Profit
                </p>
                <p class="mt-1 text-sm <?= $isProfit ? 'text-emerald-700' : 'text-red-700' ?>">
                    Periode ini berstatus <?= strtolower($profitStatusText) ?> sebesar Rp<?= number_format(abs($profit), 0, ',', '.') ?>.
                </p>
            </div>
        </div>
    </div>

</div>