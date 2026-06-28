<div class="bg-white rounded-2xl border overflow-x-auto">
<table class="w-full text-sm">
<thead class="bg-slate-100"><tr><th class="p-3 text-left">Booking</th><th>Customer</th><th>Nominal</th><th>Status</th><th>Bukti</th><th>Aksi</th></tr></thead>
<tbody>
<?php foreach ($payments as $p): ?>
<tr class="border-t">
<td class="p-3 font-semibold"><?= esc($p['booking_code']) ?></td><td><?= esc($p['customer_name']) ?></td><td>Rp<?= number_format($p['amount'],0,',','.') ?></td><td><?= esc($p['payment_status']) ?></td><td><a class="text-blue-600" href="/payment-proof/<?= $p['id'] ?>">Lihat</a></td>
<td class="p-3">
<?php if ($p['payment_status']==='pending'): ?>
<form method="post" action="/admin/payments/<?= $p['id'] ?>/approve" class="inline"><?= csrf_field() ?><button class="px-3 py-1 rounded-lg bg-green-600 text-white">Approve</button></form>
<form method="post" action="/admin/payments/<?= $p['id'] ?>/reject" class="inline-flex gap-1 mt-1"><?= csrf_field() ?><input name="reject_reason" placeholder="Alasan" class="border rounded-lg px-2 py-1"><button class="px-3 py-1 rounded-lg bg-red-600 text-white">Reject</button></form>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
