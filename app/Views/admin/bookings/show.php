<div class="grid lg:grid-cols-3 gap-5">
    <div class="lg:col-span-2 bg-white rounded-2xl border p-5">
        <h2 class="font-bold text-lg mb-3"><?= esc($booking['booking_code']) ?></h2>
        <p>Customer: <?= esc($booking['customer_name']) ?> / <?= esc($booking['phone']) ?></p>
        <p>Tanggal: <?= esc($booking['booking_date']) ?> <?= substr($booking['booking_start_time'],0,5) ?> WIB</p>
        <p>Status: <b><?= esc($booking['booking_status']) ?></b></p>
        <p>Total: <b>Rp<?= number_format($booking['total_price'],0,',','.') ?></b></p>

        <h3 class="font-semibold mt-5 mb-2">Mesin</h3>
        <ul class="space-y-2">
            <?php foreach ($machines as $m): ?>
                <li class="border rounded-xl p-3"><?= esc($m['machine_name_snapshot']) ?> - <?= substr($m['machine_start_time'],0,5) ?>-<?= substr($m['machine_end_time'],0,5) ?>, tersedia lagi <?= substr($m['available_again_time'],0,5) ?> WIB, Rp<?= number_format($m['subtotal'],0,',','.') ?></li>
            <?php endforeach; ?>
        </ul>

        <?php if (!empty($addons)): ?>
        <h3 class="font-semibold mt-5 mb-2">Add On</h3>
        <ul class="space-y-2">
            <?php foreach ($addons as $a): ?>
                <li class="border rounded-xl p-3"><?= esc($a['addon_name_snapshot']) ?> x <?= esc((string) $a['quantity']) ?> @ Rp<?= number_format($a['unit_price_snapshot'],0,',','.') ?> = Rp<?= number_format($a['subtotal'],0,',','.') ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
    <div class="bg-white rounded-2xl border p-5">
        <h3 class="font-bold mb-3">Aksi</h3>
        <?php if ($payment): ?>
            <p class="text-sm mb-2">Payment: <?= esc($payment['payment_status']) ?></p>
            <a href="/payment-proof/<?= $payment['id'] ?>" class="text-blue-600 text-sm">Lihat bukti</a>
        <?php else: ?>
            <p class="text-sm text-slate-500">Belum ada payment.</p>
        <?php endif; ?>
        <form method="post" action="/admin/bookings/<?= $booking['id'] ?>/complete" class="mt-4"><?= csrf_field() ?><button class="w-full rounded-xl bg-green-600 text-white py-2">Tandai Selesai</button></form>
        <form method="post" action="/admin/bookings/<?= $booking['id'] ?>/cancel" class="mt-3"><?= csrf_field() ?><input name="cancel_reason" placeholder="Alasan batal" class="w-full border rounded-xl p-2 mb-2"><button class="w-full rounded-xl bg-red-600 text-white py-2">Batalkan</button></form>
    </div>
</div>
