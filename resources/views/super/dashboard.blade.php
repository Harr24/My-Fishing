<x-app-layout>
    <x-slot name="header">
        Ringkasan Toko
    </x-slot>

    <!-- Layout Grid Asimetris (Sesuai Spesifikasi) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Kartu 1: Total Penjualan (Paling Lebar) -->
        <div class="md:col-span-2 bg-foam border-3 border-ink shadow-brutal p-6 relative overflow-hidden">
            <!-- Badge miring ala Neubrutalism di pojok -->
            <div class="absolute top-4 right-4 bg-sun border-3 border-ink px-3 py-1 font-bold text-sm transform rotate-3 shadow-brutal">
                Hari Ini
            </div>

            <h2 class="font-display font-bold text-xl mb-2 text-ink">Total Penjualan</h2>
            <p class="text-5xl font-black text-ocean mb-4">Rp 0</p>
            <div class="mt-4 pt-4 border-t-3 border-ink flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-coral border-2 border-ink"></span>
                <p class="text-sm font-bold text-ink">0 pesanan baru menunggu diproses.</p>
            </div>
        </div>

        <!-- Kartu 2: Stok Kritis (Warna Peringatan) -->
        <div class="bg-coral text-white border-3 border-ink shadow-brutal p-6 flex flex-col justify-between">
            <div>
                <h2 class="font-display font-bold text-xl mb-2">Stok Kritis</h2>
                <p class="text-5xl font-black text-ink">0</p>
            </div>
            <div class="mt-4 pt-4 border-t-3 border-ink">
                <p class="text-sm font-bold text-ink">Produk perlu di-restock.</p>
            </div>
        </div>

        <!-- Kartu 3: Promo Aktif (Memanjang ke Samping) -->
        <div class="md:col-span-3 bg-seaweed text-white border-3 border-ink shadow-brutal p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-display font-bold text-2xl mb-1">Promo Aktif</h2>
                <p class="font-bold text-ink">Tidak ada promo yang sedang berjalan saat ini.</p>
            </div>
            <!-- Tombol Bergaya Brutalism -->
            <a href="#" class="inline-block bg-sun text-ink font-display font-bold px-6 py-3 border-3 border-ink shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all">
                + BUAT PROMO
            </a>
        </div>

    </div>
</x-app-layout>
