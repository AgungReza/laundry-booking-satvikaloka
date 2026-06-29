<!-- HEADER ACTION -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-950">Daftar Booking</h1>
        <p class="mt-1 text-sm text-slate-500">
            Lihat riwayat dan status booking mesin laundry Anda.
        </p>
    </div>

    <a
        href="/customer/bookings/create"
        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]">
        Booking Baru

        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14"></path>
            <path d="M5 12h14"></path>
        </svg>
    </a>
</div>


<!-- BOOKING LIST -->
<div class="space-y-4">
    <?php if (empty($bookings)): ?>

        <div class="rounded-[2rem] border border-dashed border-emerald-200 bg-white p-8 text-center shadow-sm">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <!-- calendar icon -->
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
                Anda belum memiliki riwayat booking mesin laundry.
            </p>

            <a
                href="/customer/bookings/create"
                class="mt-5 inline-flex items-center justify-center rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600">
                Buat Booking Pertama
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
                class="group block rounded-[1.5rem] border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 transition group-hover:bg-emerald-500 group-hover:text-white">
                            <!-- receipt icon -->
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