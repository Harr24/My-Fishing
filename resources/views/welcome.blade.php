<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyFishing - Toko Alat Pancing</title>
    <!-- Pastikan Tailwind dimuat -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-foam min-h-screen flex flex-col items-center justify-center p-6 font-body">

    <div class="bg-white border-3 border-ink shadow-brutal p-8 md:p-12 max-w-xl w-full text-center transform -rotate-1 hover:rotate-0 transition-transform duration-300">
        <div class="text-6xl mb-6">🎣</div>
        <h1 class="font-display font-black text-4xl md:text-5xl text-ink mb-4">MyFishing</h1>
        <p class="text-lg text-ink/80 font-medium mb-8">
            Pusat joran, reel, dan aksesoris pancing kualitas premium. Masuk sekarang untuk melihat katalog dan klaim promo diskonnya!
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @auth
                <a href="{{ route('dashboard') }}" class="w-full bg-seaweed text-white border-3 border-ink px-6 py-4 font-bold text-lg shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                    KE DASHBOARD 🚀
                </a>
            @else
                <a href="{{ route('login') }}" class="w-full bg-ocean text-white border-3 border-ink px-6 py-4 font-bold text-lg shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                    LOGIN
                </a>
                <a href="{{ route('register') }}" class="w-full bg-sun text-ink border-3 border-ink px-6 py-4 font-bold text-lg shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                    DAFTAR BARU
                </a>
            @endauth
        </div>
    </div>

</body>
</html>
