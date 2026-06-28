<div class="grid lg:grid-cols-3 gap-5">
<form method="post" action="/admin/bank-accounts" class="bg-white rounded-2xl border p-5 space-y-3">
<?= csrf_field() ?>
<h2 class="font-bold">Tambah Rekening</h2>
<input name="bank_name" placeholder="Nama Bank" class="w-full rounded-xl border p-3" required>
<input name="account_number" placeholder="Nomor Rekening" class="w-full rounded-xl border p-3" required>
<input name="account_name" placeholder="Nama Pemilik" class="w-full rounded-xl border p-3" required>
<label class="text-sm"><input type="checkbox" name="is_active" checked> Aktif</label>
<button class="w-full rounded-xl bg-blue-600 text-white py-3">Simpan</button>
</form>
<div class="lg:col-span-2 bg-white rounded-2xl border overflow-x-auto">
<table class="w-full text-sm"><thead class="bg-slate-100"><tr><th class="p-3 text-left">Bank</th><th>Nomor</th><th>Nama</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($accounts as $a): ?><tr class="border-t"><td class="p-3"><?= esc($a['bank_name']) ?></td><td><?= esc($a['account_number']) ?></td><td><?= esc($a['account_name']) ?></td><td><?= $a['is_active']?'Aktif':'Nonaktif' ?></td><td><form method="post" action="/admin/bank-accounts/<?= $a['id'] ?>/toggle"><?= csrf_field() ?><button class="text-blue-600">Toggle</button></form></td></tr><?php endforeach; ?>
</tbody></table>
</div></div>
