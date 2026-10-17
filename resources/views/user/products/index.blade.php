<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Pencarian dan filter -->
            <form method="GET" action="{{ route('user.products.index') }}"
                class="mb-6 bg-white p-4 rounded-lg shadow-sm flex flex-col sm:flex-row gap-3">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama produk..."
                    class="flex-1 border-gray-300 focus:border-[#c9a45c] focus:ring-[#c9a45c] rounded-md shadow-sm">

                <select name="category"
                    class="border-gray-300 focus:border-[#c9a45c] focus:ring-[#c9a45c] rounded-md shadow-sm">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <x-primary-button>Cari</x-primary-button>
            </form>

            <!-- Daftar produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($products as $product)
                    <a href="{{ route('user.products.show', $product) }}"
                        class="block bg-white p-5 rounded-lg shadow-sm hover:shadow-md transition">
                        <p class="text-xs uppercase tracking-wide text-[#c9a45c]">{{ $product->category->name }}</p>
                        <p class="mt-1 font-semibold text-[#0f1c2e]">{{ $product->name }}</p>
                        <p class="mt-2 text-slate-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="mt-3">
                            @if ($product->stock === 0)
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700">Habis</span>
                            @elseif ($product->isLowStock())
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Stok menipis</span>
                            @else
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Tersedia</span>
                            @endif
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-sm text-slate-500">Produk tidak ditemukan.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>