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
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-slate-800 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0f1c2e]">
            <div class="text-center">
                <a href="/" class="font-display text-4xl tracking-wide text-white">
                    Stock<span class="text-[#c9a45c]">ly</span>
                </a>
                <p class="mt-1 text-xs uppercase tracking-[0.3em] text-slate-400">Inventory Management</p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white border-t-4 border-[#c9a45c] shadow-xl overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>