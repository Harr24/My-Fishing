<x-app-layout>
    <x-slot name="header">
        Portal Pengelola Stok
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Alert Stok Menipis -->
        <div class="bg-coral text-white border-3 border-ink shadow-brutal p-6 relative">
            <div class="absolute top-4 right-4 bg-ink text-white px-2 py-1 font-bold text-xs rotate-3 shadow-brutal-hover">
                URGENT
            </div>
            <h2 class="font-display font-bold text-xl mb-2">Stok Menipis</h2>
            <p class="text-5xl font-black mb-2">0</p>
            <p class="text-sm font-bold border-t-3 border-ink pt-2">Produk di bawah ambang batas.</p>
        </div>

        <!-- Total Produk -->
        <div class="bg-seaweed text-white border-3 border-ink shadow-brutal p-6">
            <h2 class="font-display font-bold text-xl mb-2">Total Produk Aktif</h2>
            <p class="text-5xl font-black mb-2">0</p>
            <p class="text-sm font-bold border-t-3 border-ink pt-2">Di dalam katalog toko.</p>
        </div>

        <!-- Mutasi Terakhir -->
        <div class="md:col-span-2 bg-foam border-3 border-ink shadow-brutal p-6">
            <h3 class="font-display font-bold text-xl mb-4 border-b-3 border-ink pb-2 text-ink">Mutasi Stok Terakhir</h3>
            <p class="text-ink font-medium mb-6 italic">Belum ada pergerakan stok hari ini.</p>

            <a href="#" class="btn-brutal text-sm py-2">
                + Catat Mutasi Baru
            </a>
        </div>
    </div>
</x-app-layout>
