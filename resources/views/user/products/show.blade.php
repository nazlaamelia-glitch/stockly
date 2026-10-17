<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-xs uppercase tracking-wide text-[#c9a45c]">{{ $product->category->name }}</p>
                <h3 class="mt-1 text-2xl font-semibold text-[#0f1c2e]">{{ $product->name }}</h3>

                <p class="mt-3 text-xl text-slate-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                <div class="mt-3 flex items-center gap-3">
                    @if ($product->stock === 0)
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700">Habis</span>
                    @elseif ($product->isLowStock())
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Stok menipis</span>
                    @else
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Tersedia</span>
                    @endif
                    <span class="text-sm text-slate-500">Stok: {{ $product->stock }}</span>
                </div>

                <div class="mt-6 border-t border-gray-200 pt-4">
                    <h4 class="text-sm font-semibold text-[#0f1c2e]">Deskripsi</h4>
                    <p class="mt-2 text-slate-600">{{ $product->description ?: 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('user.products.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                        &larr; Kembali ke daftar produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>