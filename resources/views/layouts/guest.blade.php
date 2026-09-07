<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MyFishing') }}</title>

        <!-- Fonts: Space Grotesk (Heading) & Inter (Body) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <!-- Terapkan bg-foam dan warna teks ink -->
    <body class="font-body text-ink bg-foam antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

            <!-- Logo Area -->
            <div>
                <a href="/" class="font-display font-bold text-4xl tracking-tighter text-ocean hover:text-coral transition-colors">
                    {{-- Anda bisa membiarkan komponen <x-application-logo> jika sudah punya logo gambar,
                         tapi sebagai awalan, teks tebal khas Neubrutalism ini sangat cocok --}}
                    MyFishing
                </a>
            </div>

            <!-- Wrapper Form Login/Register bergaya Neubrutalism (Card Brutal) -->
            <!-- Hapus shadow default dan rounded, ganti dengan border tebal dan hard shadow -->
            <div class="w-full sm:max-w-md mt-8 px-6 py-8 bg-white border-3 border-ink shadow-brutal">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
