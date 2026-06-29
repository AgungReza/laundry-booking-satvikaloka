<?php
$statusClasses = [
    'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
    'waiting_verification' => 'bg-blue-50 text-blue-700 border-blue-100',
    'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'verified' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'rejected' => 'bg-red-50 text-red-700 border-red-100',
];

$totalPayments = count($payments ?? []);
$pendingCount = 0;

foreach (($payments ?? []) as $payment) {
    if (($payment['payment_status'] ?? '') === 'pending') {
        $pendingCount++;
    }
}
?>

<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-950">Verifikasi Pembayaran</h1>
        <p class="mt-1 text-sm text-slate-500">
            Kelola bukti pembayaran customer dan lakukan approve atau reject pembayaran.
        </p>
    </div>

    <div class="inline-flex w-fit items-center gap-2 rounded-2xl border border-amber-100 bg-amber-50 px-4 py-2 text-sm font-bold text-amber-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M12 7v5l3 2"></path>
        </svg>
        Pending: <?= $pendingCount ?>
    </div>
</div>


<!-- SUMMARY -->
<div class="mb-6 grid gap-4 md:grid-cols-3">
    <div class="rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                <path d="M3 10h18"></path>
                <path d="M7 15h3"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Total Pembayaran</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            <?= $totalPayments ?>
        </p>
    </div>

    <div class="rounded-[2rem] border border-amber-100 bg-amber-50 p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-amber-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 7v5l3 2"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-amber-700">Menunggu Verifikasi</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            <?= $pendingCount ?>
        </p>
    </div>

    <div class="rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 3l7 3v6c0 5-3.5 8-7 9-3.5-1-7-4-7-9V6l7-3z"></path>
                <path d="m9.5 12 1.8 1.8L15 10.2"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Catatan</p>
        <p class="mt-2 text-sm leading-6 text-slate-600">
            Periksa bukti transfer sebelum menyetujui pembayaran customer.
        </p>
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
                <h2 class="font-extrabold text-slate-950">Daftar Pembayaran</h2>
                <p class="text-sm text-slate-500">
                    Data bukti pembayaran dari customer yang masuk ke sistem.
                </p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[950px] text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-extrabold uppercase tracking-wide text-slate-500">
                    <th class="px-5 py-4 text-left">Booking</th>
                    <th class="px-5 py-4 text-left">Customer</th>
                    <th class="px-5 py-4 text-right">Nominal</th>
                    <th class="px-5 py-4 text-center">Status</th>
                    <th class="px-5 py-4 text-center">Bukti</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                <?php if (empty($payments)): ?>
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center">
                            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                    <path d="M7 15h3"></path>
                                </svg>
                            </div>

                            <h3 class="font-extrabold text-slate-950">
                                Belum ada pembayaran
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Pembayaran customer akan muncul di halaman ini.
                            </p>
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($payments as $p): ?>
                        <?php
                        $paymentStatus = strtolower($p['payment_status'] ?? '');
                        $badgeClass = $statusClasses[$paymentStatus] ?? 'bg-slate-50 text-slate-700 border-slate-100';
                        $statusLabel = ucwords(str_replace('_', ' ', $p['payment_status'] ?? '-'));
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
                                            <?= esc($p['booking_code']) ?>
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            Payment ID: <?= esc((string) $p['id']) ?>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-800">
                                    <?= esc($p['customer_name']) ?>
                                </p>
                            </td>

                            <td class="px-5 py-4 text-right font-extrabold text-slate-950">
                                Rp<?= number_format($p['amount'], 0, ',', '.') ?>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full border px-3 py-1 text-xs font-bold <?= $badgeClass ?>">
                                    <?= esc($statusLabel) ?>
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <a
                                    href="/payment-proof/<?= $p['id'] ?>"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-bold text-slate-700 transition hover:bg-slate-100">
                                    Lihat Bukti

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M14 3h7v7"></path>
                                        <path d="M10 14 21 3"></path>
                                        <path d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5"></path>
                                    </svg>
                                </a>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <?php if ($p['payment_status'] === 'pending'): ?>
                                    <div class="flex items-center justify-center gap-2">
                                        <form
                                            method="post"
                                            action="/admin/payments/<?= $p['id'] ?>/approve"
                                            onsubmit="return confirm('Approve pembayaran ini?')">
                                            <?= csrf_field() ?>

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100">
                                                Approve

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="m9 12 2 2 4-4"></path>
                                                    <circle cx="12" cy="12" r="9"></circle>
                                                </svg>
                                            </button>
                                        </form>

                                        <button
                                            type="button"
                                            onclick="openModal('rejectPaymentModal<?= $p['id'] ?>')"
                                            class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-red-100 bg-red-50 px-3 py-2 text-xs font-bold text-red-700 transition hover:bg-red-100">
                                            Reject

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M6 18 18 6"></path>
                                                <path d="m6 6 12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <span class="text-xs font-semibold text-slate-400">
                                        Tidak ada aksi
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- MODAL REJECT PAYMENT -->
<?php foreach (($payments ?? []) as $p): ?>
    <?php if (($p['payment_status'] ?? '') === 'pending'): ?>
        <div id="rejectPaymentModal<?= $p['id'] ?>" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/50 px-4 py-6 backdrop-blur-sm">
            <div class="w-full max-w-lg overflow-hidden rounded-[2rem] bg-white shadow-2xl">

                <div class="flex items-start justify-between gap-4 border-b border-slate-100 bg-gradient-to-br from-red-50 via-white to-white p-6">
                    <div>
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M6 18 18 6"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </div>

                        <h2 class="text-xl font-extrabold text-slate-950">
                            Reject Pembayaran
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Masukkan alasan penolakan untuk pembayaran <?= esc($p['booking_code']) ?>.
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="closeModal('rejectPaymentModal<?= $p['id'] ?>')"
                        class="rounded-2xl bg-white p-2 text-slate-500 shadow-sm hover:text-slate-950">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M6 18 18 6"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>

                <form method="post" action="/admin/payments/<?= $p['id'] ?>/reject" class="space-y-5 p-6">
                    <?= csrf_field() ?>

                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Booking</p>
                        <p class="mt-1 font-extrabold text-slate-950">
                            <?= esc($p['booking_code']) ?>
                        </p>

                        <p class="mt-3 text-sm text-slate-500">Nominal</p>
                        <p class="mt-1 font-extrabold text-slate-950">
                            Rp<?= number_format($p['amount'], 0, ',', '.') ?>
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Alasan Reject
                        </label>

                        <textarea
                            name="reject_reason"
                            rows="4"
                            placeholder="Contoh: Nominal tidak sesuai atau bukti transfer tidak jelas."
                            class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-red-300 focus:bg-white focus:ring-4 focus:ring-red-100"
                            required></textarea>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            onclick="closeModal('rejectPaymentModal<?= $p['id'] ?>')"
                            class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-200">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="rounded-2xl bg-red-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-red-200 transition hover:bg-red-600">
                            Reject Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>


<script>
    function openModal(id) {
        const modal = document.getElementById(id);

        if (!modal) return;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);

        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id^="rejectPaymentModal"]').forEach(function(modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });

            document.body.classList.remove('overflow-hidden');
        }
    });
</script>