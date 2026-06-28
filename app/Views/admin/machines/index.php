<div class="mb-4"><a href="/admin/machines/create" class="px-4 py-2 rounded-xl bg-blue-600 text-white">Tambah Mesin</a></div>
<div class="bg-white rounded-2xl border overflow-x-auto">
<table class="w-full text-sm">
<thead class="bg-slate-100"><tr><th class="p-3 text-left">Kode</th><th class="p-3 text-left">Nama</th><th class="p-3">Tipe</th><th class="p-3">Tarif/Jam</th><th class="p-3">Durasi</th><th class="p-3">Status</th><th class="p-3">Aksi</th></tr></thead>
<tbody>
<?php foreach ($machines as $m): ?>
<tr class="border-t">
    <td class="p-3 font-semibold"><?= esc($m['code']) ?></td>
    <td class="p-3"><?= esc($m['name']) ?></td>
    <td class="p-3 text-center"><?= esc($m['type']) ?></td>
    <td class="p-3 text-right">Rp<?= number_format($m['price_per_hour'],0,',','.') ?></td>
    <td class="p-3 text-center">Min <?= esc($m['minimum_duration_minutes']) ?> / Step <?= esc($m['duration_step_minutes']) ?></td>
    <td class="p-3 text-center"><?= esc($m['status']) ?></td>
    <td class="p-3 text-center"><a class="text-blue-600" href="/admin/machines/<?= $m['id'] ?>/edit">Edit</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
