@csrf

<div>
    <x-input-label for="name" value="Nama Kategori" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
        :value="old('name', $category->name ?? '')" required autofocus />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div class="mt-4">
    <x-input-label for="description" value="Deskripsi (opsional)" />
    <textarea id="description" name="description" rows="4"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $category->description ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div class="mt-6 flex items-center gap-4">
    <x-primary-button>Simpan</x-primary-button>
    <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
</div>