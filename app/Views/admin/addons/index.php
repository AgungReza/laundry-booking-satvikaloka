<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-950">Add On</h1>
        <p class="mt-1 text-sm text-slate-500">
            Kelola layanan tambahan seperti deterjen, pewangi, plastik laundry, atau layanan lainnya.
        </p>
    </div>

    <button
        type="button"
        onclick="openModal('addAddonModal')"
        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14"></path>
            <path d="M5 12h14"></path>
        </svg>
        Tambah Add On
    </button>
</div>


<!-- TABLE CARD -->
<div class="overflow-hidden rounded-[2rem] border border-slate-100 bg-white shadow-sm">
    <div class="border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-white p-5">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                    <path d="m3.3 7 8.7 5 8.7-5"></path>
                    <path d="M12 22V12"></path>
                </svg>
            </div>

            <div>
                <h2 class="font-extrabold text-slate-950">Daftar Add On</h2>
                <p class="text-sm text-slate-500">Data layanan tambahan yang dapat dipilih customer.</p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[900px] text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-extrabold uppercase tracking-wide text-slate-500">
                    <th class="px-5 py-4 text-left">Nama</th>
                    <th class="px-5 py-4 text-left">Deskripsi</th>
                    <th class="px-5 py-4 text-right">Harga</th>
                    <th class="px-5 py-4 text-center">Stok</th>
                    <th class="px-5 py-4 text-center">Status</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                <?php if (empty($addons)): ?>
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center">
                            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v14"></path>
                                    <path d="M5 12h14"></path>
                                </svg>
                            </div>

                            <h3 class="font-extrabold text-slate-950">Belum ada add on</h3>
                            <p class="mt-1 text-sm text-slate-500">Tambahkan add on pertama untuk customer.</p>

                            <button
                                type="button"
                                onclick="openModal('addAddonModal')"
                                class="mt-5 inline-flex rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 hover:bg-emerald-600"
                            >
                                Tambah Add On
                            </button>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($addons as $a): ?>
                        <tr class="transition hover:bg-emerald-50/40">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                                            <path d="m3.3 7 8.7 5 8.7-5"></path>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-extrabold text-slate-950"><?= esc($a['name']) ?></p>
                                        <p class="text-xs text-slate-500">ID: <?= esc((string) $a['id']) ?></p>
                                    </div>
                                </div>
                            </td>

                            <td class="max-w-md px-5 py-4 text-slate-600">
                                <?= esc($a['description'] ?: '-') ?>
                            </td>

                            <td class="px-5 py-4 text-right font-extrabold text-slate-950">
                                Rp<?= number_format($a['price'], 0, ',', '.') ?>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <?php if ((int) $a['stock_enabled'] === 1): ?>
                                    <span class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold text-slate-700">
                                        <?= esc((string) $a['stock_qty']) ?> stok
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                        Tidak dibatasi
                                    </span>
                                <?php endif; ?>
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

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        type="button"
                                        onclick="openModal('editAddonModal<?= $a['id'] ?>')"
                                        class="inline-flex items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100"
                                    >
                                        Edit
                                    </button>

                                    <form
                                        method="post"
                                        action="/admin/addons/<?= $a['id'] ?>/delete"
                                        onsubmit="return confirm('Hapus add on ini?')"
                                    >
                                        <?= csrf_field() ?>
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center rounded-xl border border-red-100 bg-red-50 px-3 py-2 text-xs font-bold text-red-700 transition hover:bg-red-100"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- MODAL TAMBAH ADD ON -->
<div id="addAddonModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/50 px-4 py-6 backdrop-blur-sm">
    <div class="w-full max-w-2xl overflow-hidden rounded-[2rem] bg-white shadow-2xl">

        <div class="flex items-start justify-between gap-4 border-b border-slate-100 bg-gradient-to-br from-emerald-50 via-white to-white p-6">
            <div>
                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14"></path>
                        <path d="M5 12h14"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-extrabold text-slate-950">Tambah Add On</h2>
                <p class="mt-1 text-sm text-slate-500">Tambahkan layanan tambahan baru.</p>
            </div>

            <button type="button" onclick="closeModal('addAddonModal')" class="rounded-2xl bg-white p-2 text-slate-500 shadow-sm hover:text-slate-950">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M6 18 18 6"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>

        <form method="post" action="/admin/addons" class="space-y-5 p-6">
            <?= csrf_field() ?>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Add On</label>
                <input type="text" name="name" value="<?= old('name') ?>" placeholder="Contoh: Deterjen cair" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Deskripsi singkat add on" class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"><?= old('description') ?></textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Harga</label>
                <input type="number" name="price" value="<?= old('price', 0) ?>" min="0" step="1" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100" required>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Gunakan Stok?</label>
                    <select name="stock_enabled" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                        <option value="0" <?= (string) old('stock_enabled', 0) === '0' ? 'selected' : '' ?>>Tidak</option>
                        <option value="1" <?= (string) old('stock_enabled', 0) === '1' ? 'selected' : '' ?>>Ya</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Jumlah Stok</label>
                    <input type="number" name="stock_qty" value="<?= old('stock_qty') ?>" min="0" placeholder="Kosongkan jika tidak dipakai" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="is_active" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                    <option value="1" <?= (string) old('is_active', 1) === '1' ? 'selected' : '' ?>>Aktif</option>
                    <option value="0" <?= (string) old('is_active', 1) === '0' ? 'selected' : '' ?>>Nonaktif</option>
                </select>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <button type="button" onclick="closeModal('addAddonModal')" class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-200">
                    Batal
                </button>

                <button type="submit" class="rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 hover:bg-emerald-600">
                    Simpan Add On
                </button>
            </div>
        </form>
    </div>
</div>


<!-- MODAL EDIT ADD ON -->
<?php foreach ($addons as $a): ?>
<div id="editAddonModal<?= $a['id'] ?>" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/50 px-4 py-6 backdrop-blur-sm">
    <div class="w-full max-w-2xl overflow-hidden rounded-[2rem] bg-white shadow-2xl">

        <div class="flex items-start justify-between gap-4 border-b border-slate-100 bg-gradient-to-br from-emerald-50 via-white to-white p-6">
            <div>
                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-extrabold text-slate-950">Edit Add On</h2>
                <p class="mt-1 text-sm text-slate-500">Ubah data <?= esc($a['name']) ?>.</p>
            </div>

            <button type="button" onclick="closeModal('editAddonModal<?= $a['id'] ?>')" class="rounded-2xl bg-white p-2 text-slate-500 shadow-sm hover:text-slate-950">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M6 18 18 6"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>

        <form method="post" action="/admin/addons/<?= $a['id'] ?>" class="space-y-5 p-6">
            <?= csrf_field() ?>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Add On</label>
                <input type="text" name="name" value="<?= old('name', $a['name'] ?? '') ?>" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"><?= old('description', $a['description'] ?? '') ?></textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Harga</label>
                <input type="number" name="price" value="<?= old('price', $a['price'] ?? 0) ?>" min="0" step="1" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100" required>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Gunakan Stok?</label>
                    <select name="stock_enabled" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                        <option value="0" <?= (string) old('stock_enabled', $a['stock_enabled'] ?? 0) === '0' ? 'selected' : '' ?>>Tidak</option>
                        <option value="1" <?= (string) old('stock_enabled', $a['stock_enabled'] ?? 0) === '1' ? 'selected' : '' ?>>Ya</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Jumlah Stok</label>
                    <input type="number" name="stock_qty" value="<?= old('stock_qty', $a['stock_qty'] ?? '') ?>" min="0" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100" placeholder="Kosongkan jika stok tidak dipakai">
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="is_active" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                    <option value="1" <?= (string) old('is_active', $a['is_active'] ?? 1) === '1' ? 'selected' : '' ?>>Aktif</option>
                    <option value="0" <?= (string) old('is_active', $a['is_active'] ?? 1) === '0' ? 'selected' : '' ?>>Nonaktif</option>
                </select>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <button type="button" onclick="closeModal('editAddonModal<?= $a['id'] ?>')" class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-200">
                    Batal
                </button>

                <button type="submit" class="rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 hover:bg-emerald-600">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
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

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id^="addAddonModal"], [id^="editAddonModal"]').forEach(function (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });

            document.body.classList.remove('overflow-hidden');
        }
    });
</script>