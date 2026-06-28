<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Register</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-slate-100 min-h-screen grid place-items-center p-5">
<div class="bg-white rounded-3xl shadow-xl p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6">Daftar Customer</h1>
    <?= view('partials/flash') ?>
    <form method="post" action="/register" class="space-y-4">
        <?= csrf_field() ?>
        <input name="name" value="<?= old('name') ?>" placeholder="Nama lengkap" class="w-full rounded-xl border p-3" required>
        <input name="email" type="email" value="<?= old('email') ?>" placeholder="Email" class="w-full rounded-xl border p-3" required>
        <input name="phone" value="<?= old('phone') ?>" placeholder="Nomor WhatsApp" class="w-full rounded-xl border p-3">
        <input name="password" type="password" placeholder="Password minimal 8 karakter" class="w-full rounded-xl border p-3" required>
        <button class="w-full rounded-xl bg-blue-600 text-white py-3 font-semibold">Daftar</button>
    </form>
    <p class="mt-5 text-sm text-center">Sudah punya akun? <a class="text-blue-600" href="/login">Login</a></p>
</div>
</body>
</html>
