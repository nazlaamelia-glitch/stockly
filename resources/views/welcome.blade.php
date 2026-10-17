<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Stockly') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600|playfair-display:600,700&display=swap" rel="stylesheet" />

        <style>
            body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
            .font-display { font-family: 'Playfair Display', Georgia, serif; }

            /* Latar: cahaya emas samar + motif titik halus di atas warna navy */
            .hero-bg {
                background:
                    radial-gradient(800px 480px at 85% 0%, rgba(201, 164, 92, 0.16), transparent 60%),
                    radial-gradient(600px 400px at 0% 100%, rgba(201, 164, 92, 0.07), transparent 60%),
                    radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                    #0f1c2e;
                background-size: auto, auto, 28px 28px;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased text-white">
        <div class="hero-bg min-h-screen flex flex-col">

            <!-- Menu atas -->
            <header class="max-w-6xl w-full mx-auto px-6 py-6 flex justify-between items-center">
                <a href="/" class="font-display text-2xl tracking-wide">
                    Stock<span class="text-[#c9a45c]">ly</span>
                </a>

                <nav class="flex items-center gap-2 text-sm">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 rounded-md bg-[#c9a45c] text-[#0f1c2e] font-semibold hover:bg-[#d8b672] transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-slate-300 hover:text-white transition">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-md border border-[#c9a45c] text-[#c9a45c] hover:bg-[#c9a45c] hover:text-[#0f1c2e] transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            </header>

            <!-- Bagian utama -->
            <main class="flex-1 flex items-center">
                <div class="max-w-6xl w-full mx-auto px-6 py-10 lg:py-16">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                        <!-- Teks -->
                        <div class="text-center lg:text-left">
                            <div class="flex items-center justify-center lg:justify-start gap-3">
                                <span class="hidden lg:block h-px w-10 bg-[#c9a45c]"></span>
                                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Inventory Management System</p>
                            </div>

                            <div class="lg:hidden mx-auto mt-5 h-px w-16 bg-[#c9a45c]"></div>

                            <h1 class="font-display mt-6 lg:mt-5 text-4xl sm:text-5xl leading-tight">
                                Kelola stok barang <span class="text-[#c9a45c]">dengan rapi</span>
                            </h1>

                            <p class="mt-6 text-slate-300 leading-relaxed max-w-xl mx-auto lg:mx-0">
                                Catat kategori dan produk, pantau jumlah stok,
                                dan lihat barang yang hampir habis dalam satu tempat.
                            </p>

                            <!-- Dua peran -->
                            <div class="mt-8 flex flex-wrap justify-center lg:justify-start gap-3">
                                <div class="px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-sm text-slate-300">
                                    <span class="font-semibold text-[#c9a45c]">Admin</span> mengelola kategori dan produk
                                </div>
                                <div class="px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-sm text-slate-300">
                                    <span class="font-semibold text-[#c9a45c]">User</span> melihat produk dan stok
                                </div>
                            </div>
                        </div>

                        <!-- Ilustrasi (hanya di layar lebar) -->
                        <div class="hidden lg:flex justify-center">
                            <div class="relative h-80 w-80">
                                <div class="absolute inset-0 rounded-full border border-[#c9a45c]/20"></div>
                                <div class="absolute inset-8 rounded-full border border-[#c9a45c]/30"></div>

                                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex h-36 w-36 items-center justify-center rounded-3xl bg-gradient-to-br from-[#c9a45c] to-[#e0c27f] shadow-2xl">
                                    <svg class="h-16 w-16 text-[#0f1c2e]" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>

                                <span class="absolute top-8 -left-4 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-sm text-slate-100">Kategori</span>
                                <span class="absolute top-1/2 -right-6 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-sm text-slate-100">Produk</span>
                                <span class="absolute bottom-8 left-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-sm text-slate-100">Stok</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tiga fitur utama -->
                    <div class="mt-14 lg:mt-20 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="p-5 rounded-xl bg-white/5 border border-white/10">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#c9a45c]/15 text-[#c9a45c]">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </span>
                            <p class="mt-4 font-semibold">Kategori dan Produk</p>
                            <p class="mt-1 text-sm text-slate-400">Atur barang berdasarkan kategori dengan data yang terstruktur.</p>
                        </div>

                        <div class="p-5 rounded-xl bg-white/5 border border-white/10">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#c9a45c]/15 text-[#c9a45c]">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                                </svg>
                            </span>
                            <p class="mt-4 font-semibold">Pantau Stok</p>
                            <p class="mt-1 text-sm text-slate-400">Lihat jumlah stok dan harga setiap produk kapan saja.</p>
                        </div>

                        <div class="p-5 rounded-xl bg-white/5 border border-white/10">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#c9a45c]/15 text-[#c9a45c]">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                </svg>
                            </span>
                            <p class="mt-4 font-semibold">Peringatan Stok Menipis</p>
                            <p class="mt-1 text-sm text-slate-400">Produk dengan stok rendah langsung terlihat di dashboard admin.</p>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-6 text-center text-xs text-slate-500">
                &copy; {{ date('Y') }} Stockly
            </footer>
        </div>
    </body>
</html>