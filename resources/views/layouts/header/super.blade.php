<header class="bg-white border-b-3 border-ink px-6 py-4 flex items-center justify-between sticky top-0 z-10">
    <div class="flex items-center gap-4">
        <!-- Tombol Hamburger untuk Mobile (Opsional untuk responsivitas nanti) -->
        <button class="md:hidden p-2 border-3 border-ink bg-sun shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover">
            <svg class="w-6 h-6 text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        <h1 class="font-display font-bold text-2xl text-ocean">
            Super Admin kntl
        </h1>
    </div>

    <div class="flex items-center gap-4">
        <!-- Tanggal Hari Ini Bergaya Label -->
        <div class="hidden sm:block font-bold text-sm border-3 border-ink px-3 py-1 bg-foam shadow-brutal">
            {{ now()->format('d M Y') }}
        </div>
    </div>
</header>
