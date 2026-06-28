<form method="post" action="<?= $machine ? '/admin/machines/'.$machine['id'] : '/admin/machines' ?>" class="bg-white rounded-2xl border p-5 grid md:grid-cols-2 gap-4">
    <?= csrf_field() ?>
    <input name="code" value="<?= old('code', $machine['code'] ?? '') ?>" placeholder="Kode mesin" class="rounded-xl border p-3" required>
    <input name="name" value="<?= old('name', $machine['name'] ?? '') ?>" placeholder="Nama mesin" class="rounded-xl border p-3" required>
    <select name="type" class="rounded-xl border p-3" required>
        <?php foreach (['washer'=>'Washer','dryer'=>'Dryer','combo'=>'Combo'] as $k=>$v): ?>
            <option value="<?= $k ?>" <?= old('type', $machine['type'] ?? '')===$k?'selected':'' ?>><?= $v ?></option>
        <?php endforeach; ?>
    </select>
    <input name="capacity_kg" type="number" step="0.01" value="<?= old('capacity_kg', $machine['capacity_kg'] ?? '') ?>" placeholder="Kapasitas kg" class="rounded-xl border p-3">
    <input name="price_per_hour" type="number" step="1" value="<?= old('price_per_hour', $machine['price_per_hour'] ?? '') ?>" placeholder="Tarif per jam" class="rounded-xl border p-3" required>
    <input name="minimum_duration_minutes" type="number" value="<?= old('minimum_duration_minutes', $machine['minimum_duration_minutes'] ?? 30) ?>" placeholder="Minimal durasi" class="rounded-xl border p-3" required>
    <input name="duration_step_minutes" type="number" value="<?= old('duration_step_minutes', $machine['duration_step_minutes'] ?? 30) ?>" placeholder="Step durasi" class="rounded-xl border p-3" required>
    <input name="max_duration_minutes" type="number" value="<?= old('max_duration_minutes', $machine['max_duration_minutes'] ?? '') ?>" placeholder="Maks durasi opsional" class="rounded-xl border p-3">
    <select name="status" class="rounded-xl border p-3" required>
        <?php foreach (['available','maintenance','broken','inactive'] as $s): ?>
            <option value="<?= $s ?>" <?= old('status', $machine['status'] ?? 'available')===$s?'selected':'' ?>><?= $s ?></option>
        <?php endforeach; ?>
    </select>
    <textarea name="status_note" placeholder="Catatan status" class="rounded-xl border p-3 md:col-span-2"><?= old('status_note', $machine['status_note'] ?? '') ?></textarea>
    <div class="md:col-span-2 flex gap-3">
        <button class="px-5 py-3 rounded-xl bg-blue-600 text-white">Simpan</button>
        <a href="/admin/machines" class="px-5 py-3 rounded-xl bg-slate-100">Kembali</a>
    </div>
</form>
