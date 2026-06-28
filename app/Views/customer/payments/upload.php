<div class="grid lg:grid-cols-3 gap-5">
<div class="lg:col-span-2 bg-white rounded-2xl border p-5">
<h2 class="font-bold text-lg mb-2">Upload Bukti untuk <?= esc($booking['booking_code']) ?></h2>
<p class="mb-4">Total pembayaran: <b>Rp<?= number_format($booking['total_price'],0,',','.') ?></b></p>
<form method="post" enctype="multipart/form-data" class="space-y-4">
<?= csrf_field() ?>
<select name="bank_account_id" class="w-full rounded-xl border p-3" required>
<option value="">Pilih rekening tujuan</option>
<?php foreach($accounts as $a): ?><option value="<?= $a['id'] ?>"><?= esc($a['bank_name']) ?> - <?= esc($a['account_number']) ?> a.n <?= esc($a['account_name']) ?></option><?php endforeach; ?>
</select>
<input name="sender_bank_name" placeholder="Bank pengirim" class="w-full rounded-xl border p-3">
<input name="sender_account_name" placeholder="Nama pemilik rekening pengirim" class="w-full rounded-xl border p-3" required>
<input name="sender_account_number" placeholder="Nomor rekening pengirim" class="w-full rounded-xl border p-3">
<input type="datetime-local" name="paid_at" class="w-full rounded-xl border p-3" required>
<input type="file" name="proof" accept=".jpg,.jpeg,.png,.pdf" class="w-full rounded-xl border p-3" required>
<button class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold">Upload Bukti</button>
</form>
</div>
<div class="bg-amber-50 border border-amber-100 rounded-2xl p-5 text-sm text-amber-800">
<p class="font-bold mb-2">Catatan</p>
<p>File bukti boleh jpg, jpeg, png, atau pdf. Maksimal 2MB. Setelah upload, booking masuk status menunggu verifikasi admin.</p>
</div>
</div>
