<div class="bg-blue-600 text-white rounded-3xl p-8 mb-6">
    <h2 class="text-2xl font-bold mb-2">Selamat datang di Laundry Booking</h2>
    <p class="mb-5">Buat booking mesin laundry, upload bukti pembayaran, lalu tunggu verifikasi admin.</p>
    <a href="/customer/bookings/create" class="inline-flex px-5 py-3 rounded-xl bg-white text-blue-600 font-semibold">Buat Booking</a>
</div>
<h2 class="font-bold mb-3">Booking Terbaru</h2>
<div class="space-y-3">
<?php foreach($bookings as $b): ?>
<a href="/customer/bookings/<?= $b['id'] ?>" class="block bg-white rounded-2xl border p-4 hover:border-blue-300">
    <div class="flex justify-between"><b><?= esc($b['booking_code']) ?></b><span><?= esc($b['booking_status']) ?></span></div>
    <p class="text-sm text-slate-500"><?= esc($b['booking_date']) ?> <?= substr($b['booking_start_time'],0,5) ?> WIB - Rp<?= number_format($b['total_price'],0,',','.') ?></p>
</a>
<?php endforeach; ?>
</div>
