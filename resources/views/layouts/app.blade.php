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

    <!-- Menerapkan warna background dan warna teks dasar dari palet Neubrutalism -->
    <body class="font-body text-ink bg-foam antialiased">

        @php
            // Mengambil role pertama user saat ini.
            // Jika belum ada, set default ke 'member'.
            $role = auth()->check() && auth()->user()->roles->count() > 0
                    ? auth()->user()->roles->first()->name
                    : 'member';
        @endphp

        <!-- Layout Utama: Flexbox untuk menyandingkan Sidebar dan Konten Utama -->
        <div class="flex min-h-screen">

            <!-- 1. SIDEBAR -->
            <!-- Akan memuat file sesuai role (misal: sidebar/super.blade.php).
                 Jika file spesifik belum dibuat, otomatis pakai sidebar/default.blade.php -->
            @includeFirst(["layouts.sidebar.{$role}", 'layouts.sidebar.default'])

            <!-- Wrapper Konten Sebelah Kanan -->
            <div class="flex-1 flex flex-col overflow-hidden">

                <!-- 2. HEADER -->
                @includeFirst(["layouts.header.{$role}", 'layouts.header.default'])

                <!-- Page Heading (Bawaan Breeze, kita modifikasi gayanya agar lebih brutalist) -->
                @isset($header)
                    <header class="bg-white border-b-3 border-ink px-6 py-4">
                        <div class="font-display font-bold text-xl">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- 3. MAIN CONTENT -->
                <main class="flex-1 overflow-y-auto p-6">
                    {{ $slot }}
                </main>

                <!-- 4. FOOTER -->
                @includeFirst(["layouts.footer.{$role}", 'layouts.footer.default'])

            </div>
        </div>
    </body>
</html>
