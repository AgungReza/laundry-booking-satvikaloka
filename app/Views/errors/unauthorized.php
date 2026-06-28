<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen grid place-items-center">
<div class="bg-white rounded-3xl shadow-xl p-8 max-w-md text-center">
    <h1 class="text-3xl font-bold text-red-600 mb-3">Akses Ditolak</h1>
    <p class="text-slate-600 mb-6">Kamu tidak memiliki izin untuk membuka halaman ini.</p>
    <p class="text-sm text-slate-500 mb-6">Redirect dalam <span id="count">5</span> detik.</p>
    <a class="inline-flex px-5 py-3 rounded-xl bg-slate-900 text-white" href="<?= esc($redirectUrl) ?>">Kembali ke Dashboard</a>
</div>
<script>
let n = 5;
const el = document.getElementById('count');
const target = '<?= esc($redirectUrl) ?>';
setInterval(() => {
    n--;
    el.textContent = n;
    if (n <= 0) window.location.href = target;
}, 1000);
</script>
</body>
</html>
