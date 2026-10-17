<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Produk
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center px-4 py-2 bg-[#0f1c2e] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1b2f4b]">
                Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- HP: kartu -->
            <div class="md:hidden space-y-3">
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-xs uppercase tracking-wide text-[#c9a45c]">{{ $product->category->name }}</p>
                                <p class="font-semibold text-[#0f1c2e]">{{ $product->name }}</p>
                                <p class="mt-1 text-sm text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>

                            @if ($product->isLowStock())
                                <span class="shrink-0 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Stok {{ $product->stock }} (rendah)
                                </span>
                            @else
                                <span class="shrink-0 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                    Stok {{ $product->stock }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-3 flex items-center gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="px-3 py-1.5 text-sm rounded-md border border-indigo-200 text-indigo-700">Ubah</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1.5 text-sm rounded-md border border-red-200 text-red-700">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="py-6 text-center text-sm text-gray-500">Belum ada produk.</p>
                @endforelse
            </div>

            <!-- Laptop: tabel -->
            <div class="hidden md:block bg-white overflow-x-auto shadow-sm rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $products->firstItem() + $loop->index }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $product->category->name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($product->isLowStock())
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $product->stock }} (rendah)
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                            {{ $product->stock }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Ubah</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>