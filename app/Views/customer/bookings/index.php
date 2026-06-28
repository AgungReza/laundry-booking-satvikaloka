<div class="mb-4"><a href="/customer/bookings/create" class="px-4 py-2 rounded-xl bg-blue-600 text-white">Booking Baru</a></div>
<div class="space-y-3">
<?php foreach($bookings as $b): ?>
<a href="/customer/bookings/<?= $b['id'] ?>" class="block bg-white rounded-2xl border p-4 hover:border-blue-300">
    <div class="flex justify-between"><b><?= esc($b['booking_code']) ?></b><span><?= esc($b['booking_status']) ?></span></div>
    <p class="text-sm text-slate-500"><?= esc($b['booking_date']) ?> <?= substr($b['booking_start_time'],0,5) ?> WIB - Rp<?= number_format($b['total_price'],0,',','.') ?></p>
</a>
<?php endforeach; ?>
</div>
