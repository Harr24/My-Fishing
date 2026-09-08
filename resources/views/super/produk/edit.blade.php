<x-app-layout>
    <x-slot name="header">Edit Produk</x-slot>

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('produk.index') }}" class="bg-white border-3 border-ink p-2 shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 text-ink">
                <path stroke-linecap="square" stroke-linejoin="miter" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h2 class="font-display font-bold text-2xl text-ink">Edit Alat Pancing</h2>
    </div>

    <!-- Perhatikan method di bawah adalah POST, tapi ada @method('PUT') di dalamnya -->
    <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-foam border-3 border-ink shadow-brutal p-6 md:p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Nama Produk</label>
                    <input type="text" name="name" required value="{{ old('name', $product->name) }}" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>
                <div>
                    <label class="block font-display font-bold text-ink mb-2">SKU (Kode Barang)</label>
                    <input type="text" name="sku" required value="{{ old('sku', $product->sku) }}" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Harga Normal (Rp)</label>
                    <div class="flex">
                        <span class="bg-sun border-3 border-r-0 border-ink p-3 font-bold text-ink">Rp</span>
                        <input type="number" name="price" required min="0" value="{{ old('price', (int)$product->price) }}" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Kategori</label>
                    <select name="category_id" required class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all appearance-none rounded-none">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Batas Peringatan Stok Menipis</label>
                    <input type="number" name="stock_alert_threshold" required value="{{ old('stock_alert_threshold', $product->stock_alert_threshold) }}" min="1" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Status Produk</label>
                    <label class="flex items-center gap-3 bg-white border-3 border-ink p-3 cursor-pointer hover:bg-foam transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-6 h-6 border-3 border-ink text-ocean focus:ring-0 rounded-none cursor-pointer">
                        <span class="font-bold text-ink">Tampilkan di Katalog (Aktif)</span>
                    </label>
                </div>
            </div>

            <div class="md:col-span-2 space-y-6 mt-2">
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Deskripsi Produk</label>
                    <textarea name="description" rows="4" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">{{ old('description', $product->description) }}</textarea>
                </div>
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Gambar Produk (Kosongi jika tidak diubah)</label>
                    <input type="file" name="image" accept="image/*" class="w-full bg-white border-3 border-ink p-2 font-body text-ink file:mr-4 file:py-2 file:px-4 file:border-3 file:border-ink file:bg-sun file:text-ink file:font-bold hover:file:shadow-brutal-hover file:transition-all focus:outline-none">
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t-3 border-ink flex justify-end">
            <button type="submit" class="btn-brutal bg-ocean text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="square" stroke-linejoin="miter" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                UPDATE PRODUK
            </button>
        </div>
    </form>
</x-app-layout>
