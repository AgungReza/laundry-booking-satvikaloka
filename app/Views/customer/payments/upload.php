<?php
$totalPrice = number_format($booking['total_price'], 0, ',', '.');
?>

<div class="mb-6">
    <a href="/customer/bookings/<?= $booking['id'] ?>" class="mb-3 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5"></path>
            <path d="m12 19-7-7 7-7"></path>
        </svg>
        Kembali ke detail booking
    </a>

    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-950">
        Upload Bukti Pembayaran
    </h1>

    <p class="mt-1 text-sm text-slate-500">
        Lengkapi data pembayaran untuk booking <?= esc($booking['booking_code']) ?>.
    </p>
</div>


<div class="grid gap-6 lg:grid-cols-3">

    <!-- FORM UPLOAD -->
    <div class="lg:col-span-2">
        <div class="overflow-hidden rounded-[2rem] border border-slate-100 bg-white shadow-sm">

            <!-- HEADER CARD -->
            <div class="border-b border-slate-100 bg-gradient-to-br from-emerald-50 via-white to-teal-50 p-6">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                    <div>
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                            <!-- upload icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 16V8"></path>
                                <path d="M8.5 11.5 12 8l3.5 3.5"></path>
                                <path d="M20 16.5v1A2.5 2.5 0 0 1 17.5 20h-11A2.5 2.5 0 0 1 4 17.5v-1"></path>
                            </svg>
                        </div>

                        <h2 class="text-xl font-extrabold text-slate-950">
                            Bukti untuk <?= esc($booking['booking_code']) ?>
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Upload bukti transfer agar admin dapat melakukan verifikasi booking Anda.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white p-4 shadow-sm sm:text-right">
                        <p class="text-sm text-slate-500">Total Pembayaran</p>
                        <p class="mt-1 text-2xl font-extrabold text-slate-950">
                            Rp<?= $totalPrice ?>
                        </p>
                    </div>

                </div>
            </div>

            <!-- FORM BODY -->
            <form method="post" enctype="multipart/form-data" class="space-y-5 p-6">
                <?= csrf_field() ?>

                <!-- Rekening Tujuan -->
                <div>
                    <label for="bank_account_id" class="mb-2 block text-sm font-semibold text-slate-700">
                        Rekening Tujuan
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <!-- bank icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M3 10h18"></path>
                                <path d="M5 10V8l7-4 7 4v2"></path>
                                <path d="M6 10v8"></path>
                                <path d="M10 10v8"></path>
                                <path d="M14 10v8"></path>
                                <path d="M18 10v8"></path>
                                <path d="M4 18h16"></path>
                            </svg>
                        </span>

                        <select
                            id="bank_account_id"
                            name="bank_account_id"
                            class="w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-10 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                            <option value="">Pilih rekening tujuan</option>

                            <?php foreach ($accounts as $a): ?>
                                <option value="<?= $a['id'] ?>" <?= old('bank_account_id') == $a['id'] ? 'selected' : '' ?>>
                                    <?= esc($a['bank_name']) ?> - <?= esc($a['account_number']) ?> a.n <?= esc($a['account_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Bank Pengirim -->
                <div>
                    <label for="sender_bank_name" class="mb-2 block text-sm font-semibold text-slate-700">
                        Bank Pengirim
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <!-- credit card icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                <path d="M3 10h18"></path>
                                <path d="M7 15h3"></path>
                            </svg>
                        </span>

                        <input
                            id="sender_bank_name"
                            name="sender_bank_name"
                            value="<?= old('sender_bank_name') ?>"
                            placeholder="Contoh: BCA / BRI / Mandiri"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                    </div>
                </div>

                <!-- Nama Pemilik Rekening -->
                <div>
                    <label for="sender_account_name" class="mb-2 block text-sm font-semibold text-slate-700">
                        Nama Pemilik Rekening Pengirim
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <!-- user icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21a8 8 0 0 1 16 0"></path>
                            </svg>
                        </span>

                        <input
                            id="sender_account_name"
                            name="sender_account_name"
                            value="<?= old('sender_account_name') ?>"
                            placeholder="Nama sesuai rekening pengirim"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                    </div>
                </div>

                <!-- Nomor Rekening -->
                <div>
                    <label for="sender_account_number" class="mb-2 block text-sm font-semibold text-slate-700">
                        Nomor Rekening Pengirim
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <!-- number icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M4 9h16"></path>
                                <path d="M4 15h16"></path>
                                <path d="M10 3 8 21"></path>
                                <path d="M16 3l-2 18"></path>
                            </svg>
                        </span>

                        <input
                            id="sender_account_number"
                            name="sender_account_number"
                            value="<?= old('sender_account_number') ?>"
                            placeholder="Nomor rekening pengirim"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                    </div>
                </div>

                <!-- Tanggal Bayar -->
                <div>
                    <label for="paid_at" class="mb-2 block text-sm font-semibold text-slate-700">
                        Waktu Pembayaran
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <!-- clock icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path d="M12 7v5l3 2"></path>
                            </svg>
                        </span>

                        <input
                            id="paid_at"
                            type="datetime-local"
                            name="paid_at"
                            value="<?= old('paid_at') ?>"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                    </div>
                </div>

                <!-- Upload File -->
                <div>
                    <label for="proof" class="mb-2 block text-sm font-semibold text-slate-700">
                        File Bukti Pembayaran
                    </label>

                    <div class="rounded-[1.5rem] border border-dashed border-emerald-200 bg-emerald-50/50 p-5">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-emerald-600 shadow-sm">
                            <!-- file icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <path d="M14 2v6h6"></path>
                                <path d="M12 18v-6"></path>
                                <path d="m9 15 3 3 3-3"></path>
                            </svg>
                        </div>

                        <input
                            id="proof"
                            type="file"
                            name="proof"
                            accept=".jpg,.jpeg,.png,.pdf"
                            class="w-full rounded-2xl border border-slate-200 bg-white p-3 text-sm file:mr-4 file:rounded-xl file:border-0 file:bg-emerald-500 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-emerald-600"
                            required>

                        <p class="mt-3 text-xs leading-5 text-slate-500">
                            Format file: JPG, JPEG, PNG, atau PDF. Maksimal ukuran file 2MB.
                        </p>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="pt-2">
                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98] sm:w-auto">
                        Upload Bukti

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 16V8"></path>
                            <path d="M8.5 11.5 12 8l3.5 3.5"></path>
                            <path d="M20 16.5v1A2.5 2.5 0 0 1 17.5 20h-11A2.5 2.5 0 0 1 4 17.5v-1"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- SIDEBAR INFO -->
    <aside class="lg:col-span-1">
        <div class="sticky top-5 space-y-5">

            <!-- CATATAN -->
            <div class="rounded-[2rem] border border-amber-100 bg-amber-50 p-5 text-sm text-amber-800 shadow-sm">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-amber-600">
                    <!-- alert icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                        <path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"></path>
                    </svg>
                </div>

                <p class="font-extrabold mb-2">Catatan Upload</p>

                <p class="leading-6">
                    File bukti boleh berupa JPG, JPEG, PNG, atau PDF dengan ukuran maksimal 2MB.
                    Setelah upload, booking akan masuk status menunggu verifikasi admin.
                </p>
            </div>

            <!-- RINGKASAN -->
            <div class="rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <!-- receipt icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3z"></path>
                        <path d="M9 8h6"></path>
                        <path d="M9 12h6"></path>
                        <path d="M9 16h4"></path>
                    </svg>
                </div>

                <p class="font-extrabold text-slate-950">Ringkasan Booking</p>

                <div class="mt-4 space-y-3 text-sm">
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Kode</span>
                        <span class="font-bold text-slate-950"><?= esc($booking['booking_code']) ?></span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Total</span>
                        <span class="font-bold text-slate-950">Rp<?= $totalPrice ?></span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Status</span>
                        <span class="font-bold text-amber-600">Menunggu Pembayaran</span>
                    </div>
                </div>
            </div>

        </div>
    </aside>

</div>