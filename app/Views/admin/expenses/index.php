<div class="grid lg:grid-cols-3 gap-5">
<form method="post" action="/admin/expenses" class="bg-white rounded-2xl border p-5 space-y-3">
<?= csrf_field() ?>
<h2 class="font-bold">Catat Pengeluaran</h2>
<input name="title" placeholder="Judul" class="w-full rounded-xl border p-3" required>
<input name="category" placeholder="Kategori" class="w-full rounded-xl border p-3" required>
<input name="amount" type="number" placeholder="Nominal" class="w-full rounded-xl border p-3" required>
<input name="expense_date" type="date" value="<?= date('Y-m-d') ?>" class="w-full rounded-xl border p-3" required>
<textarea name="note" placeholder="Catatan" class="w-full rounded-xl border p-3"></textarea>
<button class="w-full rounded-xl bg-blue-600 text-white py-3">Simpan</button>
</form>
<div class="lg:col-span-2 bg-white rounded-2xl border overflow-x-auto">
<table class="w-full text-sm"><thead class="bg-slate-100"><tr><th class="p-3 text-left">Tanggal</th><th>Judul</th><th>Kategori</th><th>Nominal</th></tr></thead><tbody>
<?php foreach($expenses as $e): ?><tr class="border-t"><td class="p-3"><?= esc($e['expense_date']) ?></td><td><?= esc($e['title']) ?></td><td><?= esc($e['category']) ?></td><td>Rp<?= number_format($e['amount'],0,',','.') ?></td></tr><?php endforeach; ?>
</tbody></table>
</div></div>
