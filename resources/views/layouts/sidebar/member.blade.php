<aside class="w-64 bg-foam border-r-3 border-ink flex flex-col justify-between min-h-screen hidden md:flex shrink-0">
    <div class="h-16 border-b-3 border-ink flex items-center justify-center bg-sun">
        <a href="{{ route('dashboard') }}" class="font-display font-bold text-2xl text-ink tracking-tight">🎣 MyFishing</a>
    </div>

    <nav class="flex-1 overflow-y-auto py-6">
        <ul class="space-y-3 px-4">
            <li>
                <!-- Diarahkan dengan benar ke route dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Katalog & Dashboard
                </a>
            </li>

            <li>
                <!-- Tombol Keranjang (biarkan # sementara karena fiturnya belum ada) -->
                <a href="#" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    Keranjang Belanja
                </a>
            </li>

            <li>
                <!-- Tombol Riwayat (biarkan # sementara) -->
                <a href="#" class="flex items-center gap-3 px-4 py-3 font-bold text-ink border-3 border-transparent hover:border-ink hover:shadow-brutal hover:bg-ocean hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Riwayat Pesanan
                </a>
            </li>
        </ul>
    </nav>

    <div class="border-t-3 border-ink p-4 bg-white">
        <div class="font-bold text-sm mb-1 truncate">{{ Auth::user()->name }}</div>
        <div class="text-xs text-ocean mb-4 font-bold uppercase tracking-wider">Member</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center bg-coral text-white font-display font-bold px-4 py-2 border-3 border-ink shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all cursor-pointer">LOGOUT</button>
        </form>
    </div>
</aside>
