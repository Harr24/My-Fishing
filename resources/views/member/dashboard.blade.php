<x-app-layout>
    <x-slot name="header">
        Area Member
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Banner Selamat Datang -->
        <div class="md:col-span-2 bg-foam border-3 border-ink shadow-brutal p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-display font-bold text-2xl mb-2 text-ink">Selamat Datang, {{ Auth::user()->name }}! 🎣</h2>
                <p class="font-body text-ink font-medium">Siap untuk petualangan memancingmu selanjutnya?</p>
            </div>
            <a href="/" class="btn-brutal whitespace-nowrap">
                Lihat Katalog Produk
            </a>
        </div>

        <!-- Pesanan Terakhir -->
        <div class="bg-white border-3 border-ink shadow-brutal p-6">
            <h3 class="font-display font-bold text-xl mb-4 border-b-3 border-ink pb-2 text-ocean">Pesanan Terakhir</h3>
            <p class="text-ink font-medium italic">Belum ada pesanan. Yuk mulai belanja!</p>
        </div>

        <!-- Promo Spesial -->
        <div class="bg-sun border-3 border-ink shadow-brutal p-6 relative overflow-hidden">
            <!-- Pita miring di pojok -->
            <div class="absolute -right-6 top-4 bg-coral text-white border-y-3 border-ink px-8 py-1 font-bold text-xs rotate-45">
                HOT
            </div>
            <h3 class="font-display font-bold text-xl mb-2 text-ink">Promo Spesial</h3>
            <p class="font-medium text-ink">Cek produk yang sedang diskon khusus hari ini.</p>
        </div>
    </div>
</x-app-layout>
