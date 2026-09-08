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
                    <!-- Kuantitas & Subtotal & Aksi -->
                    <div class="ml-auto flex flex-col items-end gap-3">
                        <!-- Harga Subtotal -->
                        <div class="font-black text-xl text-seaweed">
                            Rp {{ number_format($item->quantity * $item->product->final_price, 0, ',', '.') }}
                        </div>

                        <div class="flex items-center gap-4">
                            <!-- Tombol Plus Minus -->
                            <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="action" value="decrease" class="bg-foam border-2 border-ink w-8 h-8 flex items-center justify-center font-black hover:bg-coral hover:text-white transition-colors" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>

                                <span class="bg-sun border-y-2 border-ink px-4 py-[3px] font-bold h-8 flex items-center justify-center">
                                    {{ $item->quantity }}
                                </span>

                                <button type="submit" name="action" value="increase" class="bg-foam border-2 border-ink w-8 h-8 flex items-center justify-center font-black hover:bg-ocean hover:text-white transition-colors">+</button>
                            </form>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-white border-2 border-ink text-ink p-1 hover:bg-coral hover:text-white transition-colors shadow-brutal-hover hover:translate-x-[1px] hover:translate-y-[1px] cursor-pointer" title="Hapus dari keranjang">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="square" stroke-linejoin="miter" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                </button>
                            </form>
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
