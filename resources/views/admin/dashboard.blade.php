<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Sapaan -->
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-[#a8823c]">Selamat datang</p>
                <h3 class="font-display mt-1 text-2xl sm:text-3xl text-[#0f1c2e]">Halo, {{ Auth::user()->name }}</h3>
                <div class="mt-3 h-px w-16 bg-[#c9a45c]"></div>
                <p class="mt-3 text-sm text-slate-500">Ringkasan kategori, produk, dan stok.</p>
            </div>

            <!-- Kartu ringkasan (bisa diklik) -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <x-stat-card label="Total Kategori" :value="$totalCategories" icon="tag"
                    :href="route('admin.categories.index')" />
                <x-stat-card label="Total Produk" :value="$totalProducts" icon="cube"
                    :href="route('admin.products.index')" />
                <x-stat-card label="Total Stok" :value="number_format($totalStock, 0, ',', '.')" icon="stack"
                    :href="route('admin.products.index')" />
                <x-stat-card label="Produk Stok Rendah" :value="$lowStockCount" icon="alert" :danger="true"
                    href="#stok-rendah" />
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

                <!-- Grafik stok per kategori -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-5 sm:p-6">
                    <h3 class="font-display text-lg text-[#0f1c2e]">Stok per Kategori</h3>
                    <p class="text-sm text-slate-500">Total stok produk di tiap kategori.</p>

                    <div class="mt-5 space-y-4">
                        @forelse ($categoryStocks as $category)
                            @php
                                $stock = (int) ($category->products_sum_stock ?? 0);
                                $percent = round($stock / $maxCategoryStock * 100);
                            @endphp
                            <div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-700">{{ $category->name }}</span>
                                    <span class="text-slate-500">{{ number_format($stock, 0, ',', '.') }}</span>
                                </div>
                                <div class="mt-1.5 h-1.5 rounded-full bg-[#f3ecdf]">
                                    <div class="h-1.5 rounded-full bg-[#c9a45c]" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada kategori.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Stok rendah -->
                <div id="stok-rendah" class="lg:col-span-3 bg-white shadow-sm rounded-xl overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-[#eee6d6]">
                        <h3 class="font-display text-lg text-[#0f1c2e]">Produk dengan Stok Rendah</h3>
                        <p class="text-sm text-slate-500">Stok {{ \App\Models\Product::LOW_STOCK_LIMIT }} atau kurang.</p>
                    </div>

                    <!-- HP: daftar -->
                    <ul class="md:hidden divide-y divide-[#f1ead9]">
                        @forelse ($lowStockProducts as $product)
                            <li class="px-4 py-3 flex items-center justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                                </div>
                                <div class="flex items-center gap-3 shrink-0">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-700">
                                        {{ $product->stock }}
                                    </span>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="px-3 py-1.5 text-sm rounded-md border border-[#e8dfcf] text-[#0f1c2e]">Ubah</a>
                                </div>
                            </li>
                        @empty
                            <li class="px-4 py-6 text-center text-sm text-gray-500">Semua stok aman.</li>
                        @endforelse
                    </ul>

                    <!-- Laptop: tabel -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-[#f1ead9]">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#f1ead9]">
                                @forelse ($lowStockProducts as $product)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $product->category->name }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-700">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="text-[#a8823c] hover:text-[#0f1c2e]">Ubah stok</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Semua stok aman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>