<x-app-layout>
    <x-slot name="header">Buat Promo Baru</x-slot>

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('promo.index') }}" class="bg-white border-3 border-ink p-2 shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 text-ink"><path stroke-linecap="square" stroke-linejoin="miter" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
        </a>
        <h2 class="font-display font-bold text-2xl text-ink">Seting Diskon Spesial</h2>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-coral text-white border-3 border-ink shadow-brutal p-4 font-bold">
            <ul class="list-disc ml-5 mt-2 font-medium">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('promo.store') }}" method="POST" class="bg-foam border-3 border-ink shadow-brutal p-6 md:p-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 border-b-3 border-ink pb-8">
            <!-- Kolom Kiri: Detail Promo -->
            <div class="space-y-6">
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Nama Program Diskon</label>
                    <input type="text" name="name" required placeholder="Contoh: Diskon Kemerdekaan 17an" value="{{ old('name') }}" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-display font-bold text-ink mb-2">Jenis Potongan</label>
                        <select name="type" required class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all appearance-none rounded-none">
                            <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Persen (%)</option>
                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Nominal (Rp)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-display font-bold text-ink mb-2">Nilai Potongan</label>
                        <input type="number" name="value" required min="1" placeholder="Contoh: 15" value="{{ old('value') }}" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Waktu & Status -->
            <div class="space-y-6">
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Tanggal & Jam Mulai</label>
                    <input type="datetime-local" name="start_date" required value="{{ old('start_date') }}" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>
                <div>
                    <label class="block font-display font-bold text-ink mb-2">Tanggal & Jam Berakhir</label>
                    <input type="datetime-local" name="end_date" required value="{{ old('end_date') }}" class="w-full bg-white border-3 border-ink p-3 font-body text-ink focus:ring-0 focus:border-ocean focus:shadow-brutal transition-all">
                </div>
                <div>
                    <label class="flex items-center gap-3 bg-white border-3 border-ink p-3 cursor-pointer hover:bg-sun transition-colors mt-8">
                        <input type="checkbox" name="is_active" value="1" checked class="w-6 h-6 border-3 border-ink text-ocean focus:ring-0 rounded-none cursor-pointer">
                        <span class="font-bold text-ink">Langsung Aktifkan Promo Ini</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Bagian Bawah: Pilih Produk (Checkboxes) -->
        <div>
            <h3 class="font-display font-bold text-xl text-ink mb-4">Pilih Produk yang Didiskon</h3>
            @if($products->isEmpty())
                <div class="bg-sun border-3 border-ink p-4 font-bold text-ink">
                    Katalog kosong! Tambahkan produk dulu sebelum membuat promo.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($products as $product)
                        <label class="flex items-start gap-3 bg-white border-3 border-ink p-4 cursor-pointer hover:bg-ocean hover:text-white transition-all group shadow-brutal-hover">
                            <input type="checkbox" name="product_ids[]" value="{{ $product->id }}"
                                   {{ (is_array(old('product_ids')) && in_array($product->id, old('product_ids'))) ? 'checked' : '' }}
                                   class="w-6 h-6 mt-1 border-3 border-ink text-coral focus:ring-0 rounded-none cursor-pointer">
                            <div>
                                <div class="font-bold text-lg leading-tight">{{ $product->name }}</div>
                                <div class="font-medium opacity-80 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-8 pt-6 border-t-3 border-ink flex justify-end">
            <button type="submit" class="btn-brutal bg-ocean text-white flex items-center gap-2">
                SIMPAN & JALANKAN PROMO
            </button>
        </div>
    </form>
</x-app-layout>
