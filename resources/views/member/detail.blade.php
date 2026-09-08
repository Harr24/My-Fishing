<x-app-layout>
    <x-slot name="header">Detail Alat Pancing</x-slot>

    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-white border-3 border-ink px-4 py-2 font-bold shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="square" stroke-linejoin="miter" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            Kembali ke Katalog
        </a>
    </div>

    <!-- Kotak Utama Detail Produk -->
    <div class="bg-white border-3 border-ink shadow-brutal flex flex-col md:flex-row mb-12">

        <!-- Kolom Kiri: Gambar Besar -->
        <div class="w-full md:w-1/2 bg-foam border-b-3 md:border-b-0 md:border-r-3 border-ink p-8 flex items-center justify-center relative">
            @if($product->active_promo)
                <div class="absolute top-4 right-4 bg-coral text-white border-3 border-ink px-4 py-2 font-black text-lg transform rotate-3 shadow-brutal z-10">
                    SEDANG DISKON!
                </div>
            @endif

            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-auto max-h-[500px] border-3 border-ink shadow-brutal">
            @else
                <div class="text-ink/30 text-center font-bold p-20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32 mx-auto mb-4"><path stroke-linecap="square" stroke-linejoin="miter" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                    Belum Ada Gambar
                </div>
            @endif
        </div>

        <!-- Kolom Kanan: Informasi & Aksi -->
        <div class="w-full md:w-1/2 p-8 flex flex-col">
            <!-- Info Kategori & SKU -->
            <div class="flex items-center gap-3 mb-4">
                <span class="bg-sun border-2 border-ink px-3 py-1 text-sm font-bold uppercase tracking-wider">
                    {{ $product->category->name ?? 'Umum' }}
                </span>
                <span class="text-sm font-bold text-ink/60 border-2 border-ink/20 px-2 py-1">
                    SKU: {{ $product->sku }}
                </span>
            </div>

            <!-- Nama Produk -->
            <h1 class="font-display font-black text-3xl md:text-5xl text-ink leading-tight mb-6">
                {{ $product->name }}
            </h1>

            <!-- Harga Box -->
            <div class="bg-foam border-3 border-ink p-6 mb-8 shadow-brutal-hover transform -rotate-1">
                @if($product->active_promo)
                    <div class="text-lg line-through text-ink/50 font-bold mb-1">Harga Normal: Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <div class="font-black text-4xl text-coral">Rp {{ number_format($product->final_price, 0, ',', '.') }}</div>
                    <div class="mt-2 text-sm font-bold text-seaweed flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="square" stroke-linejoin="miter" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        Promo Terbatas!
                    </div>
                @else
                    <div class="font-black text-4xl text-ink">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                @endif
            </div>

            <!-- Deskripsi -->
            <div class="mb-8 flex-1">
                <h3 class="font-display font-bold text-xl border-b-3 border-ink pb-2 mb-4">Deskripsi Produk</h3>
                <div class="font-body text-lg text-ink/80 leading-relaxed whitespace-pre-line">
                    {{ $product->description ?? 'Belum ada deskripsi spesifik untuk produk ini.' }}
                </div>
            </div>

            <!-- Tombol Aksi Beli Besar (Sudah Menjadi Form) -->
            <form action="{{ route('keranjang.store', $product->id) }}" method="POST" class="w-full mt-auto">
                @csrf
                <button type="submit" class="w-full bg-seaweed text-white border-3 border-ink p-4 font-display font-black text-2xl shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all flex items-center justify-center gap-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="square" stroke-linejoin="miter" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                    MASUKKAN KERANJANG
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
