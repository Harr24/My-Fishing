<x-app-layout>
    <x-slot name="header">Katalog Produk</x-slot>

    <!-- Banner Sambutan -->
    <div class="bg-ocean text-white border-3 border-ink shadow-brutal p-6 md:p-8 mb-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h1 class="font-display font-black text-3xl md:text-4xl mb-2">Selamat Datang, {{ Auth::user()->name }}! 🎣</h1>
            <p class="font-body text-lg font-medium opacity-90">Temukan joran, reel, dan aksesoris pancing terbaik untuk petualanganmu hari ini.</p>
        </div>
        <div class="hidden md:block text-6xl">
            ⛵
        </div>
    </div>

    <!-- Grid Etalase Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <!-- Kartu Produk Brutalism -->
            <div class="bg-white border-3 border-ink shadow-brutal flex flex-col group hover:-translate-y-2 hover:shadow-brutal-hover transition-transform duration-300 relative">

                <!-- Badge Promo (Jika Ada) -->
                @if($product->active_promo)
                    <div class="absolute -top-3 -right-3 bg-coral text-white border-3 border-ink px-3 py-1 font-black text-sm transform rotate-6 shadow-brutal z-10">
                        DISKON!
                    </div>
                @endif

                <!-- Area Gambar -->
                <div class="aspect-square bg-foam border-b-3 border-ink p-4 flex items-center justify-center overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                    @else
                        <!-- Placeholder jika belum ada gambar -->
                        <div class="text-ink/30 text-center font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto mb-2"><path stroke-linecap="square" stroke-linejoin="miter" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                            Belum Ada Gambar
                        </div>
                    @endif
                </div>

                <!-- Info Produk -->
                <div class="p-5 flex-1 flex flex-col">
                    <div class="text-xs font-bold text-ocean uppercase tracking-wider mb-1">
                        {{ $product->category->name ?? 'Kategori Umum' }}
                    </div>
                    <h2 class="font-display font-bold text-xl text-ink leading-tight mb-2 line-clamp-2">
                        {{ $product->name }}
                    </h2>

                    <div class="mt-auto pt-4">
                        @if($product->active_promo)
                            <!-- Harga Diskon -->
                            <div class="text-sm line-through text-ink/50 font-bold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="font-black text-2xl text-coral">Rp {{ number_format($product->final_price, 0, ',', '.') }}</div>
                        @else
                            <!-- Harga Normal -->
                            <div class="font-black text-2xl text-ink mt-6">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="border-t-3 border-ink grid grid-cols-2 divide-x-3 divide-ink">
                    <a href="{{ route('katalog.show', $product->id) }}" class="flex items-center justify-center bg-sun text-ink font-bold py-3 hover:bg-ocean hover:text-white transition-colors w-full h-full cursor-pointer">
                        Lihat Detail
                    </a>
                    <button class="bg-white text-ink font-bold text-center py-3 hover:bg-seaweed hover:text-white transition-colors flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="square" stroke-linejoin="miter" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                        Beli
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white border-3 border-ink p-8 text-center shadow-brutal">
                <h3 class="font-display font-bold text-2xl text-ink mb-2">Belum ada alat pancing yang tersedia.</h3>
                <p class="font-body text-ink/70">Katalog sedang dalam pembaruan. Silakan cek kembali nanti!</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
