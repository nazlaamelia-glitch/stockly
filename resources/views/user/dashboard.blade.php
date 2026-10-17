<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Sapaan -->
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-[#a8823c]">Selamat datang</p>
                <h3 class="font-display mt-1 text-2xl sm:text-3xl text-[#0f1c2e]">Halo, {{ Auth::user()->name }}</h3>
                <div class="mt-3 h-px w-16 bg-[#c9a45c]"></div>
                <p class="mt-3 text-sm text-slate-500">Lihat produk yang tersedia beserta stok dan harganya.</p>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:gap-4">
                <x-stat-card label="Jumlah Produk" :value="$totalProducts" icon="cube"
                    :href="route('user.products.index')" />
                <x-stat-card label="Jumlah Kategori" :value="$totalCategories" icon="tag" />
            </div>

            <div>
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-display text-lg text-[#0f1c2e]">Produk Terbaru</h3>
                    <a href="{{ route('user.products.index') }}" class="text-sm text-[#a8823c] hover:text-[#0f1c2e]">
                        Lihat semua
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                    @forelse ($latestProducts as $product)
                        <a href="{{ route('user.products.show', $product) }}"
                            class="block bg-white p-4 rounded-xl border border-[#eee6d6] shadow-sm hover:border-[#c9a45c] hover:shadow-md transition">
                            <p class="text-xs uppercase tracking-wide text-[#a8823c]">{{ $product->category->name }}</p>
                            <p class="mt-1 font-semibold text-[#0f1c2e]">{{ $product->name }}</p>
                            <p class="mt-2 text-sm text-slate-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada produk.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>