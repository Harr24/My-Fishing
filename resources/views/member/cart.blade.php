<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <!-- Icon Heroicon: Shopping Cart -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-.23 2.1-1.243 2.503-2.317l2.115-8.232a8.902 8.902 0 00-2.311-.168m-14.899 0a8.902 8.902 0 012.311.168m6.241-1.285a3 3 0 113.882 3.882" />
            </svg>
            Keranjang Belanja
        </div>
    </x-slot>

    <div class="mb-8">
        <div class="flex items-center gap-3">
            <h2 class="font-display font-black text-3xl text-ink">Keranjang Anda</h2>
            <!-- Icon Heroicon: Shopping Cart (solid) -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-ink">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 12.103 12.103 0 001.245-4.976l.325-1.293a3 3 0 00-3.111-3.81h-13.01l-.228-.855A1.5 1.5 0 003.636 2.25H2.25zM6 18a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm12 0a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
            </svg>
        </div>
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
                    <div class="flex justify-center mb-4">
                        <!-- Icon Heroicon: Inbox (untuk keranjang kosong) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-20 h-20 text-ink/50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.012-1.244h3.86m-21-3h21m-22.5 9h22.5m-22.5 0a2.25 2.25 0 01-2.25-2.25V5.25A2.25 2.25 0 013.75 3h16.5a2.25 2.25 0 012.25 2.25v13.5a2.25 2.25 0 01-2.25 2.25H1.5z" />
                        </svg>
                    </div>
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

                <!-- Form Checkout yang sudah diperbarui -->
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <!-- Pilihan Metode Pembayaran -->
                    <div class="mb-6">
                        <label class="block font-bold text-ink mb-2">Metode Pembayaran</label>
                        <select name="payment_method" class="w-full bg-white border-3 border-ink p-3 font-bold text-ink focus:ring-0 focus:border-ink shadow-brutal-thumb" required>
                            <option value="" disabled selected>Pilih metode pembayaran</option>
                            <option value="Transfer BCA">Bank Transfer - BCA</option>
                            <option value="GoPay">E-Wallet - GoPay</option>
                            <option value="OVO">E-Wallet - OVO</option>
                            <option value="COD">Bayar di Tempat (COD)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-3 bg-seaweed text-white border-3 border-ink py-4 font-display font-black text-xl shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all cursor-pointer {{ $cartItems->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $cartItems->isEmpty() ? 'disabled' : '' }}>
                        LANJUT CHECKOUT
                        <!-- Icon Heroicon: Credit Card -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
