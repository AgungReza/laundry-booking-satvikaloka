<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Wish Laundry</title>

    <script src="https://cdn.tailwindcss.com"></script>
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
                        },
                        darktext: '#0b1533'
                    },
                    boxShadow: {
                        soft: '0 10px 35px rgba(19, 53, 46, 0.10)'
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-white via-wish-50 to-wish-100 font-sans text-slate-700">

    <main class="min-h-screen grid place-items-center px-5 py-8">
        <div class="w-full max-w-6xl overflow-hidden rounded-[32px] bg-white shadow-soft grid lg:grid-cols-2">

            <!-- LEFT -->
            <section class="relative hidden lg:flex flex-col justify-between bg-[#f8fcfb] px-10 py-12 border-r border-slate-100 overflow-hidden">

                <!-- dekorasi background -->
                <div class="absolute inset-0 opacity-60" style="background-image: linear-gradient(to right, rgba(15,23,42,0.04) 1px, transparent 1px), linear-gradient(to bottom, rgba(15,23,42,0.04) 1px, transparent 1px); background-size: 34px 34px;"></div>

                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 rounded-full border border-wish-200 bg-white/90 px-4 py-2 text-sm font-medium text-wish-700 shadow-sm">
                        <span class="h-2.5 w-2.5 rounded-full bg-wish-500"></span>
                        Self laundry dengan sistem booking mesin
                    </div>

                    <h1 class="mt-8 text-5xl font-extrabold leading-tight tracking-tight text-darktext">
                        Login ke <br>
                        <span class="text-wish-500">Wish Laundry</span>
                    </h1>

                    <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                        Akses dashboard untuk booking mesin, pilih jadwal, cek status pembayaran,
                        dan nikmati layanan laundry mandiri tanpa antre.
                    </p>
                </div>

                <div class="relative z-10 grid grid-cols-4 gap-4">
                </div>
            </section>

            <!-- RIGHT -->
            <section class="flex items-center justify-center px-6 py-10 sm:px-10 lg:px-14">
                <div class="w-full max-w-md">

                    <!-- Mobile Brand -->
                    <div class="mb-8 lg:hidden">
                        <div class="inline-flex items-center gap-2 rounded-full border border-wish-200 bg-wish-50 px-4 py-2 text-sm font-medium text-wish-700">
                            <span class="h-2.5 w-2.5 rounded-full bg-wish-500"></span>
                            Wish Laundry
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-3xl font-extrabold tracking-tight text-darktext">
                            Selamat datang kembali
                        </h2>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Silakan login untuk mengakses akun dan melakukan booking mesin laundry Anda.
                        </p>
                    </div>

                    <?= view('partials/flash') ?>

                    <form method="post" action="/login" class="space-y-5">
                        <?= csrf_field() ?>

                        <!-- Email -->
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                                Email
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <!-- mail -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M4 6h16v12H4z"></path>
                                        <path d="m4 7 8 6 8-6"></path>
                                    </svg>
                                </span>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="<?= old('email') ?>"
                                    placeholder="Masukkan email"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition focus:border-wish-400 focus:bg-white focus:ring-4 focus:ring-wish-100"
                                    required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                                Password
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <!-- lock -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                        <path d="M8 11V8a4 4 0 1 1 8 0v3"></path>
                                    </svg>
                                </span>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="Masukkan password"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-14 text-sm text-slate-700 outline-none transition focus:border-wish-400 focus:bg-white focus:ring-4 focus:ring-wish-100"
                                    required>
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-500 hover:text-wish-600">
                                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <svg id="eyeOff" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M3 3l18 18"></path>
                                        <path d="M10.6 10.7a3 3 0 0 0 4 4"></path>
                                        <path d="M9.9 5.1A10.9 10.9 0 0 1 12 5c6.5 0 10 7 10 7a18.8 18.8 0 0 1-4.2 4.9"></path>
                                        <path d="M6.6 6.6C4 8.3 2 12 2 12a18.7 18.7 0 0 0 6.1 5.4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="inline-flex items-center gap-2 text-slate-600">
                                <input type="checkbox" class="rounded border-slate-300 text-wish-500 focus:ring-wish-300">
                                <span>Ingat saya</span>
                            </label>

                            <a href="#" class="font-semibold text-wish-600 hover:text-wish-700">
                                Lupa password?
                            </a>
                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-wish-500 py-3.5 text-sm font-bold text-white shadow-lg shadow-wish-200 transition hover:bg-wish-600 active:scale-[0.99]">
                            Login Sekarang
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-slate-500">
                        Belum punya akun?
                        <a href="/register" class="font-bold text-wish-600 hover:text-wish-700">
                            Daftar sekarang
                        </a>
                    </p>

                    <div class="mt-8 rounded-2xl border border-wish-100 bg-wish-50 p-4">
                        <p class="text-center text-sm font-medium text-wish-800">
                            Wish Laundry — self laundry modern, praktis, dan tanpa antre.
                        </p>
                    </div>

                </div>
            </section>

        </div>
    </main>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeOff = document.getElementById('eyeOff');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }
    </script>

</body>

</html>