<x-app-layout>
    <x-slot name="header">Katalog Produk</x-slot>

    <!-- Notifikasi Alert -->
    @if(session('success'))
        <div class="mb-6 bg-seaweed text-white border-3 border-ink shadow-brutal p-4 flex items-center justify-between">
            <div class="flex items-center gap-2 font-bold">
                {{ session('success') }}
            </div>
            <button onclick="this.parentElement.style.display='none'" class="hover:text-ink transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="square" stroke-linejoin="miter" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    <div class="mb-8">
        <h2 class="font-display font-black text-3xl text-ink">Etalase Alat Pancing</h2>
        <p class="font-body text-ink/70 mt-1">Pilih joran, reel, dan aksesoris andalanmu.</p>
    </div>

    <!-- Grid Etalase Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white border-3 border-ink shadow-brutal flex flex-col group hover:-translate-y-2 hover:shadow-brutal-hover transition-transform duration-300 relative">

                @if($product->active_promo)
                    <div class="absolute -top-3 -right-3 bg-coral text-white border-3 border-ink px-3 py-1 font-black text-sm transform rotate-6 shadow-brutal z-10">
                        DISKON!
                    </div>
                @endif

                <div class="aspect-square bg-foam border-b-3 border-ink p-4 flex items-center justify-center overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="text-ink/30 text-center font-bold">Belum Ada Gambar</div>
                    @endif
                </div>

                <div class="p-5 flex-1 flex flex-col">
                    <div class="text-xs font-bold text-ocean uppercase tracking-wider mb-1">
                        {{ $product->category->name ?? 'Kategori Umum' }}
                    </div>
                    <h2 class="font-display font-bold text-xl text-ink leading-tight mb-2 line-clamp-2">
                        {{ $product->name }}
                    </h2>

                    <div class="mt-auto pt-4">
                        @if($product->active_promo)
                            <div class="text-sm line-through text-ink/50 font-bold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="font-black text-2xl text-coral">Rp {{ number_format($product->final_price, 0, ',', '.') }}</div>
                        @else
                            <div class="font-black text-2xl text-ink mt-6">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="border-t-3 border-ink grid grid-cols-2 divide-x-3 divide-ink">
                    <a href="{{ route('katalog.show', $product->id) }}" class="flex items-center justify-center bg-sun text-ink font-bold py-3 hover:bg-ocean hover:text-white transition-colors w-full h-full cursor-pointer">
                        Lihat Detail
                    </a>
                    <form action="{{ route('keranjang.store', $product->id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full h-full bg-white text-ink font-bold text-center py-3 hover:bg-seaweed hover:text-white transition-colors flex items-center justify-center gap-2 cursor-pointer">
                            Beli
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white border-3 border-ink p-8 text-center shadow-brutal">
                <h3 class="font-display font-bold text-2xl text-ink mb-2">Belum ada alat pancing yang tersedia.</h3>
            </div>
        @endforelse
    </div>
</x-app-layout>
