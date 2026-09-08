<aside class="w-64 bg-foam border-r-3 border-ink flex flex-col justify-between min-h-screen hidden md:flex shrink-0">
    <!-- Logo Area -->
    <div class="h-16 border-b-3 border-ink flex items-center justify-center bg-sun">
        <a href="{{ route('dashboard') }}" class="font-display font-bold text-2xl text-ink tracking-tight">
            🎣 MyFishing
        </a>
    </div>

    <!-- Navigation Links dengan Heroicons -->
    <nav class="flex-1 overflow-y-auto py-6">
        <ul class="space-y-3 px-4">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M21 16.811c0 .864-.856 1.491-1.646 1.118l-6.818-3.218a2.25 2.25 0 00-1.072 0l-6.818 3.218C3.856 18.302 3 17.675 3 16.811V7.189c0-.864.856-1.491 1.646-1.118l6.818 3.218c.35.166.756.166 1.106 0l6.818-3.218c.79-.373 1.646.254 1.646 1.118v9.622z" />
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M3.27 6.96L12 11.01l8.73-4.05" />
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M12 22.08V11" />
                    </svg>
                    Kelola Produk
                </a>
            </li>
            <li>
                <a href="{{ route('promo.index') }}" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    Kelola Promo
                </a>
            </li>

            <li>
                <a href="#" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    Kelola User
                </a>
            </li>
        </ul>
    </nav>

    <!-- User Info & Logout -->
    <div class="border-t-3 border-ink p-4 bg-white">
        <div class="font-bold text-sm mb-1 truncate">{{ Auth::user()->name }}</div>
        <div class="text-xs text-ocean mb-4 font-bold uppercase tracking-wider">Super Admin</div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center bg-coral text-white font-display font-bold px-4 py-2 border-3 border-ink shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all cursor-pointer">
                LOGOUT
            </button>
        </form>
    </div>
</aside>
