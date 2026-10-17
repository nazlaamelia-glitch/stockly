<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600|playfair-display:600,700&display=swap" rel="stylesheet" />

        <style>
            body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
            .font-display { font-family: 'Playfair Display', Georgia, serif; }
            header h2 {
                font-family: 'Playfair Display', Georgia, serif !important;
                color: #0f1c2e !important;
                letter-spacing: 0.01em;
            }

            /* Kartu: tepi tipis berwarna krem supaya terasa lembut */
            main .bg-white.shadow-sm { border: 1px solid #eee6d6; }

            /* Tabel: header krem lembut, baris menyala halus saat disorot */
            main thead.bg-gray-50 { background-color: #faf5ea; }
            main thead th { color: #8a7648 !important; letter-spacing: 0.06em; }
            main tbody tr:hover { background-color: #fcfaf5; }

            /* Perapian khusus layar HP */
            @media (max-width: 639px) {
                main > .py-12 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
                main [class~="sm:rounded-lg"] { border-radius: 0.5rem; }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-[#faf7f2] text-slate-800">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b border-[#e8dfcf] shadow-sm">
                    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="px-4 sm:px-0">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>