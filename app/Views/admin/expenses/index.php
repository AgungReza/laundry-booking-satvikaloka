<?php
$totalExpenses = 0;

foreach (($expenses ?? []) as $expense) {
    $totalExpenses += (int) ($expense['amount'] ?? 0);
}
?>

<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-950">Pengeluaran</h1>
        <p class="mt-1 text-sm text-slate-500">
            Catat dan pantau seluruh pengeluaran operasional Wish Laundry.
        </p>
    </div>

    <button
        type="button"
        onclick="openModal('addExpenseModal')"
        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14"></path>
            <path d="M5 12h14"></path>
        </svg>
        Catat Pengeluaran
    </button>
</div>


<!-- SUMMARY CARD -->
<div class="mb-6 grid gap-4 md:grid-cols-3">
    <div class="rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 1v22"></path>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Total Pengeluaran</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            Rp<?= number_format($totalExpenses, 0, ',', '.') ?>
        </p>
    </div>

    <div class="rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M4 19V5"></path>
                <path d="M4 19h16"></path>
                <path d="M8 16v-5"></path>
                <path d="M12 16V8"></path>
                <path d="M16 16v-3"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Jumlah Data</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            <?= count($expenses ?? []) ?>
        </p>
    </div>

    <div class="rounded-[2rem] border border-amber-100 bg-amber-50 p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-amber-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
                <path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-amber-700">Catatan</p>
        <p class="mt-2 text-sm leading-6 text-amber-800">
            Pastikan setiap biaya operasional dicatat agar laporan keuangan lebih akurat.
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
                    <path d="M6 2h12a2 2 0 0 1 2 2v18l-3-2-3 2-3-2-3 2-3-2-3 2V4a2 2 0 0 1 2-2z"></path>
                    <path d="M8 7h8"></path>
                    <path d="M8 11h8"></path>
                    <path d="M8 15h5"></path>
                </svg>
            </div>

            <div>
                <h2 class="font-extrabold text-slate-950">Daftar Pengeluaran</h2>
                <p class="text-sm text-slate-500">
                    Riwayat biaya operasional yang telah dicatat admin.
                </p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[900px] text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-extrabold uppercase tracking-wide text-slate-500">
                    <th class="px-5 py-4 text-left">Tanggal</th>
                    <th class="px-5 py-4 text-left">Judul</th>
                    <th class="px-5 py-4 text-left">Kategori</th>
                    <th class="px-5 py-4 text-left">Catatan</th>
                    <th class="px-5 py-4 text-right">Nominal</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                <?php if (empty($expenses)): ?>
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center">
                            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v14"></path>
                                    <path d="M5 12h14"></path>
                                </svg>
                            </div>

                            <h3 class="font-extrabold text-slate-950">
                                Belum ada pengeluaran
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Catat pengeluaran pertama untuk operasional laundry.
                            </p>

                            <button
                                type="button"
                                onclick="openModal('addExpenseModal')"
                                class="mt-5 inline-flex rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 hover:bg-emerald-600">
                                Catat Pengeluaran
                            </button>
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($expenses as $e): ?>
                        <tr class="transition hover:bg-emerald-50/40">
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold text-slate-700">
                                    <?= esc($e['expense_date']) ?>
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M6 2h12a2 2 0 0 1 2 2v18l-3-2-3 2-3-2-3 2-3-2-3 2V4a2 2 0 0 1 2-2z"></path>
                                            <path d="M8 7h8"></path>
                                            <path d="M8 11h8"></path>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-extrabold text-slate-950">
                                            <?= esc($e['title']) ?>
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            ID: <?= esc((string) ($e['id'] ?? '-')) ?>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                    <?= esc($e['category']) ?>
                                </span>
                            </td>

                            <td class="max-w-md px-5 py-4 text-slate-600">
                                <?= esc($e['note'] ?? '-') ?: '-' ?>
                            </td>

                            <td class="px-5 py-4 text-right font-extrabold text-slate-950">
                                Rp<?= number_format($e['amount'], 0, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- MODAL CATAT PENGELUARAN -->
<div id="addExpenseModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/50 px-4 py-6 backdrop-blur-sm">
    <div class="w-full max-w-xl overflow-hidden rounded-[2rem] bg-white shadow-2xl">

        <!-- MODAL HEADER -->
        <div class="flex items-start justify-between gap-4 border-b border-slate-100 bg-gradient-to-br from-emerald-50 via-white to-white p-6">
            <div>
                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 1v22"></path>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>

                <h2 class="text-xl font-extrabold text-slate-950">
                    Catat Pengeluaran
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tambahkan biaya operasional baru ke laporan keuangan.
                </p>
            </div>

            <button
                type="button"
                onclick="closeModal('addExpenseModal')"
                class="rounded-2xl bg-white p-2 text-slate-500 shadow-sm hover:text-slate-950">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M6 18 18 6"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>

        <!-- FORM -->
        <form method="post" action="/admin/expenses" class="space-y-5 p-6">
            <?= csrf_field() ?>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Judul Pengeluaran
                </label>

                <input
                    name="title"
                    value="<?= old('title') ?>"
                    placeholder="Contoh: Beli deterjen"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Kategori
                </label>

                <input
                    name="category"
                    value="<?= old('category') ?>"
                    placeholder="Contoh: Operasional / Perawatan / Stok"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Nominal
                </label>

                <input
                    name="amount"
                    type="number"
                    value="<?= old('amount') ?>"
                    min="0"
                    step="1"
                    placeholder="Masukkan nominal pengeluaran"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Tanggal Pengeluaran
                </label>

                <input
                    name="expense_date"
                    type="date"
                    value="<?= old('expense_date', date('Y-m-d')) ?>"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Catatan
                </label>

                <textarea
                    name="note"
                    rows="3"
                    placeholder="Catatan tambahan jika ada"
                    class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"><?= old('note') ?></textarea>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    onclick="closeModal('addExpenseModal')"
                    class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-200">
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600">
                    Simpan Pengeluaran
                </button>
            </div>
        </form>
    </div>
</div>


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
            closeModal('addExpenseModal');
        }
    });
</script>