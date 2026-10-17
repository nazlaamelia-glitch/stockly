<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kategori
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center px-4 py-2 bg-[#0f1c2e] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1b2f4b]">
                Tambah Kategori
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
                @forelse ($categories as $category)
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <p class="font-semibold text-[#0f1c2e]">{{ $category->name }}</p>
                        <p class="mt-1 text-sm text-gray-500">{{ $category->description ?? '-' }}</p>

                        <div class="mt-3 flex items-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="px-3 py-1.5 text-sm rounded-md border border-indigo-200 text-indigo-700">Ubah</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1.5 text-sm rounded-md border border-red-200 text-red-700">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="py-6 text-center text-sm text-gray-500">Belum ada kategori.</p>
                @endforelse
            </div>

            <!-- Laptop: tabel -->
            <div class="hidden md:block bg-white overflow-x-auto shadow-sm rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($categories as $category)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $categories->firstItem() + $loop->index }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $category->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $category->description ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Ubah</a>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>