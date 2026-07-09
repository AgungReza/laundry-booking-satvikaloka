<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WISH LAUNDRY — Booking Mesin Self Laundry</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: "#effcf9",
                            100: "#d7f7ef",
                            200: "#b3eee0",
                            300: "#80dfcd",
                            400: "#49cbb5",
                            500: "#2bbfa4",
                            600: "#1f9d87",
                            700: "#1c7d6e",
                            800: "#1b6459",
                            900: "#19534b"
                        }
                    },
                    fontFamily: {
                        sans: ["Poppins", "sans-serif"]
                    },
                    boxShadow: {
                        soft: "0 20px 60px rgba(15, 23, 42, 0.08)",
                        glow: "0 16px 40px rgba(43, 191, 164, 0.22)"
                    },
                    animation: {
                        float: "float 5s ease-in-out infinite",
                        pulseSoft: "pulseSoft 2.4s ease-in-out infinite"
                    },
                    keyframes: {
                        float: {
                            "0%, 100%": {
                                transform: "translateY(0)"
                            },
                            "50%": {
                                transform: "translateY(-12px)"
                            }
                        },
                        pulseSoft: {
                            "0%, 100%": {
                                opacity: "1"
                            },
                            "50%": {
                                opacity: ".55"
                            }
                        }
                    }
                }
            }
        };
    </script>

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .hero-grid {
            background-image:
                linear-gradient(rgba(43, 191, 164, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(43, 191, 164, 0.06) 1px, transparent 1px);
            background-size: 34px 34px;
            mask-image: linear-gradient(to bottom, black, transparent);
        }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0);
        }

        .nav-link.active {
            color: #1f9d87;
        }

        .nav-link.active::after {
            width: 100%;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="overflow-x-hidden bg-white text-slate-800 antialiased">

    <!-- NOTIFICATION BAR -->
    <div class="bg-slate-900 px-4 py-2.5 text-center text-xs text-white sm:text-sm">
        <p class="flex flex-wrap items-center justify-center gap-2">
            <span class="inline-block h-2 w-2 animate-pulseSoft rounded-full bg-brand-400"></span>
            Booking mesin lebih mudah tanpa perlu antre di lokasi.
            <button
                type="button"
                data-open-booking
                class="font-semibold text-brand-300 underline underline-offset-4 transition hover:text-white">
                Mulai booking
            </button>
        </p>
    </div>

    <!-- NAVBAR -->
    <header id="navbar" class="sticky top-0 z-40 border-b border-transparent bg-white/90 backdrop-blur-xl transition-all">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
            <a href="#beranda" class="flex items-center gap-3" aria-label="WISH LAUNDRY">
                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-brand-500 text-white shadow-glow">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2zm3 4h.01M12 7h3m-8 5a5 5 0 1010 0 5 5 0 00-10 0z" />
                    </svg>
                </span>
                <div>
                    <p class="text-lg font-extrabold leading-none tracking-tight text-slate-900">
                        WISH <span class="text-brand-500">LAUNDRY</span>
                    </p>
                    <p class="mt-1 text-[10px] font-medium tracking-[0.2em] text-slate-400">
                        SELF LAUNDRY • BOOKING MESIN
                    </p>
                </div>
            </a>

            <nav class="hidden items-center gap-7 lg:flex" aria-label="Navigasi utama">
                <a href="#beranda" class="nav-link relative text-sm font-medium text-slate-600 transition hover:text-brand-600 after:absolute after:-bottom-2 after:left-0 after:h-0.5 after:w-0 after:bg-brand-500 after:transition-all">Beranda</a>
                <a href="#keunggulan" class="nav-link relative text-sm font-medium text-slate-600 transition hover:text-brand-600 after:absolute after:-bottom-2 after:left-0 after:h-0.5 after:w-0 after:bg-brand-500 after:transition-all">Keunggulan</a>
                <a href="#mesin" class="nav-link relative text-sm font-medium text-slate-600 transition hover:text-brand-600 after:absolute after:-bottom-2 after:left-0 after:h-0.5 after:w-0 after:bg-brand-500 after:transition-all">Mesin & Harga</a>
                <a href="#cara-booking" class="nav-link relative text-sm font-medium text-slate-600 transition hover:text-brand-600 after:absolute after:-bottom-2 after:left-0 after:h-0.5 after:w-0 after:bg-brand-500 after:transition-all">Cara Booking</a>
                <a href="#faq" class="nav-link relative text-sm font-medium text-slate-600 transition hover:text-brand-600 after:absolute after:-bottom-2 after:left-0 after:h-0.5 after:w-0 after:bg-brand-500 after:transition-all">FAQ</a>
                <a href="#kontak" class="nav-link relative text-sm font-medium text-slate-600 transition hover:text-brand-600 after:absolute after:-bottom-2 after:left-0 after:h-0.5 after:w-0 after:bg-brand-500 after:transition-all">Kontak</a>
            </nav>

            <div class="hidden items-center gap-3 lg:flex">
                <a href="<?= site_url('login') ?>" class="rounded-full border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700">
                    Masuk
                </a>
                <a href="<?= site_url('register') ?>" class="rounded-full bg-brand-500 px-5 py-2.5 text-sm font-semibold text-white shadow-glow transition hover:-translate-y-0.5 hover:bg-brand-600">
                    Daftar Customer
                </a>
            </div>

            <button
                id="mobileMenuButton"
                type="button"
                class="grid h-11 w-11 place-items-center rounded-xl border border-slate-200 text-slate-700 transition hover:border-brand-300 hover:text-brand-600 lg:hidden"
                aria-label="Buka menu"
                aria-expanded="false">
                <svg id="menuIcon" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg id="closeIcon" class="hidden h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>

        <div id="mobileMenu" class="hidden border-t border-slate-100 bg-white lg:hidden">
            <nav class="mx-auto flex max-w-7xl flex-col px-5 py-5">
                <a href="#beranda" class="mobile-link rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700">Beranda</a>
                <a href="#keunggulan" class="mobile-link rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700">Keunggulan</a>
                <a href="#mesin" class="mobile-link rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700">Mesin & Harga</a>
                <a href="#cara-booking" class="mobile-link rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700">Cara Booking</a>
                <a href="#faq" class="mobile-link rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700">FAQ</a>
                <a href="#kontak" class="mobile-link rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700">Kontak</a>

                <div class="mt-4 grid grid-cols-2 gap-3 border-t border-slate-100 pt-4">
                    <a href="<?= site_url('login') ?>" class="rounded-xl border border-slate-200 px-4 py-3 text-center text-sm font-semibold text-slate-700">
                        Masuk
                    </a>
                    <a href="<?= site_url('register') ?>" class="rounded-xl bg-brand-500 px-4 py-3 text-center text-sm font-semibold text-white">
                        Daftar
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section id="beranda" class="relative isolate overflow-hidden">
        <div class="hero-grid absolute inset-0 -z-20"></div>
        <div class="absolute -left-32 top-20 -z-10 h-96 w-96 rounded-full bg-brand-100/80 blur-3xl"></div>
        <div class="absolute -right-32 bottom-0 -z-10 h-96 w-96 rounded-full bg-cyan-100/70 blur-3xl"></div>

        <div class="mx-auto grid min-h-[calc(100vh-110px)] max-w-7xl items-center gap-14 px-5 py-16 lg:grid-cols-[1.08fr_.92fr] lg:px-8 lg:py-20">
            <div class="reveal">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-brand-200 bg-white px-4 py-2 text-xs font-semibold text-brand-700 shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Self laundry dengan sistem booking mesin
                </div>

                <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.15] tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                    Cuci pakaian sendiri
                    <span class="relative inline-block text-brand-500">
                        tanpa perlu antre.
                    </span>
                </h1>

                <p class="mt-7 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
                    Pilih tanggal kedatangan, jam, mesin, durasi, dan add-on melalui dashboard.
                    Setelah bukti pembayaran diverifikasi admin, mesin resmi terbooking untuk jadwal Anda.
                </p>

                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <button
                        type="button"
                        data-open-booking
                        class="group inline-flex items-center justify-center gap-3 rounded-full bg-brand-500 px-7 py-4 text-sm font-semibold text-white shadow-glow transition hover:-translate-y-1 hover:bg-brand-600">
                        Booking Mesin
                        <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <a href="#cara-booking" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-7 py-4 text-sm font-semibold text-slate-700 transition hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700">
                        Lihat Cara Booking
                    </a>
                </div>

                <div class="mt-10 grid max-w-xl grid-cols-2 gap-4 sm:grid-cols-4">
                    <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                        <p class="text-lg font-extrabold text-slate-900">Real-time</p>
                        <p class="mt-1 text-[10px] text-slate-500">Cek mesin tersedia</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                        <p class="text-lg font-extrabold text-slate-900">30–120</p>
                        <p class="mt-1 text-[10px] text-slate-500">Pilihan menit</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                        <p class="text-lg font-extrabold text-slate-900">60 Menit</p>
                        <p class="mt-1 text-[10px] text-slate-500">Upload bukti bayar</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                        <p class="text-lg font-extrabold text-slate-900">Transfer</p>
                        <p class="mt-1 text-[10px] text-slate-500">Verifikasi admin</p>
                    </div>
                </div>
            </div>

            <div class="reveal relative mx-auto w-full max-w-xl">
                <div class="absolute -left-5 top-16 z-20 hidden animate-float rounded-2xl border border-white/70 bg-white/90 p-4 shadow-soft backdrop-blur sm:block">
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-100 text-emerald-600">✓</span>
                        <div>
                            <p class="text-xs text-slate-400">Status Mesin</p>
                            <p class="text-sm font-bold text-slate-800">Tersedia Sekarang</p>
                        </div>
                    </div>
                </div>

                <div class="absolute -right-3 bottom-20 z-20 hidden rounded-2xl border border-white/70 bg-white/90 p-4 shadow-soft backdrop-blur sm:block">
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-sky-100 text-sky-600">⏱</span>
                        <div>
                            <p class="text-xs text-slate-400">Durasi Booking</p>
                            <p class="text-sm font-bold text-slate-800">30–120 Menit</p>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[2rem] border-[10px] border-white bg-white shadow-soft">
                    <img
                        src="https://images.unsplash.com/photo-1604335399105-a0c585fd81a1?w=900&q=85"
                        alt="Mesin self laundry WISH LAUNDRY"
                        class="h-[500px] w-full object-cover">
                    <div class="absolute inset-x-5 bottom-5 rounded-2xl bg-slate-950/85 p-5 text-white backdrop-blur">
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-[0.2em] text-brand-300">Booking dari dashboard</p>
                                <h2 class="mt-2 text-xl font-bold">Pilih Mesin Sesuai Jadwal</h2>
                            </div>
                            <span class="rounded-full bg-white/10 px-3 py-1.5 text-xs">Tanpa antre</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-5 pb-16 lg:px-8">
            <div class="reveal grid overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-soft sm:grid-cols-2 lg:grid-cols-4">
                <div class="border-b border-slate-100 p-7 text-center sm:border-r lg:border-b-0">
                    <p class="counter text-3xl font-extrabold text-slate-900" data-target="8" data-suffix=" Unit">0</p>
                    <p class="mt-2 text-sm text-slate-500">Mesin Cuci & Pengering</p>
                </div>
                <div class="border-b border-slate-100 p-7 text-center lg:border-b-0 lg:border-r">
                    <p class="counter text-3xl font-extrabold text-slate-900" data-target="4" data-suffix=" Pilihan">0</p>
                    <p class="mt-2 text-sm text-slate-500">Durasi Penggunaan</p>
                </div>
                <div class="border-b border-slate-100 p-7 text-center sm:border-b-0 sm:border-r">
                    <p class="counter text-3xl font-extrabold text-slate-900" data-target="15" data-suffix=" Menit">0</p>
                    <p class="mt-2 text-sm text-slate-500">Buffer Antar Booking</p>
                </div>
                <div class="p-7 text-center">
                    <p class="counter text-3xl font-extrabold text-slate-900" data-target="60" data-suffix=" Menit">0</p>
                    <p class="mt-2 text-sm text-slate-500">Deadline Upload Bukti</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section id="keunggulan" class="relative py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-16 px-5 lg:grid-cols-2 lg:px-8">
            <div class="reveal relative">
                <div class="grid grid-cols-2 gap-4">
                    <img
                        src="https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=900&q=85"
                        alt="Area self laundry yang bersih"
                        class="col-span-2 h-72 w-full rounded-[2rem] object-cover shadow-soft">
                    <img
                        src="https://images.unsplash.com/photo-1545173168-9f1947eebb7f?w=600&q=85"
                        alt="Mesin self laundry modern"
                        class="h-52 w-full rounded-[2rem] object-cover">
                    <div class="flex h-52 flex-col justify-between rounded-[2rem] bg-brand-500 p-6 text-white">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white/15">✓</span>
                        <div>
                            <p class="text-3xl font-extrabold">Praktis</p>
                            <p class="mt-1 text-sm text-white/80">Datang sesuai jadwal dan langsung gunakan mesin.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-600">Self Laundry WISH</p>
                <h2 class="mt-4 text-3xl font-extrabold leading-tight text-slate-950 sm:text-4xl">
                    Anda mencuci sendiri, kami menyiapkan sistem dan mesinnya.
                </h2>
                <p class="mt-6 text-base leading-8 text-slate-600">
                    WISH LAUNDRY bukan layanan laundry kiloan atau antar-jemput. Customer datang ke lokasi,
                    menggunakan mesin secara mandiri, dan memperoleh slot penggunaan melalui sistem booking.
                </p>

                <div class="mt-8 grid gap-5 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-brand-100 text-brand-600">▣</span>
                        <h3 class="mt-4 font-bold text-slate-900">Booking Sebelum Datang</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Pilih tanggal dan jam agar tidak perlu menunggu mesin kosong.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-sky-100 text-sky-600">◉</span>
                        <h3 class="mt-4 font-bold text-slate-900">Ketersediaan Real-time</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Sistem hanya menampilkan mesin yang tersedia pada jadwal pilihan.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-amber-100 text-amber-600">⏱</span>
                        <h3 class="mt-4 font-bold text-slate-900">Durasi Fleksibel</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Pilih durasi 30, 60, 90, atau 120 menit sesuai aturan mesin.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-100 text-emerald-600">✓</span>
                        <h3 class="mt-4 font-bold text-slate-900">Upload Bukti Pembayaran</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Customer upload bukti transfer, lalu admin melakukan verifikasi pembayaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MESIN DAN HARGA -->
    <section id="mesin" class="bg-slate-50 py-24">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="reveal mx-auto max-w-2xl text-center">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-600">Mesin & Harga</p>
                <h2 class="mt-4 text-3xl font-extrabold text-slate-950 sm:text-4xl">
                    Pilih mesin sesuai kapasitas cucian
                </h2>
                <p class="mt-5 leading-7 text-slate-600">
                    Harga berikut adalah contoh tampilan landing page. Harga asli tetap dihitung dari data mesin di dashboard admin.
                </p>
            </div>

            <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php
                $machines = [
                    ['type' => 'Mesin Cuci', 'name' => 'Washer 8 kg', 'price' => 'Rp9.000', 'desc' => 'Cocok untuk cucian harian dengan jumlah ringan hingga sedang.'],
                    ['type' => 'Mesin Cuci', 'name' => 'Washer 10 kg', 'price' => 'Rp10.000', 'desc' => 'Pilihan ideal untuk cucian keluarga dengan kapasitas lebih besar.'],
                    ['type' => 'Mesin Cuci', 'name' => 'Washer 12 kg', 'price' => 'Rp12.500', 'desc' => 'Untuk cucian lebih banyak atau bahan berukuran besar.'],
                    ['type' => 'Pengering', 'name' => 'Dryer 8 kg', 'price' => 'Rp9.000', 'desc' => 'Mengeringkan pakaian harian dalam kapasitas ringan.'],
                    ['type' => 'Pengering', 'name' => 'Dryer 10 kg', 'price' => 'Rp10.000', 'desc' => 'Pengering berkapasitas sedang untuk kebutuhan keluarga.'],
                    ['type' => 'Pengering', 'name' => 'Dryer 12 kg', 'price' => 'Rp12.500', 'desc' => 'Untuk pakaian tebal atau jumlah cucian yang lebih banyak.'],
                ];
                ?>

                <?php foreach ($machines as $index => $machine): ?>
                    <article class="reveal rounded-3xl border <?= $index === 0 ? 'border-brand-200 shadow-glow' : 'border-slate-100 shadow-sm' ?> bg-white p-7 transition hover:-translate-y-2 hover:shadow-soft">
                        <div class="flex items-start justify-between">
                            <span class="grid h-14 w-14 place-items-center rounded-2xl <?= $machine['type'] === 'Pengering' ? 'bg-sky-100 text-sky-600' : 'bg-brand-100 text-brand-600' ?>">
                                <?= $machine['type'] === 'Pengering' ? '◎' : '◉' ?>
                            </span>
                            <span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700">
                                <?= esc($machine['type']) ?>
                            </span>
                        </div>

                        <h3 class="mt-6 text-xl font-bold"><?= esc($machine['name']) ?></h3>
                        <p class="mt-3 text-sm leading-7 text-slate-500"><?= esc($machine['desc']) ?></p>

                        <div class="mt-6 flex items-end justify-between border-t border-slate-100 pt-5">
                            <div>
                                <p class="text-xs text-slate-400">Mulai dari</p>
                                <p class="mt-1 text-xl font-extrabold">
                                    <?= esc($machine['price']) ?>
                                    <span class="text-xs font-medium text-slate-400">/30 menit</span>
                                </p>
                            </div>

                            <button data-open-booking class="rounded-full bg-brand-500 px-4 py-2 text-xs font-semibold text-white">
                                Booking
                            </button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="reveal mt-8 rounded-2xl border border-amber-200 bg-amber-50 p-5 text-center">
                <p class="text-sm font-bold text-amber-800">Catatan</p>
                <p class="mt-2 text-xs leading-6 text-amber-700">
                    Mesin yang sedang digunakan, terbooking, maintenance, tidak aktif, atau rusak tidak dapat dipilih.
                </p>
            </div>
        </div>
    </section>

    <!-- CARA BOOKING -->
    <section id="cara-booking" class="relative overflow-hidden bg-white pb-16 pt-24">
        <div class="pointer-events-none absolute -left-32 top-20 h-80 w-80 rounded-full bg-brand-100/70 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-32 bottom-10 h-80 w-80 rounded-full bg-cyan-100/60 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-5 lg:px-8">
            <div class="reveal mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full border border-brand-200 bg-brand-50 px-4 py-2">
                    <span class="h-2 w-2 rounded-full bg-brand-500"></span>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-brand-700">
                        Cara Booking
                    </p>
                </div>

                <h2 class="mt-5 text-3xl font-extrabold leading-tight text-slate-950 sm:text-4xl">
                    Booking mesin self laundry
                    <span class="text-brand-500">dalam beberapa langkah</span>
                </h2>

                <p class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                    Pilih jadwal dan mesin sebelum datang. Mesin resmi terbooking
                    setelah bukti pembayaran diterima dan dikonfirmasi oleh admin.
                </p>
            </div>

            <div class="reveal relative mt-16 rounded-[2rem] border border-slate-100 bg-white p-5 shadow-soft sm:p-8 lg:p-10">
                <div class="absolute left-[10%] right-[10%] top-[87px] hidden border-t-2 border-dashed border-brand-200 lg:block"></div>

                <div class="relative grid gap-6 sm:grid-cols-2 lg:grid-cols-6">
                    <?php
                    $steps = [
                        ['title' => 'Daftar dan Login', 'desc' => 'Buat akun customer, kemudian masuk ke dashboard.', 'color' => 'brand'],
                        ['title' => 'Pilih Jadwal', 'desc' => 'Tentukan tanggal dan jam kedatangan ke lokasi.', 'color' => 'brand'],
                        ['title' => 'Pilih Mesin', 'desc' => 'Sistem menampilkan mesin yang tersedia pada jadwal tersebut.', 'color' => 'brand'],
                        ['title' => 'Atur Durasi', 'desc' => 'Pilih durasi 30, 60, 90, atau 120 menit dan add-on.', 'color' => 'brand'],
                        ['title' => 'Bayar dan Upload Bukti', 'desc' => 'Transfer sesuai total dan upload bukti pembayaran dalam 60 menit.', 'color' => 'amber'],
                        ['title' => 'Booking Dikonfirmasi', 'desc' => 'Admin menyetujui pembayaran dan mesin resmi terbooking.', 'color' => 'emerald'],
                    ];
                    ?>

                    <?php foreach ($steps as $i => $step): ?>
                        <article class="group relative rounded-3xl border border-slate-100 bg-slate-50 p-5 text-center transition duration-300 hover:-translate-y-2 hover:border-brand-200 hover:bg-white hover:shadow-soft">
                            <div class="relative z-10 mx-auto grid h-16 w-16 place-items-center rounded-2xl <?= $step['color'] === 'amber' ? 'bg-amber-500' : ($step['color'] === 'emerald' ? 'bg-emerald-500' : 'bg-brand-500') ?> text-white shadow-glow transition group-hover:rotate-3">
                                <?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?>
                            </div>

                            <span class="mt-5 inline-flex rounded-full bg-brand-100 px-3 py-1 text-[10px] font-bold text-brand-700">
                                LANGKAH <?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?>
                            </span>

                            <h3 class="mt-3 text-sm font-bold text-slate-900">
                                <?= esc($step['title']) ?>
                            </h3>

                            <p class="mt-2 text-xs leading-6 text-slate-500">
                                <?= esc($step['desc']) ?>
                            </p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="reveal mt-8 grid gap-5 lg:grid-cols-2">
                <article class="relative overflow-hidden rounded-3xl border border-rose-200 bg-gradient-to-br from-rose-50 to-white p-6">
                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center">
                        <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-rose-100 text-rose-600">!</span>
                        <div class="flex-1">
                            <span class="rounded-full bg-rose-100 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-rose-700">
                                Booking Kedaluwarsa
                            </span>
                            <h3 class="mt-3 font-bold text-slate-900">
                                Belum upload bukti pembayaran
                            </h3>
                            <p class="mt-2 text-sm leading-7 text-slate-600">
                                Jika dalam 60 menit customer belum upload bukti pembayaran,
                                booking otomatis dibatalkan dan slot mesin tersedia kembali.
                            </p>
                        </div>
                    </div>
                </article>

                <article class="relative overflow-hidden rounded-3xl border border-sky-200 bg-gradient-to-br from-sky-50 to-white p-6">
                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center">
                        <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-sky-100 text-sky-600">⏱</span>
                        <div class="flex-1">
                            <span class="rounded-full bg-sky-100 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-sky-700">
                                Menunggu Verifikasi
                            </span>
                            <h3 class="mt-3 font-bold text-slate-900">
                                Sudah upload bukti pembayaran
                            </h3>
                            <p class="mt-2 text-sm leading-7 text-slate-600">
                                Status berubah menjadi menunggu verifikasi admin.
                                Slot mesin tetap dikunci sampai admin menerima atau menolak pembayaran.
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="px-5 pb-24 lg:px-8">
        <div class="reveal relative mx-auto max-w-7xl overflow-hidden rounded-[2.5rem] bg-slate-950 px-6 py-14 text-white sm:px-12 lg:px-16">
            <div class="absolute -right-20 -top-28 h-80 w-80 rounded-full bg-brand-500/20 blur-3xl"></div>

            <div class="relative grid items-center gap-10 lg:grid-cols-[1fr_auto]">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-300">Datang tanpa antre</p>
                    <h2 class="mt-4 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl">
                        Tentukan jadwal dan amankan mesin sebelum datang.
                    </h2>
                    <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-300">
                        Booking hanya dapat dilakukan melalui dashboard customer setelah login.
                    </p>
                </div>

                <button
                    type="button"
                    data-open-booking
                    class="inline-flex items-center justify-center gap-3 rounded-full bg-brand-500 px-7 py-4 text-sm font-semibold text-white shadow-glow transition hover:-translate-y-1 hover:bg-brand-400">
                    Mulai Booking
                </button>
            </div>
        </div>
    </section>

    <!-- TESTIMONI -->
    <section id="testimoni" class="bg-brand-50 py-24">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="reveal flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-600">Testimoni</p>
                    <h2 class="mt-4 max-w-xl text-3xl font-extrabold text-slate-950 sm:text-4xl">
                        Pengalaman menggunakan self laundry
                    </h2>
                </div>
            </div>

            <div id="testimonialTrack" class="hide-scrollbar mt-12 flex snap-x snap-mandatory gap-6 overflow-x-auto scroll-smooth pb-4">
                <?php
                $testimonials = [
                    ['name' => 'Dinda Pratiwi', 'text' => 'Saya bisa melihat mesin yang kosong sebelum datang. Begitu sampai, langsung cuci tanpa menunggu.'],
                    ['name' => 'Rizky Aditya', 'text' => 'Pilihan durasinya jelas dan total pembayaran langsung dihitung. Proses booking-nya sangat praktis.'],
                    ['name' => 'Nadia Putri', 'text' => 'Upload bukti pembayaran mudah dan status booking bisa dipantau dari dashboard.'],
                    ['name' => 'Andi Saputra', 'text' => 'Saya suka karena dapat memilih washer, dryer, dan add-on sesuai kebutuhan.'],
                ];
                ?>

                <?php foreach ($testimonials as $testimonial): ?>
                    <article class="min-w-full snap-start rounded-3xl bg-white p-8 shadow-sm md:min-w-[calc(50%-12px)] lg:min-w-[calc(33.333%-16px)]">
                        <div class="text-amber-400">★★★★★</div>
                        <p class="mt-5 text-sm leading-7 text-slate-600">
                            “<?= esc($testimonial['text']) ?>”
                        </p>
                        <div class="mt-7">
                            <p class="font-bold"><?= esc($testimonial['name']) ?></p>
                            <p class="text-xs text-slate-400">Customer WISH LAUNDRY</p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-5 lg:grid-cols-[.8fr_1.2fr] lg:px-8">
            <div class="reveal">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-600">Pertanyaan Umum</p>
                <h2 class="mt-4 text-3xl font-extrabold leading-tight text-slate-950 sm:text-4xl">
                    Informasi sebelum menggunakan mesin
                </h2>
                <p class="mt-5 leading-7 text-slate-600">
                    Temukan informasi mengenai booking, pembayaran, penggunaan mesin, dan pembatalan.
                </p>
            </div>

            <div class="reveal space-y-4">
                <?php
                $faqs = [
                    [
                        'q' => 'Apakah WISH LAUNDRY mencucikan pakaian customer?',
                        'a' => 'Tidak. WISH LAUNDRY merupakan self laundry. Customer datang dan menggunakan mesin sendiri sesuai jadwal booking.'
                    ],
                    [
                        'q' => 'Apakah saya bisa langsung datang tanpa booking?',
                        'a' => 'Bisa apabila ada mesin kosong, tetapi booking disarankan agar Anda memperoleh slot penggunaan dan tidak perlu antre.'
                    ],
                    [
                        'q' => 'Bagaimana cara melakukan pembayaran?',
                        'a' => 'Pembayaran dilakukan melalui transfer manual. Setelah transfer, customer wajib upload bukti pembayaran melalui dashboard agar dapat diverifikasi admin.'
                    ],
                    [
                        'q' => 'Apa yang terjadi jika bukti pembayaran tidak diupload?',
                        'a' => 'Apabila bukti pembayaran tidak diupload dalam 60 menit, booking kedaluwarsa otomatis dan slot mesin dilepas.'
                    ],
                    [
                        'q' => 'Kapan mesin dinyatakan resmi terbooking?',
                        'a' => 'Mesin resmi terbooking setelah admin menerima pembayaran dan mengubah status booking menjadi dikonfirmasi.'
                    ],
                ];
                ?>

                <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item overflow-hidden rounded-2xl border border-slate-200 bg-white">
                        <button type="button" class="faq-button flex w-full items-center justify-between gap-4 px-6 py-5 text-left font-semibold" aria-expanded="false">
                            <?= esc($faq['q']) ?>
                            <svg class="faq-icon h-5 w-5 text-brand-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-width="1.8" d="M12 5v14M5 12h14" />
                            </svg>
                        </button>
                        <div class="faq-content max-h-0 overflow-hidden transition-all duration-300">
                            <p class="px-6 pb-5 text-sm leading-7 text-slate-500">
                                <?= esc($faq['a']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="kontak" class="bg-slate-950 py-20 text-white">
        <div class="mx-auto grid max-w-7xl gap-12 px-5 lg:grid-cols-[1fr_1.1fr] lg:px-8">
            <div class="reveal">
                <a href="#beranda" class="inline-flex items-center gap-3">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-500">◉</span>
                    <div>
                        <p class="text-xl font-extrabold">WISH <span class="text-brand-400">LAUNDRY</span></p>
                        <p class="text-[10px] tracking-[0.2em] text-slate-500">SELF LAUNDRY • BOOKING MESIN</p>
                    </div>
                </a>

                <p class="mt-6 max-w-md text-sm leading-7 text-slate-400">
                    Self laundry modern untuk customer yang ingin mencuci dan mengeringkan pakaian sendiri dengan jadwal yang lebih teratur.
                </p>

                <div class="mt-8 space-y-4 text-sm text-slate-300">
                    <p>📍 Jl. WISH LAUNDRY No. 10, Yogyakarta</p>
                    <p>☎ +62 821 0000 1234</p>
                    <p>✉ halo@wishlaundry.id</p>
                </div>
            </div>

            <div class="reveal grid gap-8 sm:grid-cols-3">
                <div>
                    <h3 class="font-bold">Navigasi</h3>
                    <ul class="mt-5 space-y-3 text-sm text-slate-400">
                        <li><a href="#beranda" class="hover:text-brand-400">Beranda</a></li>
                        <li><a href="#keunggulan" class="hover:text-brand-400">Keunggulan</a></li>
                        <li><a href="#mesin" class="hover:text-brand-400">Mesin & Harga</a></li>
                        <li><a href="#cara-booking" class="hover:text-brand-400">Cara Booking</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold">Akun Customer</h3>
                    <ul class="mt-5 space-y-3 text-sm text-slate-400">
                        <li><a href="<?= site_url('register') ?>" class="hover:text-brand-400">Daftar Akun</a></li>
                        <li><a href="<?= site_url('login') ?>" class="hover:text-brand-400">Masuk</a></li>
                        <li><a href="#faq" class="hover:text-brand-400">Pusat Bantuan</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold">Jam Operasional</h3>
                    <ul class="mt-5 space-y-3 text-sm text-slate-400">
                        <li class="flex justify-between gap-3"><span>Senin–Jumat</span><span class="text-slate-300">08.00–21.00</span></li>
                        <li class="flex justify-between gap-3"><span>Sabtu</span><span class="text-slate-300">08.00–20.00</span></li>
                        <li class="flex justify-between gap-3"><span>Minggu</span><span class="text-slate-300">09.00–18.00</span></li>
                    </ul>
                    <div class="mt-5 inline-flex items-center gap-2 rounded-full bg-brand-500/10 px-3 py-2 text-xs font-semibold text-brand-300">
                        <span class="h-2 w-2 rounded-full bg-brand-400"></span>
                        Self laundry buka
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto mt-14 flex max-w-7xl flex-col gap-4 border-t border-white/10 px-5 pt-7 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between lg:px-8">
            <p>© <span id="currentYear"></span> WISH LAUNDRY. Seluruh hak dilindungi.</p>
            <p>Sistem booking mesin self laundry.</p>
        </div>
    </section>

    <!-- BOOKING MODAL -->
    <div id="bookingModal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4" role="dialog" aria-modal="true">
        <div id="bookingOverlay" class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"></div>

        <div class="relative z-10 w-full max-w-lg overflow-hidden rounded-[2rem] bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-brand-600">Booking Mesin</p>
                    <h2 class="mt-1 text-xl font-extrabold text-slate-900">Masuk ke Dashboard Customer</h2>
                </div>

                <button id="closeBooking" type="button" class="grid h-10 w-10 place-items-center rounded-full bg-slate-100 text-slate-600 hover:bg-rose-50 hover:text-rose-600">
                    ×
                </button>
            </div>

            <div class="p-6 sm:p-8">
                <span class="mx-auto grid h-20 w-20 place-items-center rounded-[1.7rem] bg-brand-100 text-3xl text-brand-600">◉</span>

                <h3 class="mt-6 text-center text-lg font-extrabold text-slate-900">
                    Booking dilakukan setelah login
                </h3>

                <p class="mt-3 text-center text-sm leading-7 text-slate-500">
                    Melalui dashboard, Anda dapat memilih tanggal, jam kedatangan, mesin, durasi, add-on,
                    serta memantau pembayaran dan status booking.
                </p>

                <div class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 p-4">
                    <p class="text-xs font-bold text-amber-800">Tidak tersedia booking langsung dari landing page</p>
                    <p class="mt-1 text-[11px] leading-5 text-amber-700">
                        Hal ini menjaga agar setiap booking terhubung dengan akun dan riwayat customer.
                    </p>
                </div>

                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                    <a href="<?= site_url('login') ?>" class="rounded-xl border border-slate-200 px-5 py-3.5 text-center text-sm font-semibold text-slate-700 hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700">
                        Sudah Punya Akun
                    </a>
                    <a href="<?= site_url('register') ?>" class="rounded-xl bg-brand-500 px-5 py-3.5 text-center text-sm font-semibold text-white shadow-glow hover:bg-brand-600">
                        Daftar Customer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- BACK TO TOP -->
    <button
        id="backToTop"
        type="button"
        class="fixed bottom-5 left-5 z-30 hidden h-11 w-11 place-items-center rounded-full bg-slate-900 text-white shadow-lg transition hover:-translate-y-1 hover:bg-brand-600"
        aria-label="Kembali ke atas">
        ↑
    </button>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const navbar = document.getElementById("navbar");
            const mobileMenu = document.getElementById("mobileMenu");
            const mobileMenuButton = document.getElementById("mobileMenuButton");
            const menuIcon = document.getElementById("menuIcon");
            const closeIcon = document.getElementById("closeIcon");
            const mobileLinks = document.querySelectorAll(".mobile-link");
            const navLinks = document.querySelectorAll(".nav-link");
            const sections = document.querySelectorAll("section[id]");
            const backToTop = document.getElementById("backToTop");

            function setMobileMenu(open) {
                mobileMenu.classList.toggle("hidden", !open);
                menuIcon.classList.toggle("hidden", open);
                closeIcon.classList.toggle("hidden", !open);
                mobileMenuButton.setAttribute("aria-expanded", String(open));
            }

            mobileMenuButton.addEventListener("click", () => {
                setMobileMenu(mobileMenu.classList.contains("hidden"));
            });

            mobileLinks.forEach(link => {
                link.addEventListener("click", () => setMobileMenu(false));
            });

            function handleScrollState() {
                const scrollY = window.scrollY;

                navbar.classList.toggle("shadow-sm", scrollY > 10);
                navbar.classList.toggle("border-slate-100", scrollY > 10);
                backToTop.classList.toggle("hidden", scrollY < 500);
                backToTop.classList.toggle("grid", scrollY >= 500);

                let currentSection = "beranda";

                sections.forEach(section => {
                    if (scrollY >= section.offsetTop - 170) {
                        currentSection = section.id;
                    }
                });

                navLinks.forEach(link => {
                    link.classList.toggle("active", link.getAttribute("href") === `#${currentSection}`);
                });
            }

            window.addEventListener("scroll", handleScrollState, {
                passive: true
            });
            handleScrollState();

            backToTop.addEventListener("click", () => {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });

            const revealObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.12
            });

            document.querySelectorAll(".reveal").forEach(element => {
                revealObserver.observe(element);
            });

            const counterObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;

                    const counter = entry.target;
                    const target = Number(counter.dataset.target);
                    const suffix = counter.dataset.suffix || "";
                    const duration = 1300;
                    const startTime = performance.now();

                    function updateCounter(currentTime) {
                        const progress = Math.min((currentTime - startTime) / duration, 1);
                        const value = Math.floor(target * (1 - Math.pow(1 - progress, 3)));
                        counter.textContent = value.toLocaleString("id-ID") + suffix;

                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        }
                    }

                    requestAnimationFrame(updateCounter);
                    counterObserver.unobserve(counter);
                });
            }, {
                threshold: 0.6
            });

            document.querySelectorAll(".counter").forEach(counter => {
                counterObserver.observe(counter);
            });

            document.querySelectorAll(".faq-button").forEach(button => {
                button.addEventListener("click", () => {
                    const item = button.closest(".faq-item");
                    const content = item.querySelector(".faq-content");
                    const icon = item.querySelector(".faq-icon");
                    const isOpen = button.getAttribute("aria-expanded") === "true";

                    document.querySelectorAll(".faq-button").forEach(otherButton => {
                        const otherItem = otherButton.closest(".faq-item");
                        otherButton.setAttribute("aria-expanded", "false");
                        otherItem.querySelector(".faq-content").style.maxHeight = null;
                        otherItem.querySelector(".faq-icon").classList.remove("rotate-45");
                    });

                    if (!isOpen) {
                        button.setAttribute("aria-expanded", "true");
                        content.style.maxHeight = content.scrollHeight + "px";
                        icon.classList.add("rotate-45");
                    }
                });
            });

            const bookingModal = document.getElementById("bookingModal");
            const closeBooking = document.getElementById("closeBooking");
            const bookingOverlay = document.getElementById("bookingOverlay");
            const openBookingButtons = document.querySelectorAll("[data-open-booking]");

            function openBookingModal() {
                bookingModal.classList.remove("hidden");
                bookingModal.classList.add("flex");
                document.body.classList.add("overflow-hidden");
            }

            function closeBookingModal() {
                bookingModal.classList.add("hidden");
                bookingModal.classList.remove("flex");
                document.body.classList.remove("overflow-hidden");
            }

            openBookingButtons.forEach(button => {
                button.addEventListener("click", openBookingModal);
            });

            closeBooking.addEventListener("click", closeBookingModal);
            bookingOverlay.addEventListener("click", closeBookingModal);

            document.addEventListener("keydown", event => {
                if (event.key === "Escape") {
                    closeBookingModal();
                }
            });

            const currentYear = document.getElementById("currentYear");
            if (currentYear) {
                currentYear.textContent = new Date().getFullYear();
            }
        });
    </script>
</body>

</html>