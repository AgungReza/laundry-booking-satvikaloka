<div class="bg-white rounded-2xl border overflow-x-auto">
<table class="w-full text-sm">
<thead class="bg-slate-100"><tr><th class="p-3 text-left">Kode</th><th>Customer</th><th>Tanggal</th><th>Jam</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead>
<tbody>
<?php foreach ($bookings as $b): ?>
<tr class="border-t">
<td class="p-3 font-semibold"><?= esc($b['booking_code']) ?></td><td><?= esc($b['customer_name']) ?></td><td><?= esc($b['booking_date']) ?></td><td><?= substr($b['booking_start_time'],0,5) ?></td><td>Rp<?= number_format($b['total_price'],0,',','.') ?></td><td><?= esc($b['booking_status']) ?></td><td><a class="text-blue-600" href="/admin/bookings/<?= $b['id'] ?>">Detail</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
