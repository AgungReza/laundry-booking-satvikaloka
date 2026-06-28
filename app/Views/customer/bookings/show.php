<div class="grid lg:grid-cols-3 gap-5">
<div class="lg:col-span-2 bg-white rounded-2xl border p-5">
<h2 class="text-xl font-bold mb-2"><?= esc($booking['booking_code']) ?></h2>
<p class="text-sm text-slate-500 mb-4">Status: <b><?= esc($booking['booking_status']) ?></b></p>
<p>Tanggal: <?= esc($booking['booking_date']) ?> <?= substr($booking['booking_start_time'],0,5) ?> WIB</p>
<p>Deadline pembayaran: <?= esc($booking['payment_deadline_at']) ?> WIB</p>
<p>Total: <b>Rp<?= number_format($booking['total_price'],0,',','.') ?></b></p>

<h3 class="font-semibold mt-5 mb-2">Detail Mesin</h3>
<ul class="space-y-2">
<?php foreach($machines as $m): ?>
<li class="border rounded-xl p-3"><?= esc($m['machine_name_snapshot']) ?> - <?= $m['duration_minutes'] ?> menit, <?= substr($m['machine_start_time'],0,5) ?>-<?= substr($m['machine_end_time'],0,5) ?>, tersedia lagi <?= substr($m['available_again_time'],0,5) ?> WIB, Rp<?= number_format($m['subtotal'],0,',','.') ?></li>
<?php endforeach; ?>
</ul>

<?php if (!empty($addons)): ?>
<h3 class="font-semibold mt-5 mb-2">Add On</h3>
<ul class="space-y-2">
<?php foreach($addons as $a): ?>
<li class="border rounded-xl p-3"><?= esc($a['addon_name_snapshot']) ?> x <?= esc((string) $a['quantity']) ?> @ Rp<?= number_format($a['unit_price_snapshot'],0,',','.') ?> = Rp<?= number_format($a['subtotal'],0,',','.') ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</div>

<div class="bg-white rounded-2xl border p-5">
<h3 class="font-bold mb-3">Pembayaran</h3>
<?php if($booking['booking_status']==='pending_payment'): ?>
<a href="/customer/payments/<?= $booking['id'] ?>/upload" class="block text-center rounded-xl bg-blue-600 text-white py-3 font-semibold">Upload Bukti</a>
<p class="text-xs text-slate-500 mt-3">Upload bukti pembayaran maksimal 60 menit setelah booking dibuat.</p>
<?php elseif($payment): ?>
<p>Status payment: <b><?= esc($payment['payment_status']) ?></b></p>
<a class="text-blue-600 text-sm" href="/payment-proof/<?= $payment['id'] ?>">Lihat bukti pembayaran</a>
<?php else: ?>
<p class="text-sm text-slate-500">Tidak ada pembayaran.</p>
<?php endif; ?>
</div>
</div>
