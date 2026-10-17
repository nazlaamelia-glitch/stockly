@props(['label', 'value', 'icon' => 'cube', 'danger' => false, 'href' => null])

@php
    // Bentuk ikon sederhana (SVG), dipilih lewat nama
    $tag = $href ? 'a' : 'div';
    $paths = [
        'tag' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
        'cube' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
        'stack' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4',
        'alert' => 'M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z',
    ];
@endphp

<{{ $tag }} @if ($href) href="{{ $href }}" @endif
    class="flex flex-col items-start gap-3 sm:flex-row sm:items-center sm:gap-4 bg-white p-4 sm:p-5 rounded-xl border border-[#eee6d6] shadow-sm {{ $href ? 'hover:border-[#c9a45c] hover:shadow-md transition' : '' }}">

    <span class="shrink-0 flex h-10 w-10 items-center justify-center rounded-full {{ $danger ? 'bg-red-50 text-red-500' : 'bg-[#f6efe0] text-[#a8823c]' }}">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="{{ $paths[$icon] ?? $paths['cube'] }}" />
        </svg>
    </span>

    <span class="min-w-0">
        <span class="block text-xs sm:text-sm text-slate-500">{{ $label }}</span>
        <span class="font-display block text-2xl sm:text-3xl {{ $danger ? 'text-red-600' : 'text-[#0f1c2e]' }}">{{ $value }}</span>
    </span>
</{{ $tag }}>