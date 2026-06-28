<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Customer') ?> - Laundry Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">
<header class="bg-white border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-5 py-4 flex items-center justify-between">
        <a href="/customer/dashboard" class="font-bold text-lg">Laundry Booking</a>
        <nav class="space-x-4 text-sm">
            <a href="/customer/dashboard" class="hover:text-blue-600">Dashboard</a>
            <a href="/customer/bookings/create" class="hover:text-blue-600">Booking</a>
            <a href="/customer/bookings" class="hover:text-blue-600">Riwayat</a>
            <a href="/logout" class="text-red-600">Logout</a>
        </nav>
    </div>
</header>
<main class="max-w-6xl mx-auto px-5 py-8">
    <h1 class="text-2xl font-bold mb-2"><?= esc($title ?? '') ?></h1>
    <p class="text-sm text-slate-500 mb-6">Halo, <?= esc(session()->get('name')) ?></p>
    <?= view('partials/flash') ?>
    <?= $content ?? '' ?>
</main>
</body>
</html>
