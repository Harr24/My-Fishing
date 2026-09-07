<x-app-layout>
    <x-slot name="header">
        Tambah Produk
    </x-slot>

    <!-- Header & Tombol Kembali -->
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('produk.index') }}" class="bg-white border-3 border-ink p-2 shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all">
            <!-- Heroicon: Arrow Left -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 text-ink">
                <path stroke-linecap="square" stroke-linejoin="miter" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h2 class="font-display font-bold text-2xl text-ink">Input Alat Pancing Baru</h2>
    </div>

    <!-- Form Brutalism -->
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="bg-foam border-3 border-ink shadow-brutal p-6 md:p-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Kolom Kiri -->
            <div class="space-y-6">
                <!-- Nama Produk -->
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Nama Produk</label>
                    <input type="text" name="name" required placeholder="Contoh: Reel Shimano Stella"
                           class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>

                <!-- SKU -->
                <div>
                    <label class="block font-display font-bold text-ink mb-2">SKU (Kode Barang)</label>
                    <input type="text" name="sku" required placeholder="Contoh: SHM-STL-001"
                           class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>

                <!-- Harga Normal -->
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Harga Normal (Rp)</label>
                    <div class="flex">
                        <span class="bg-sun border-3 border-r-0 border-ink p-3 font-bold text-ink">Rp</span>
                        <input type="number" name="price" required min="0" placeholder="0"
                               class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="space-y-6">
                <!-- Kategori -->
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Kategori</label>
                    <select name="category_id" required
                            class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all appearance-none rounded-none">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Batas Peringatan Stok -->
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Batas Peringatan Stok Menipis</label>
                    <input type="number" name="stock_alert_threshold" required value="5" min="1"
                           class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>

                <!-- Status Aktif -->
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Status Produk</label>
                    <label class="flex items-center gap-3 bg-white border-3 border-ink p-3 cursor-pointer hover:bg-foam transition-colors">
                        <input type="checkbox" name="is_active" value="1" checked
                               class="w-6 h-6 border-3 border-ink text-ocean focus:ring-0 rounded-none cursor-pointer">
                        <span class="font-bold text-ink">Tampilkan di Katalog (Aktif)</span>
                    </label>
                </div>
            </div>

            <!-- Lebar Penuh (Bawah) -->
            <div class="md:col-span-2 space-y-6 mt-2">
                <!-- Deskripsi -->
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Deskripsi Produk</label>
                    <textarea name="description" rows="4" placeholder="Jelaskan spesifikasi, bahan, dan keunggulan alat pancing ini..."
                              class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all"></textarea>
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Gambar Produk (Opsional)</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full bg-white border-3 border-ink p-2 font-body text-ink file:mr-4 file:py-2 file:px-4 file:border-3 file:border-ink file:bg-sun file:text-ink file:font-bold file:cursor-pointer hover:file:shadow-brutal-hover file:transition-all focus:outline-none">
                </div>
            </div>

        </div>

        <!-- Tombol Submit -->
        <div class="mt-8 pt-6 border-t-3 border-ink flex justify-end">
            <button type="submit" class="btn-brutal bg-ocean text-white flex items-center gap-2">
                <!-- Heroicon: Plus/Save -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="square" stroke-linejoin="miter" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                SIMPAN PRODUK
            </button>
        </div>
    </form>
</x-app-layout>
