<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Admin') ?> - Laundry Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800">
<div class="min-h-screen flex">
    <aside class="w-64 bg-slate-950 text-white p-5 hidden md:block">
        <div class="font-bold text-xl mb-8">Laundry Admin</div>
        <nav class="space-y-2 text-sm">
            <a class="block px-3 py-2 rounded-lg hover:bg-slate-800" href="/admin/dashboard">Dashboard</a>
            <a class="block px-3 py-2 rounded-lg hover:bg-slate-800" href="/admin/machines">Mesin</a>
            <a class="block px-3 py-2 rounded-lg hover:bg-slate-800" href="/admin/addons">Add On</a>
            <a class="block px-3 py-2 rounded-lg hover:bg-slate-800" href="/admin/bookings">Booking</a>
            <a class="block px-3 py-2 rounded-lg hover:bg-slate-800" href="/admin/payments">Pembayaran</a>
            <a class="block px-3 py-2 rounded-lg hover:bg-slate-800" href="/admin/bank-accounts">Rekening</a>
            <a class="block px-3 py-2 rounded-lg hover:bg-slate-800" href="/admin/expenses">Pengeluaran</a>
            <a class="block px-3 py-2 rounded-lg hover:bg-slate-800" href="/admin/reports">Laporan</a>
            <a class="block px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 mt-8" href="/logout">Logout</a>
        </nav>
    </aside>
    <main class="flex-1 p-5 md:p-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold"><?= esc($title ?? '') ?></h1>
                <p class="text-sm text-slate-500">Halo, <?= esc(session()->get('name')) ?></p>
            </div>
        </div>
        <?= view('partials/flash') ?>
        <?= $content ?? '' ?>
    </main>
</div>
</body>
</html>
