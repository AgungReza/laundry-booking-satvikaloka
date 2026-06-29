<!-- PAGE HEADER -->
<div class="mb-6 overflow-hidden rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-teal-50 p-6 sm:p-8 shadow-sm">

    <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white/80 px-4 py-2 text-xs font-bold text-emerald-700 shadow-sm">
        <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
        Booking mesin Wish Laundry
    </div>

    <div class="grid gap-6 lg:grid-cols-[1.4fr_.7fr] lg:items-center">
        <div>
            <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight tracking-tight text-slate-950">
                Pilih jadwal dan mesin laundry
                <span class="text-emerald-500">sesuai kebutuhan Anda.</span>
            </h1>

            <p class="mt-4 max-w-2xl text-sm sm:text-base leading-7 text-slate-600">
                Tentukan tanggal kedatangan, jam mulai, pilih mesin yang tersedia,
                tambahkan add-on jika diperlukan, lalu konfirmasi booking.
            </p>
        </div>

        <div class="rounded-3xl border border-emerald-100 bg-white p-5 shadow-sm">
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

            <h3 class="font-extrabold text-slate-950">Cek Mesin Real-time</h3>
            <p class="mt-2 text-sm leading-6 text-slate-500">
                Mesin yang sedang dipakai akan otomatis ditandai tidak tersedia.
            </p>
        </div>
    </div>
</div>


<!-- FILTER CEK MESIN -->
<form method="get" class="mb-8 rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
    <div class="mb-4">
        <h2 class="text-lg font-extrabold text-slate-950">Cek Ketersediaan Mesin</h2>
        <p class="mt-1 text-sm text-slate-500">
            Pilih tanggal dan jam kedatangan terlebih dahulu.
        </p>
    </div>

    <div class="grid gap-4 md:grid-cols-[1fr_1fr_auto] md:items-end">

        <div>
            <label for="booking_date" class="mb-2 block text-sm font-semibold text-slate-700">
                Tanggal Booking
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <!-- calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                        <path d="M16 3v4M8 3v4M3 10h18"></path>
                    </svg>
                </span>

                <input
                    id="booking_date"
                    type="date"
                    name="booking_date"
                    value="<?= esc($date) ?>"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>
        </div>

        <div>
            <label for="booking_start_time" class="mb-2 block text-sm font-semibold text-slate-700">
                Jam Mulai
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <!-- clock -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                </span>

                <input
                    id="booking_start_time"
                    type="time"
                    name="booking_start_time"
                    value="<?= esc(substr($startTime, 0, 5)) ?>"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>
        </div>

        <button
            type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-950 px-6 py-3.5 text-sm font-bold text-white transition hover:bg-emerald-600 active:scale-[0.98]">
            Cek Mesin

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14"></path>
                <path d="m13 6 6 6-6 6"></path>
            </svg>
        </button>

    </div>
</form>


<form method="post" action="/customer/bookings" class="space-y-8">
    <?= csrf_field() ?>

    <input type="hidden" name="booking_date" value="<?= esc($date) ?>">
    <input type="hidden" name="booking_start_time" value="<?= esc(substr($startTime, 0, 5)) ?>">

    <!-- PILIH MESIN -->
    <section>
        <div class="mb-4 flex items-end justify-between gap-4">
            <div>
                <h2 class="text-xl font-extrabold text-slate-950">Pilih Mesin</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Centang mesin yang ingin digunakan, lalu pilih durasinya.
                </p>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <?php if (empty($machines)): ?>

                <div class="md:col-span-2 rounded-3xl border border-dashed border-emerald-200 bg-white p-8 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <!-- search icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="m20 20-3.5-3.5"></path>
                        </svg>
                    </div>

                    <h3 class="text-lg font-extrabold text-slate-950">
                        Belum ada mesin tersedia
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Silakan cek tanggal atau jam booking lainnya.
                    </p>
                </div>

            <?php else: ?>

                <?php foreach ($machines as $m): ?>
                    <?php
                    $isAvailable = $m['dynamic_status'] === 'available';
                    $min = (int) $m['minimum_duration_minutes'];
                    $step = (int) $m['duration_step_minutes'];
                    $max = (int) ($m['max_duration_minutes'] ?: 180);
                    ?>

                    <label class="group relative block cursor-pointer">
                        <input
                            type="checkbox"
                            name="machine_ids[]"
                            value="<?= $m['id'] ?>"
                            <?= $isAvailable ? '' : 'disabled' ?>
                            class="peer sr-only">

                        <div class="rounded-[1.5rem] border bg-white p-5 shadow-sm transition
                            <?= $isAvailable ? 'border-slate-100 hover:border-emerald-200 hover:shadow-md peer-checked:border-emerald-400 peer-checked:ring-4 peer-checked:ring-emerald-100' : 'border-slate-100 opacity-60' ?>">

                            <div class="flex items-start gap-4">

                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl
                                    <?= $isAvailable ? 'bg-emerald-100 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white peer-checked:bg-emerald-500 peer-checked:text-white' : 'bg-slate-100 text-slate-400' ?>">
                                    <!-- machine icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                                        <path d="M8 6h.01"></path>
                                        <path d="M11 6h5"></path>
                                        <circle cx="12" cy="14" r="4"></circle>
                                        <path d="M9.5 14a3.5 3.5 0 0 0 5 0"></path>
                                    </svg>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-start justify-between gap-3">
                                        <div>
                                            <h3 class="font-extrabold text-slate-950">
                                                <?= esc($m['name']) ?>
                                            </h3>

                                            <p class="mt-1 text-sm text-slate-500">
                                                <?= esc($m['code']) ?>
                                                •
                                                <?= esc($m['type']) ?>
                                                •
                                                <?= esc($m['capacity_kg']) ?> kg
                                            </p>
                                        </div>

                                        <div class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-bold text-emerald-700">
                                            Rp<?= number_format($m['price_per_hour'], 0, ',', '.') ?>/jam
                                        </div>
                                    </div>

                                    <?php if ($isAvailable): ?>
                                        <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                            Tersedia
                                        </div>
                                    <?php else: ?>
                                        <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-700">
                                            <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                            Tidak tersedia sampai <?= substr($m['available_again_time'], 0, 5) ?> WIB
                                        </div>
                                    <?php endif; ?>

                                    <div class="mt-4">
                                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                                            Durasi Pemakaian
                                        </label>

                                        <select
                                            name="durations[<?= $m['id'] ?>]"
                                            <?= $isAvailable ? '' : 'disabled' ?>
                                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100 disabled:cursor-not-allowed disabled:bg-slate-100">
                                            <?php for ($d = $min; $d <= $max; $d += $step): ?>
                                                <option value="<?= $d ?>"><?= $d ?> menit</option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label>

                <?php endforeach; ?>

            <?php endif; ?>
        </div>
    </section>


    <!-- ADD ON -->
    <?php if (!empty($addons)): ?>
        <section>
            <div class="mb-4">
                <h2 class="text-xl font-extrabold text-slate-950">Add On Tambahan</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Tambahkan layanan atau produk tambahan jika diperlukan.
                </p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <?php foreach ($addons as $a): ?>
                    <?php
                    $stockEnabled = (int) $a['stock_enabled'] === 1;
                    $stockQty = (int) $a['stock_qty'];
                    $maxQty = $stockEnabled ? $stockQty : 99;
                    ?>

                    <div class="rounded-[1.5rem] border border-slate-100 bg-white p-5 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
                        <div class="flex items-start gap-4">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <!-- plus package -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                                    <path d="m3.3 7 8.7 5 8.7-5"></path>
                                    <path d="M12 22V12"></path>
                                    <path d="M16 15h-8"></path>
                                    <path d="M12 11v8"></path>
                                </svg>
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-start justify-between gap-3">
                                    <div>
                                        <h3 class="font-extrabold text-slate-950">
                                            <?= esc($a['name']) ?>
                                        </h3>

                                        <p class="mt-1 text-sm leading-6 text-slate-500">
                                            <?= esc($a['description'] ?: 'Layanan tambahan') ?>
                                        </p>
                                    </div>

                                    <div class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-bold text-emerald-700">
                                        Rp<?= number_format($a['price'], 0, ',', '.') ?>
                                    </div>
                                </div>

                                <?php if ($stockEnabled): ?>
                                    <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-slate-50 px-3 py-1 text-xs font-bold text-slate-600">
                                        Stok: <?= esc((string) $stockQty) ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mt-4">
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                                        Jumlah
                                    </label>

                                    <input
                                        type="number"
                                        min="0"
                                        max="<?= $maxQty ?>"
                                        name="addon_quantities[<?= $a['id'] ?>]"
                                        value="<?= old('addon_quantities.' . $a['id'], 0) ?>"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                                </div>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>


    <!-- CATATAN -->
    <section class="rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
        <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">
            Catatan Opsional
        </label>

        <textarea
            id="notes"
            name="notes"
            rows="4"
            placeholder="Contoh: Saya akan datang 10 menit lebih awal, mohon siapkan mesin dekat pintu."
            class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"><?= old('notes') ?></textarea>
    </section>


    <!-- ACTION BUTTON -->
    <div class="sticky bottom-4 z-20 rounded-[2rem] border border-slate-100 bg-white/90 p-4 shadow-lg backdrop-blur">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="font-extrabold text-slate-950">Siap konfirmasi booking?</p>
                <p class="mt-1 text-sm text-slate-500">
                    Pastikan jadwal, mesin, durasi, dan add-on sudah benar.
                </p>
            </div>

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]">
                Konfirmasi Booking

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14"></path>
                    <path d="m13 6 6 6-6 6"></path>
                </svg>
            </button>
        </div>
    </div>
</form>