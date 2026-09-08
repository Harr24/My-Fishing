<x-app-layout>
    <x-slot name="header">Keranjang Belanja</x-slot>

    <div class="mb-8">
        <h2 class="font-display font-black text-3xl text-ink">Keranjang Anda 🛒</h2>
        <p class="font-body text-ink/70 mt-1">Periksa kembali barang belanjaan Anda sebelum checkout.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Kolom Kiri: Daftar Barang -->
        <div class="w-full lg:w-2/3">
            @forelse($cartItems as $item)
                <div class="bg-white border-3 border-ink shadow-brutal flex items-center p-4 mb-4 transform transition-transform hover:-translate-y-1">
                    <!-- Gambar -->
                    <div class="w-24 h-24 bg-foam border-2 border-ink flex-shrink-0">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xs font-bold text-ink/40">No Img</div>
                        @endif
                    </div>

                    <!-- Info Produk -->
                    <div class="ml-4 flex-1">
                        <h3 class="font-display font-bold text-xl text-ink line-clamp-1">{{ $item->product->name }}</h3>
                        <div class="font-bold text-coral text-lg">Rp {{ number_format($item->product->final_price, 0, ',', '.') }}</div>
                    </div>

                    <!-- Kuantitas & Subtotal -->
                    <div class="text-right ml-4">
                        <div class="font-bold text-ink bg-sun border-2 border-ink px-3 py-1 inline-block mb-1">
                            Qty: {{ $item->quantity }}
                        </div>
                        <div class="font-black text-xl text-seaweed">
                            Rp {{ number_format($item->quantity * $item->product->final_price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white border-3 border-ink shadow-brutal p-8 text-center">
                    <div class="text-6xl mb-4">🕸️</div>
                    <h3 class="font-display font-bold text-2xl text-ink mb-2">Keranjang masih kosong!</h3>
                    <p class="text-ink/70 mb-6">Ayo isi keranjangmu dengan alat pancing terbaik.</p>
                    <a href="{{ route('katalog.index') }}" class="bg-ocean text-white border-3 border-ink px-6 py-3 font-bold shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] inline-block transition-all">
                        Belanja Sekarang
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Kolom Kanan: Ringkasan Checkout -->
        <div class="w-full lg:w-1/3">
            <div class="bg-foam border-3 border-ink shadow-brutal p-6 sticky top-6">
                <h3 class="font-display font-bold text-2xl border-b-3 border-ink pb-3 mb-4">Ringkasan Belanja</h3>

                <div class="flex justify-between items-center mb-6">
                    <span class="font-bold text-ink/80 text-lg">Total Harga:</span>
                    <span class="font-black text-3xl text-ink">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>

                <button class="w-full bg-seaweed text-white border-3 border-ink py-4 font-display font-black text-xl shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all {{ $cartItems->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $cartItems->isEmpty() ? 'disabled' : '' }}>
                    LANJUT CHECKOUT 🚀
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
