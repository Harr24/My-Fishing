<aside class="w-64 bg-foam border-r-3 border-ink flex flex-col justify-between min-h-screen hidden md:flex shrink-0">
    <div class="h-16 border-b-3 border-ink flex items-center justify-center bg-sun">
        <a href="{{ route('dashboard') }}" class="font-display font-bold text-2xl text-ink tracking-tight">🎣 MyFishing</a>
    </div>

    <nav class="flex-1 overflow-y-auto py-6">
        <ul class="space-y-3 px-4">
            <li>
                <!-- MENU 1: DASHBOARD -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 {{ request()->routeIs('dashboard') ? 'border-ink bg-ocean text-white shadow-brutal' : 'border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white' }} transition-all">
                    🏠 Dashboard Member
                </a>
            </li>
            <li>
                <!-- MENU 2: KATALOG -->
                <a href="{{ route('katalog.index') }}" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 {{ request()->routeIs('katalog.*') ? 'border-ink bg-ocean text-white shadow-brutal' : 'border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white' }} transition-all">
                    🎣 Katalog Alat Pancing
                </a>
            </li>
            <li>
                <a href="{{ route('keranjang.index') }}" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 {{ request()->routeIs('keranjang.*') ? 'border-ink bg-ocean text-white shadow-brutal' : 'border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white' }} transition-all">
                    🛒 Keranjang Belanja
                </a>
            </li>
        </ul>
    </nav>

    <div class="border-t-3 border-ink p-4 bg-white">
        <div class="font-bold text-sm mb-1 truncate">{{ Auth::user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center bg-coral text-white font-display font-bold px-4 py-2 border-3 border-ink shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] cursor-pointer">LOGOUT</button>
        </form>
    </div>
</aside>
