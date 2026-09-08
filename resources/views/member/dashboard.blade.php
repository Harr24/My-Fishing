<x-app-layout>
    <x-slot name="header">Dashboard Member</x-slot>

    <!-- Banner Sambutan -->
    <div class="bg-ocean text-white border-3 border-ink shadow-brutal p-6 md:p-10 mb-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h1 class="font-display font-black text-3xl md:text-5xl mb-4">Selamat Datang, {{ Auth::user()->name }}! 🎣</h1>
            <p class="font-body text-xl font-medium opacity-90 mb-6">Siap untuk petualangan memancingmu hari ini? Temukan gear terbaik dengan harga miring di toko kami.</p>
            <a href="{{ route('katalog.index') }}" class="inline-block bg-sun text-ink border-3 border-ink px-6 py-3 font-bold text-lg shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                Mulai Belanja Sekarang
            </a>
        </div>
        <div class="hidden md:block text-8xl">
            ⛵
        </div>
    </div>

    <!-- Nanti kita bisa tambahkan kartu ringkasan di sini (Misal: Total Belanjaan, Status Pesanan, dll) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-foam border-3 border-ink p-6 shadow-brutal">
            <h3 class="font-display font-bold text-2xl text-ink mb-2">Keranjang Anda</h3>
            <p class="text-ink/70 font-medium mb-4">Belum ada barang di keranjang.</p>
            <a href="{{ route('katalog.index') }}" class="text-ocean font-bold underline hover:text-ink">Lihat Katalog &rarr;</a>
        </div>
        <div class="bg-sun border-3 border-ink p-6 shadow-brutal">
            <h3 class="font-display font-bold text-2xl text-ink mb-2">Riwayat Transaksi</h3>
            <p class="text-ink/70 font-medium mb-4">Lacak status pesanan Anda di sini.</p>
            <a href="#" class="text-ocean font-bold underline hover:text-ink">Lihat Pesanan &rarr;</a>
        </div>
    </div>
</x-app-layout>
