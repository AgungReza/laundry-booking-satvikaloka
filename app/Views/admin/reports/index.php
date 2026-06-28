<form method="get" class="bg-white rounded-2xl border p-5 mb-5 flex flex-wrap gap-3">
    <input type="date" name="start_date" value="<?= esc($summary['start_date']) ?>" class="rounded-xl border p-3">
    <input type="date" name="end_date" value="<?= esc($summary['end_date']) ?>" class="rounded-xl border p-3">
    <button class="rounded-xl bg-blue-600 text-white px-5">Filter</button>
</form>
<div class="grid md:grid-cols-5 gap-4">
<?php foreach ([['Pendapatan',$summary['income']],['Pengeluaran',$summary['expense']],['Laba Bersih',$summary['profit']]] as $c): ?>
<div class="bg-white rounded-2xl border p-5"><p class="text-sm text-slate-500"><?= $c[0] ?></p><p class="text-2xl font-bold">Rp<?= number_format($c[1],0,',','.') ?></p></div>
<?php endforeach; ?>
<div class="bg-white rounded-2xl border p-5"><p class="text-sm text-slate-500">Payment Pending</p><p class="text-2xl font-bold"><?= $summary['pending_payments'] ?></p></div>
<div class="bg-white rounded-2xl border p-5"><p class="text-sm text-slate-500">Booking Aktif</p><p class="text-2xl font-bold"><?= $summary['active_bookings'] ?></p></div>
</div>
