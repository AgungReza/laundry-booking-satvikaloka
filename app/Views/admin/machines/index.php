<?php
$typeLabels = [
    'washer' => 'Washer',
    'dryer'  => 'Dryer',
    'combo'  => 'Combo',
];

$statusLabels = [
    'available'   => 'Tersedia',
    'maintenance' => 'Maintenance',
    'broken'      => 'Rusak',
    'inactive'    => 'Nonaktif',
];

$statusClasses = [
    'available'   => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'maintenance' => 'bg-amber-50 text-amber-700 border-amber-100',
    'broken'      => 'bg-red-50 text-red-700 border-red-100',
    'inactive'    => 'bg-slate-50 text-slate-700 border-slate-100',
];

$totalMachines = count($machines ?? []);
?>

<!-- HEADER -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-950">Mesin Laundry</h1>
        <p class="mt-1 text-sm text-slate-500">
            Kelola data mesin, tarif, durasi pemakaian, dan status operasional mesin.
        </p>
    </div>

    <button
        type="button"
        onclick="openModal('addMachineModal')"
        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600 active:scale-[0.98]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14"></path>
            <path d="M5 12h14"></path>
        </svg>
        Tambah Mesin
    </button>
</div>


<!-- SUMMARY -->
<div class="mb-6 grid gap-4 md:grid-cols-3">
    <div class="rounded-[2rem] border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                <path d="M8 6h.01"></path>
                <path d="M11 6h5"></path>
                <circle cx="12" cy="14" r="4"></circle>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Total Mesin</p>
        <p class="mt-2 text-2xl font-extrabold text-slate-950">
            <?= $totalMachines ?>
        </p>
    </div>

    <div class="rounded-[2rem] border border-slate-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 7v5l3 2"></path>
            </svg>
        </div>

        <p class="text-sm font-semibold text-slate-500">Pengaturan Durasi</p>
        <p class="mt-2 text-sm leading-6 text-slate-600">
            Setiap mesin dapat memiliki minimal, step, dan maksimal durasi berbeda.
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
            Mesin nonaktif, rusak, atau maintenance tidak sebaiknya ditampilkan sebagai pilihan customer.
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
                    <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                    <path d="M8 6h.01"></path>
                    <path d="M11 6h5"></path>
                    <circle cx="12" cy="14" r="4"></circle>
                </svg>
            </div>

            <div>
                <h2 class="font-extrabold text-slate-950">Daftar Mesin</h2>
                <p class="text-sm text-slate-500">
                    Data mesin washer, dryer, atau combo yang digunakan untuk booking customer.
                </p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[1000px] text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-extrabold uppercase tracking-wide text-slate-500">
                    <th class="px-5 py-4 text-left">Kode</th>
                    <th class="px-5 py-4 text-left">Nama Mesin</th>
                    <th class="px-5 py-4 text-center">Tipe</th>
                    <th class="px-5 py-4 text-center">Kapasitas</th>
                    <th class="px-5 py-4 text-right">Tarif/Jam</th>
                    <th class="px-5 py-4 text-center">Durasi</th>
                    <th class="px-5 py-4 text-center">Status</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                <?php if (empty($machines)): ?>
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center">
                            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v14"></path>
                                    <path d="M5 12h14"></path>
                                </svg>
                            </div>

                            <h3 class="font-extrabold text-slate-950">
                                Belum ada mesin
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Tambahkan mesin pertama untuk mulai menerima booking.
                            </p>

                            <button
                                type="button"
                                onclick="openModal('addMachineModal')"
                                class="mt-5 inline-flex rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 hover:bg-emerald-600">
                                Tambah Mesin
                            </button>
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($machines as $m): ?>
                        <?php
                        $status = strtolower($m['status'] ?? 'available');
                        $badgeClass = $statusClasses[$status] ?? 'bg-slate-50 text-slate-700 border-slate-100';
                        $statusLabel = $statusLabels[$status] ?? ucwords($status);
                        $typeLabel = $typeLabels[$m['type'] ?? ''] ?? ucwords($m['type'] ?? '-');
                        ?>

                        <tr class="transition hover:bg-emerald-50/40">
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold text-slate-700">
                                    <?= esc($m['code']) ?>
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                                            <path d="M8 6h.01"></path>
                                            <path d="M11 6h5"></path>
                                            <circle cx="12" cy="14" r="4"></circle>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-extrabold text-slate-950">
                                            <?= esc($m['name']) ?>
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            ID: <?= esc((string) $m['id']) ?>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                    <?= esc($typeLabel) ?>
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center text-slate-600">
                                <?= esc((string) ($m['capacity_kg'] ?: '-')) ?> kg
                            </td>

                            <td class="px-5 py-4 text-right font-extrabold text-slate-950">
                                Rp<?= number_format($m['price_per_hour'], 0, ',', '.') ?>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <div class="text-xs leading-5 text-slate-600">
                                    <p>Min <?= esc((string) $m['minimum_duration_minutes']) ?> menit</p>
                                    <p>Step <?= esc((string) $m['duration_step_minutes']) ?> menit</p>
                                    <p>
                                        Maks:
                                        <?= !empty($m['max_duration_minutes']) ? esc((string) $m['max_duration_minutes']) . ' menit' : '-' ?>
                                    </p>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full border px-3 py-1 text-xs font-bold <?= $badgeClass ?>">
                                    <?= esc($statusLabel) ?>
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <button
                                    type="button"
                                    onclick="openModal('editMachineModal<?= $m['id'] ?>')"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100">
                                    Edit

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- MODAL TAMBAH MESIN -->
<div id="addMachineModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/50 px-4 py-6 backdrop-blur-sm">
    <div class="max-h-[92vh] w-full max-w-3xl overflow-hidden rounded-[2rem] bg-white shadow-2xl">

        <div class="flex items-start justify-between gap-4 border-b border-slate-100 bg-gradient-to-br from-emerald-50 via-white to-white p-6">
            <div>
                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14"></path>
                        <path d="M5 12h14"></path>
                    </svg>
                </div>

                <h2 class="text-xl font-extrabold text-slate-950">Tambah Mesin</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Tambahkan mesin baru untuk digunakan pada sistem booking.
                </p>
            </div>

            <button type="button" onclick="closeModal('addMachineModal')" class="rounded-2xl bg-white p-2 text-slate-500 shadow-sm hover:text-slate-950">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M6 18 18 6"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>

        <form method="post" action="/admin/machines" class="max-h-[70vh] space-y-5 overflow-y-auto p-6">
            <?= csrf_field() ?>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Kode Mesin</label>
                    <input
                        name="code"
                        value="<?= old('code') ?>"
                        placeholder="Contoh: WSH-01"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        required>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Mesin</label>
                    <input
                        name="name"
                        value="<?= old('name') ?>"
                        placeholder="Contoh: Mesin Cuci 1"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        required>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tipe Mesin</label>
                    <select
                        name="type"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        required>
                        <?php foreach (['washer' => 'Washer', 'dryer' => 'Dryer', 'combo' => 'Combo'] as $k => $v): ?>
                            <option value="<?= $k ?>" <?= old('type', 'washer') === $k ? 'selected' : '' ?>>
                                <?= $v ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Kapasitas Kg</label>
                    <input
                        name="capacity_kg"
                        type="number"
                        step="0.01"
                        value="<?= old('capacity_kg') ?>"
                        placeholder="Contoh: 8"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tarif Per Jam</label>
                    <input
                        name="price_per_hour"
                        type="number"
                        step="1"
                        value="<?= old('price_per_hour') ?>"
                        placeholder="Contoh: 15000"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        required>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                    <select
                        name="status"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        required>
                        <?php foreach (['available' => 'Tersedia', 'maintenance' => 'Maintenance', 'broken' => 'Rusak', 'inactive' => 'Nonaktif'] as $k => $v): ?>
                            <option value="<?= $k ?>" <?= old('status', 'available') === $k ? 'selected' : '' ?>>
                                <?= $v ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Minimal Durasi</label>
                    <input
                        name="minimum_duration_minutes"
                        type="number"
                        value="<?= old('minimum_duration_minutes', 30) ?>"
                        placeholder="Minimal durasi"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        required>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Step Durasi</label>
                    <input
                        name="duration_step_minutes"
                        type="number"
                        value="<?= old('duration_step_minutes', 30) ?>"
                        placeholder="Step durasi"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        required>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Maksimal Durasi Opsional</label>
                    <input
                        name="max_duration_minutes"
                        type="number"
                        value="<?= old('max_duration_minutes') ?>"
                        placeholder="Kosongkan jika tidak dibatasi"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Catatan Status</label>
                    <textarea
                        name="status_note"
                        rows="3"
                        placeholder="Contoh: Mesin sedang maintenance ringan"
                        class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"><?= old('status_note') ?></textarea>
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <button type="button" onclick="closeModal('addMachineModal')" class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-200">
                    Batal
                </button>

                <button type="submit" class="rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600">
                    Simpan Mesin
                </button>
            </div>
        </form>
    </div>
</div>


<!-- MODAL EDIT MESIN -->
<?php foreach ($machines as $m): ?>
    <div id="editMachineModal<?= $m['id'] ?>" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/50 px-4 py-6 backdrop-blur-sm">
        <div class="max-h-[92vh] w-full max-w-3xl overflow-hidden rounded-[2rem] bg-white shadow-2xl">

            <div class="flex items-start justify-between gap-4 border-b border-slate-100 bg-gradient-to-br from-emerald-50 via-white to-white p-6">
                <div>
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                        </svg>
                    </div>

                    <h2 class="text-xl font-extrabold text-slate-950">
                        Edit Mesin
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ubah data <?= esc($m['name']) ?>.
                    </p>
                </div>

                <button type="button" onclick="closeModal('editMachineModal<?= $m['id'] ?>')" class="rounded-2xl bg-white p-2 text-slate-500 shadow-sm hover:text-slate-950">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M6 18 18 6"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <form method="post" action="/admin/machines/<?= $m['id'] ?>" class="max-h-[70vh] space-y-5 overflow-y-auto p-6">
                <?= csrf_field() ?>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Kode Mesin</label>
                        <input
                            name="code"
                            value="<?= old('code', $m['code'] ?? '') ?>"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Mesin</label>
                        <input
                            name="name"
                            value="<?= old('name', $m['name'] ?? '') ?>"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Tipe Mesin</label>
                        <select
                            name="type"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                            <?php foreach (['washer' => 'Washer', 'dryer' => 'Dryer', 'combo' => 'Combo'] as $k => $v): ?>
                                <option value="<?= $k ?>" <?= old('type', $m['type'] ?? '') === $k ? 'selected' : '' ?>>
                                    <?= $v ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Kapasitas Kg</label>
                        <input
                            name="capacity_kg"
                            type="number"
                            step="0.01"
                            value="<?= old('capacity_kg', $m['capacity_kg'] ?? '') ?>"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Tarif Per Jam</label>
                        <input
                            name="price_per_hour"
                            type="number"
                            step="1"
                            value="<?= old('price_per_hour', $m['price_per_hour'] ?? '') ?>"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                        <select
                            name="status"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                            <?php foreach (['available' => 'Tersedia', 'maintenance' => 'Maintenance', 'broken' => 'Rusak', 'inactive' => 'Nonaktif'] as $s => $label): ?>
                                <option value="<?= $s ?>" <?= old('status', $m['status'] ?? 'available') === $s ? 'selected' : '' ?>>
                                    <?= $label ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Minimal Durasi</label>
                        <input
                            name="minimum_duration_minutes"
                            type="number"
                            value="<?= old('minimum_duration_minutes', $m['minimum_duration_minutes'] ?? 30) ?>"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Step Durasi</label>
                        <input
                            name="duration_step_minutes"
                            type="number"
                            value="<?= old('duration_step_minutes', $m['duration_step_minutes'] ?? 30) ?>"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                            required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Maksimal Durasi Opsional</label>
                        <input
                            name="max_duration_minutes"
                            type="number"
                            value="<?= old('max_duration_minutes', $m['max_duration_minutes'] ?? '') ?>"
                            placeholder="Kosongkan jika tidak dibatasi"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100">
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Catatan Status</label>
                        <textarea
                            name="status_note"
                            rows="3"
                            placeholder="Catatan status mesin"
                            class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-3.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100"><?= old('status_note', $m['status_note'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                    <button type="button" onclick="closeModal('editMachineModal<?= $m['id'] ?>')" class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-200">
                        Batal
                    </button>

                    <button type="submit" class="rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-600">
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

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id^="addMachineModal"], [id^="editMachineModal"]').forEach(function(modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });

            document.body.classList.remove('overflow-hidden');
        }
    });
</script>