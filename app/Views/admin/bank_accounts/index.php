<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-950">Rekening Pembayaran</h1>
        <p class="mt-1 text-sm text-slate-500">
            Kelola rekening tujuan transfer untuk pembayaran booking customer.
        </p>
    </div>

    <button
        type="button"
        onclick="openModal('addBankModal')"
        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14"></path>
            <path d="M5 12h14"></path>
        </svg>
        Tambah Rekening
    </button>
</div>


<!-- TABLE CARD -->
<div class="overflow-hidden rounded-[2rem] border border-slate-100 bg-white shadow-sm">

    <!-- CARD HEADER -->
    <div class="border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-white p-5">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
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
            </div>

            <div>
                <h2 class="font-extrabold text-slate-950">Daftar Rekening</h2>
                <p class="text-sm text-slate-500">
                    Rekening aktif akan muncul sebagai pilihan saat customer upload bukti pembayaran.
                </p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[850px] text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-extrabold uppercase tracking-wide text-slate-500">
                    <th class="px-5 py-4 text-left">Bank</th>
                    <th class="px-5 py-4 text-left">Nomor Rekening</th>
                    <th class="px-5 py-4 text-left">Nama Pemilik</th>
                    <th class="px-5 py-4 text-center">Status</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                <?php if (empty($accounts)): ?>
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center">
                            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M3 10h18"></path>
                                    <path d="M5 10V8l7-4 7 4v2"></path>
                                    <path d="M6 10v8"></path>
                                    <path d="M10 10v8"></path>
                                    <path d="M14 10v8"></path>
                                    <path d="M18 10v8"></path>
                                    <path d="M4 18h16"></path>
                                </svg>
                            </div>

                            <h3 class="font-extrabold text-slate-950">
                                Belum ada rekening
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Tambahkan rekening tujuan transfer terlebih dahulu.
                            </p>

                            <button
                                type="button"
                                onclick="openModal('addBankModal')"
                                class="mt-5 inline-flex rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 hover:bg-emerald-600">
                                Tambah Rekening
                            </button>
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($accounts as $a): ?>
                        <tr class="transition hover:bg-emerald-50/40">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M3 10h18"></path>
                                            <path d="M5 10V8l7-4 7 4v2"></path>
                                            <path d="M6 10v8"></path>
                                            <path d="M10 10v8"></path>
                                            <path d="M14 10v8"></path>
                                            <path d="M18 10v8"></path>
                                            <path d="M4 18h16"></path>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-extrabold text-slate-950">
                                            <?= esc($a['bank_name']) ?>
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            ID: <?= esc((string) $a['id']) ?>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold text-slate-700">
                                    <?= esc($a['account_number']) ?>
                                </span>
                            </td>

                            <td class="px-5 py-4 font-semibold text-slate-700">
                                <?= esc($a['account_name']) ?>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <?php if ((int) $a['is_active'] === 1): ?>
                                    <span class="inline-flex rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                        Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex rounded-full border border-red-100 bg-red-50 px-3 py-1 text-xs font-bold text-red-700">
                                        Nonaktif
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <form
                                    method="post"
                                    action="/admin/bank-accounts/<?= $a['id'] ?>/toggle"
                                    onsubmit="return confirm('Ubah status rekening ini?')">
                                    <?= csrf_field() ?>

                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100">
                                        Toggle Status

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M17 1l4 4-4 4"></path>
                                            <path d="M3 11V9a4 4 0 0 1 4-4h14"></path>
                                            <path d="M7 23l-4-4 4-4"></path>
                                            <path d="M21 13v2a4 4 0 0 1-4 4H3"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- MODAL TAMBAH REKENING -->
<div id="addBankModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/50 px-4 py-6 backdrop-blur-sm">
    <div class="w-full max-w-xl overflow-hidden rounded-[2rem] bg-white shadow-2xl">

        <!-- MODAL HEADER -->
        <div class="flex items-start justify-between gap-4 border-b border-slate-100 bg-gradient-to-br from-emerald-50 via-white to-white p-6">
            <div>
                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M3 10h18"></path>
                        <path d="M5 10V8l7-4 7 4v2"></path>
                        <path d="M6 10v8"></path>
                        <path d="M10 10v8"></path>
                        <path d="M14 10v8"></path>
                        <path d="M18 10v8"></path>
                        <path d="M4 18h16"></path>
                    </svg>
                </div>

                <h2 class="text-xl font-extrabold text-slate-950">
                    Tambah Rekening
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Masukkan data rekening tujuan pembayaran customer.
                </p>
            </div>

            <button
                type="button"
                onclick="closeModal('addBankModal')"
                class="rounded-2xl bg-white p-2 text-slate-500 shadow-sm hover:text-slate-950">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M6 18 18 6"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>

        <!-- FORM -->
        <form method="post" action="/admin/bank-accounts" class="space-y-5 p-6">
            <?= csrf_field() ?>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Nama Bank
                </label>

                <input
                    name="bank_name"
                    value="<?= old('bank_name') ?>"
                    placeholder="Contoh: BCA / BRI / Mandiri"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Nomor Rekening
                </label>

                <input
                    name="account_number"
                    value="<?= old('account_number') ?>"
                    placeholder="Masukkan nomor rekening"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Nama Pemilik Rekening
                </label>

                <input
                    name="account_name"
                    value="<?= old('account_name') ?>"
                    placeholder="Nama pemilik rekening"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                    required>
            </div>

            <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-emerald-100 bg-emerald-50 p-4">
                <div>
                    <p class="text-sm font-bold text-slate-950">Aktifkan rekening</p>
                    <p class="mt-1 text-xs text-slate-500">
                        Jika aktif, rekening ini dapat dipilih customer saat upload bukti pembayaran.
                    </p>
                </div>

                <input
                    type="checkbox"
                    name="is_active"
                    class="h-5 w-5 rounded border-slate-300 text-emerald-500 focus:ring-emerald-300"
                    checked>
            </label>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    onclick="closeModal('addBankModal')"
                    class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-200">
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600">
                    Simpan Rekening
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
            closeModal('addBankModal');
        }
    });
</script>