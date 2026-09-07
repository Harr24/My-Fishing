<x-app-layout>
    <x-slot name="header">
        Portal Pengelola Penjualan
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Menunggu Diproses -->
        <div class="bg-sun border-3 border-ink shadow-brutal p-6">
            <h2 class="font-display font-bold text-xl mb-2 text-ink">Menunggu Diproses</h2>
            <p class="text-5xl font-black text-ink mb-2">0</p>
            <p class="text-sm font-bold border-t-3 border-ink pt-2 text-ink">Segera konfirmasi pesanan baru.</p>
        </div>

        <!-- Sedang Dikirim -->
        <div class="bg-ocean text-foam border-3 border-ink shadow-brutal p-6">
            <h2 class="font-display font-bold text-xl mb-2">Sedang Dikirim</h2>
            <p class="text-5xl font-black mb-2">0</p>
            <p class="text-sm font-bold border-t-3 border-foam pt-2">Pantau status pengiriman.</p>
        </div>

        <!-- Pendapatan Bulan Ini -->
        <div class="bg-foam border-3 border-ink shadow-brutal p-6 relative">
            <h2 class="font-display font-bold text-xl mb-2 text-ink">Pendapatan Bulan Ini</h2>
            <p class="text-3xl font-black text-ink mb-2">Rp 0</p>
            <a href="#" class="inline-block mt-4 text-ocean font-bold hover:translate-x-[2px] transition-transform">
                Lihat Laporan Lengkap &rarr;
            </a>
        </div>
    </div>
</x-app-layout>
