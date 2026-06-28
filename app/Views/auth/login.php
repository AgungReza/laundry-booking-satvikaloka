<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-slate-100 min-h-screen grid place-items-center p-5">
<div class="bg-white rounded-3xl shadow-xl p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6">Login</h1>
    <?= view('partials/flash') ?>
    <form method="post" action="/login" class="space-y-4">
        <?= csrf_field() ?>
        <input name="email" type="email" value="<?= old('email') ?>" placeholder="Email" class="w-full rounded-xl border p-3" required>
        <input name="password" type="password" placeholder="Password" class="w-full rounded-xl border p-3" required>
        <button class="w-full rounded-xl bg-blue-600 text-white py-3 font-semibold">Login</button>
    </form>
    <p class="mt-5 text-sm text-center">Belum punya akun? <a class="text-blue-600" href="/register">Daftar</a></p>
</div>
</body>
</html>
