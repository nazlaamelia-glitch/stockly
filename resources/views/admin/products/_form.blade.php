@csrf

<div>
    <x-input-label for="category_id" value="Kategori" />
    <select id="category_id" name="category_id" required
        class="mt-1 block w-full border-gray-300 focus:border-[#c9a45c] focus:ring-[#c9a45c] rounded-md shadow-sm">
        <option value="">-- Pilih kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @if ($categories->isEmpty())
        <p class="mt-2 text-sm text-red-600">
            Belum ada kategori. Tambahkan kategori dulu di menu Kategori.
        </p>
    @endif
    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
</div>

<div class="mt-4">
    <x-input-label for="name" value="Nama Produk" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
        :value="old('name', $product->name ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div class="mt-4">
    <x-input-label for="description" value="Deskripsi (opsional)" />
    <textarea id="description" name="description" rows="4"
        class="mt-1 block w-full border-gray-300 focus:border-[#c9a45c] focus:ring-[#c9a45c] rounded-md shadow-sm">{{ old('description', $product->description ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <x-input-label for="stock" value="Stok" />
        <x-text-input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full"
            :value="old('stock', $product->stock ?? 0)" required />
        <x-input-error class="mt-2" :messages="$errors->get('stock')" />
    </div>

    <div>
        <x-input-label for="price" value="Harga (Rp)" />
        <x-text-input id="price" name="price" type="number" min="0" class="mt-1 block w-full"
            :value="old('price', $product->price ?? 0)" required />
        <x-input-error class="mt-2" :messages="$errors->get('price')" />
    </div>
</div>

<div class="mt-6 flex items-center gap-4">
    <x-primary-button>Simpan</x-primary-button>
    <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
</div>