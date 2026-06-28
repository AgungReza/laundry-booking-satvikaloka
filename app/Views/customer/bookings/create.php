<form method="get" class="bg-white rounded-2xl border p-5 mb-5 flex flex-wrap gap-3">
    <input type="date" name="booking_date" value="<?= esc($date) ?>" class="rounded-xl border p-3" required>
    <input type="time" name="booking_start_time" value="<?= esc(substr($startTime,0,5)) ?>" class="rounded-xl border p-3" required>
    <button class="rounded-xl bg-slate-900 text-white px-5">Cek Mesin</button>
</form>

<form method="post" action="/customer/bookings" class="space-y-5">
<?= csrf_field() ?>
<input type="hidden" name="booking_date" value="<?= esc($date) ?>">
<input type="hidden" name="booking_start_time" value="<?= esc(substr($startTime,0,5)) ?>">

<div>
    <h2 class="font-bold text-lg mb-3">Pilih Mesin</h2>
    <div class="grid md:grid-cols-2 gap-4">
    <?php foreach($machines as $m): ?>
        <label class="bg-white rounded-2xl border p-5 block <?= $m['dynamic_status']==='available'?'':'opacity-60' ?>">
            <div class="flex items-start gap-3">
                <input type="checkbox" name="machine_ids[]" value="<?= $m['id'] ?>" <?= $m['dynamic_status']==='available'?'':'disabled' ?> class="mt-1">
                <div class="flex-1">
                    <div class="flex justify-between gap-3"><b><?= esc($m['name']) ?></b><span class="text-sm">Rp<?= number_format($m['price_per_hour'],0,',','.') ?>/jam</span></div>
                    <p class="text-sm text-slate-500"><?= esc($m['code']) ?> • <?= esc($m['type']) ?> • <?= esc($m['capacity_kg']) ?> kg</p>
                    <?php if($m['dynamic_status']==='available'): ?>
                        <p class="mt-2 text-sm text-green-600 font-semibold">Tersedia</p>
                    <?php else: ?>
                        <p class="mt-2 text-sm text-red-600 font-semibold">Sedang Tidak Tersedia sampai <?= substr($m['available_again_time'],0,5) ?> WIB</p>
                    <?php endif; ?>
                    <select name="durations[<?= $m['id'] ?>]" class="mt-3 w-full rounded-xl border p-2">
                        <?php $min=(int)$m['minimum_duration_minutes']; $step=(int)$m['duration_step_minutes']; $max=(int)($m['max_duration_minutes'] ?: 180); for($d=$min;$d<=$max;$d+=$step): ?>
                            <option value="<?= $d ?>"><?= $d ?> menit</option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </label>
    <?php endforeach; ?>
    </div>
</div>

<?php if (!empty($addons)): ?>
<div>
    <h2 class="font-bold text-lg mb-3">Add On Tambahan</h2>
    <div class="grid md:grid-cols-2 gap-4">
        <?php foreach ($addons as $a): ?>
            <div class="bg-white rounded-2xl border p-5">
                <div class="flex justify-between gap-3">
                    <div>
                        <b><?= esc($a['name']) ?></b>
                        <p class="text-sm text-slate-500"><?= esc($a['description'] ?: 'Layanan tambahan') ?></p>
                        <?php if ((int) $a['stock_enabled'] === 1): ?>
                            <p class="text-xs text-slate-500 mt-1">Stok: <?= esc((string) $a['stock_qty']) ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="text-sm whitespace-nowrap">Rp<?= number_format($a['price'],0,',','.') ?></span>
                </div>
                <label class="block text-sm font-semibold mt-4 mb-1">Jumlah</label>
                <input type="number" min="0" max="<?= (int) $a['stock_enabled'] === 1 ? (int) $a['stock_qty'] : 99 ?>" name="addon_quantities[<?= $a['id'] ?>]" value="<?= old('addon_quantities.' . $a['id'], 0) ?>" class="w-full rounded-xl border p-2">
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<textarea name="notes" placeholder="Catatan opsional" class="w-full rounded-2xl border p-4"><?= old('notes') ?></textarea>
<button class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold">Konfirmasi Booking</button>
</form>
