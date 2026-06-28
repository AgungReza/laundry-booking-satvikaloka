<?php
$isEdit = !empty($addon);
?>
<form method="post" action="<?= $isEdit ? '/admin/addons/' . $addon['id'] : '/admin/addons' ?>" class="bg-white rounded-2xl border p-5 space-y-4 max-w-2xl">
    <?= csrf_field() ?>

    <div>
        <label class="block text-sm font-semibold mb-1">Nama Add On</label>
        <input type="text" name="name" value="<?= old('name', $addon['name'] ?? '') ?>" class="w-full rounded-xl border p-3" required>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Deskripsi</label>
        <textarea name="description" class="w-full rounded-xl border p-3" rows="3"><?= old('description', $addon['description'] ?? '') ?></textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Harga</label>
        <input type="number" name="price" value="<?= old('price', $addon['price'] ?? 0) ?>" min="0" step="1" class="w-full rounded-xl border p-3" required>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold mb-1">Gunakan Stok?</label>
            <select name="stock_enabled" class="w-full rounded-xl border p-3">
                <option value="0" <?= (string) old('stock_enabled', $addon['stock_enabled'] ?? 0) === '0' ? 'selected' : '' ?>>Tidak</option>
                <option value="1" <?= (string) old('stock_enabled', $addon['stock_enabled'] ?? 0) === '1' ? 'selected' : '' ?>>Ya</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Jumlah Stok</label>
            <input type="number" name="stock_qty" value="<?= old('stock_qty', $addon['stock_qty'] ?? '') ?>" min="0" class="w-full rounded-xl border p-3" placeholder="Kosongkan jika stok tidak dipakai">
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Status</label>
        <select name="is_active" class="w-full rounded-xl border p-3">
            <option value="1" <?= (string) old('is_active', $addon['is_active'] ?? 1) === '1' ? 'selected' : '' ?>>Aktif</option>
            <option value="0" <?= (string) old('is_active', $addon['is_active'] ?? 1) === '0' ? 'selected' : '' ?>>Nonaktif</option>
        </select>
    </div>

    <div class="flex gap-3">
        <button class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold">Simpan</button>
        <a href="/admin/addons" class="px-5 py-3 rounded-xl bg-slate-200">Batal</a>
    </div>
</form>
