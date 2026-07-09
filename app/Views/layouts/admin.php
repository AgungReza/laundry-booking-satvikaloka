<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Admin') ?> - Wish Laundry Admin</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        wish: {
                            50: '#f3fbf8',
                            100: '#e4f7f0',
                            200: '#c9efe2',
                            300: '#9fe2cc',
                            400: '#67cfad',
                            500: '#33bc91',
                            600: '#21a67f',
                            700: '#1c8567',
                            800: '#1c6954',
                            900: '#1a5646'
                        }
                    },
                    boxShadow: {
                        soft: '0 10px 35px rgba(15, 23, 42, 0.08)'
                    }
                }
            }
        }
    </script>
</head>

<?php
$uriPath = trim(uri_string(), '/');

$isActive = function ($path) use ($uriPath) {
    $path = trim($path, '/');

    return $uriPath === $path || strpos($uriPath, $path . '/') === 0;
};

$navClass = function ($path) use ($isActive) {
    if ($isActive($path)) {
        return 'bg-wish-500 text-white shadow-lg shadow-wish-500/20';
    }

    return 'text-slate-500 hover:bg-wish-50 hover:text-wish-700';
};
?>

<body class="bg-[#f6fbf9] font-sans text-slate-800 antialiased">

    <div class="min-h-screen">

        <!-- MOBILE TOPBAR -->
        <header class="sticky top-0 z-40 border-b border-slate-100 bg-white/90 px-4 py-4 backdrop-blur md:hidden">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-wish-500 text-white font-extrabold">
                        W
                    </div>
                    <div>
                        <p class="text-sm font-extrabold text-slate-950">Wish Laundry</p>
                        <p class="text-xs text-slate-500">Admin Panel</p>
                    </div>
                </div>

                <button
                    type="button"
                    onclick="toggleSidebar()"
                    class="flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700">
                    <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M4 6h16"></path>
                        <path d="M4 12h16"></path>
                        <path d="M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </header>


        <!-- MOBILE OVERLAY -->
        <div
            id="sidebarOverlay"
            onclick="toggleSidebar()"
            class="fixed inset-0 z-40 hidden bg-slate-950/40 md:hidden"></div>


        <!-- SIDEBAR -->
        <aside
            id="sidebar"
            class="fixed left-0 top-0 z-50 h-screen w-72 -translate-x-full border-r border-slate-100 bg-white p-5 shadow-2xl transition-transform duration-300 md:translate-x-0 md:shadow-none">
            <!-- BRAND -->
            <div class="mb-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-wish-500 text-white shadow-lg shadow-wish-500/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                            <path d="M8 6h.01"></path>
                            <path d="M11 6h5"></path>
                            <circle cx="12" cy="14" r="4"></circle>
                            <path d="M9.5 14a3.5 3.5 0 0 0 5 0"></path>
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-lg font-extrabold leading-tight text-slate-950">
                            Wish Laundry
                        </h1>
                        <p class="text-xs font-medium text-slate-500">
                            Admin Management
                        </p>
                    </div>
                </div>

                <button
                    type="button"
                    onclick="toggleSidebar()"
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M6 18 18 6"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>


            <!-- USER CARD -->
            <div class="mb-6 rounded-[1.5rem] border border-wish-100 bg-gradient-to-br from-wish-50 to-white p-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-wish-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 21a8 8 0 0 1 16 0"></path>
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-extrabold text-slate-950">
                            <?= esc(session()->get('name') ?? 'Admin') ?>
                        </p>
                        <p class="text-xs font-medium text-slate-500">
                            Administrator
                        </p>
                    </div>
                </div>
            </div>


            <!-- NAVIGATION -->
            <nav class="space-y-1.5 text-sm font-bold">

                <a href="/admin/dashboard" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition <?= $navClass('admin/dashboard') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M3 13h8V3H3z"></path>
                        <path d="M13 21h8V11h-8z"></path>
                        <path d="M13 3h8v6h-8z"></path>
                        <path d="M3 21h8v-6H3z"></path>
                    </svg>
                    Dashboard
                </a>

                <a href="/admin/machines" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition <?= $navClass('admin/machines') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                        <path d="M8 6h.01"></path>
                        <path d="M11 6h5"></path>
                        <circle cx="12" cy="14" r="4"></circle>
                    </svg>
                    Mesin
                </a>

                <a href="/admin/addons" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition <?= $navClass('admin/addons') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                        <path d="m3.3 7 8.7 5 8.7-5"></path>
                        <path d="M12 22V12"></path>
                    </svg>
                    Add On
                </a>

                <a href="/admin/bookings" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition <?= $navClass('admin/bookings') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                        <path d="M16 3v4M8 3v4M3 10h18"></path>
                    </svg>
                    Booking
                </a>

                <a href="/admin/payments" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition <?= $navClass('admin/payments') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                        <path d="M3 10h18"></path>
                        <path d="M7 15h3"></path>
                    </svg>
                    Pembayaran
                </a>

                <a href="/admin/bank-accounts" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition <?= $navClass('admin/bank-accounts') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M3 10h18"></path>
                        <path d="M5 10V8l7-4 7 4v2"></path>
                        <path d="M6 10v8"></path>
                        <path d="M10 10v8"></path>
                        <path d="M14 10v8"></path>
                        <path d="M18 10v8"></path>
                        <path d="M4 18h16"></path>
                    </svg>
                    Rekening
                </a>

                <a href="/admin/expenses" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition <?= $navClass('admin/expenses') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 1v22"></path>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Pengeluaran
                </a>

                <a href="/admin/reports" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition <?= $navClass('admin/reports') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M4 19V5"></path>
                        <path d="M4 19h16"></path>
                        <path d="M8 16v-5"></path>
                        <path d="M12 16V8"></path>
                        <path d="M16 16v-3"></path>
                    </svg>
                    Laporan
                </a>

            </nav>


            <!-- LOGOUT -->
            <div class="absolute bottom-5 left-5 right-5">
                <a
                    href="/logout"
                    class="flex items-center justify-center gap-2 rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm font-extrabold text-red-600 transition hover:bg-red-600 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M10 17l5-5-5-5"></path>
                        <path d="M15 12H3"></path>
                        <path d="M21 3v18"></path>
                    </svg>
                    Logout
                </a>
            </div>
        </aside>


        <!-- MAIN CONTENT -->
        <main class="min-h-screen md:pl-72">

            <!-- DESKTOP TOPBAR -->
            <header class="sticky top-0 z-30 hidden border-b border-slate-100 bg-white/85 px-8 py-5 backdrop-blur md:block">
                <div class="flex items-center justify-between gap-5">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-950">
                            <?= esc($title ?? 'Dashboard') ?>
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Kelola operasional self laundry dari satu dashboard.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden rounded-2xl border border-wish-100 bg-wish-50 px-4 py-2 text-sm font-bold text-wish-700 lg:block">
                            Admin Panel
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-white font-extrabold">
                            <?= strtoupper(substr(session()->get('name') ?? 'A', 0, 1)) ?>
                        </div>
                    </div>
                </div>
            </header>


            <!-- MOBILE PAGE TITLE -->
            <section class="px-4 pt-5 md:hidden">
                <h1 class="text-2xl font-extrabold tracking-tight text-slate-950">
                    <?= esc($title ?? 'Dashboard') ?>
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Halo, <?= esc(session()->get('name') ?? 'Admin') ?>
                </p>
            </section>


            <!-- CONTENT WRAPPER -->
            <section class="p-4 md:p-8">
                <?= view('partials/flash') ?>

                <div class="mt-4">
                    <?= $content ?? '' ?>
                </div>
            </section>

        </main>

    </div>


    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>

</html>