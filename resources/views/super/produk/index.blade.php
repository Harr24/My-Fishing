<x-app-layout>
    <x-slot name="header">

        <!-- Alert Pesan Sukses -->
    @if(session('success'))
        <div class="mb-6 bg-seaweed text-white border-3 border-ink shadow-brutal p-4 flex items-center justify-between">
            <div class="flex items-center gap-2 font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="square" stroke-linejoin="miter" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                {{ session('success') }}
            </div>
            <!-- Tombol close alert sederhana (via AlpineJS bawaan Breeze) -->
            <button onclick="this.parentElement.style.display='none'" class="hover:text-ink transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="square" stroke-linejoin="miter" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Alert Pesan Error Validasi (jika gagal) -->
    @if($errors->any())
        <div class="mb-6 bg-coral text-white border-3 border-ink shadow-brutal p-4 font-bold">
            Terdapat kesalahan input:
            <ul class="list-disc ml-5 mt-2 font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        Manajemen Produk
    </x-slot>

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="font-display font-bold text-2xl text-ink">Daftar Alat Pancing 🎣</h2>
        <a href="{{ route('produk.create') }}" class="btn-brutal bg-ocean text-white">
            + Tambah Produk Baru
        </a>
    </div>

    <!-- Tabel Brutalism -->
    <div class="bg-white border-3 border-ink shadow-brutal overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-sun border-b-3 border-ink font-display text-ink text-lg">
                    <th class="p-4 border-r-3 border-ink w-16 text-center">No</th>
                    <th class="p-4 border-r-3 border-ink">Info Produk</th>
                    <th class="p-4 border-r-3 border-ink">Kategori</th>
                    <th class="p-4 border-r-3 border-ink">Harga & Promo</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-body">
                @forelse($products as $index => $product)
                    <tr class="border-b-3 border-ink last:border-b-0 hover:bg-foam transition-colors">
                        <td class="p-4 border-r-3 border-ink text-center font-bold text-xl">{{ $index + 1 }}</td>

                        <!-- Nama & SKU -->
                        <td class="p-4 border-r-3 border-ink">
                            <div class="font-bold text-xl text-ocean mb-1">{{ $product->name }}</div>
                            <span class="bg-foam border-2 border-ink px-2 py-1 text-xs font-bold shadow-brutal-hover">
                                SKU: {{ $product->sku }}
                            </span>
                        </td>

                        <!-- Kategori -->
                        <td class="p-4 border-r-3 border-ink font-bold">
                            {{ $product->category->name ?? 'Tanpa Kategori' }}
                        </td>

                        <!-- Logika Harga Promo Sesuai Brief -->
                        <td class="p-4 border-r-3 border-ink">
                            @if($product->active_promo)
                                <!-- Jika ada promo, harga normal dicoret, harga diskon ditonjolkan warna coral -->
                                <div class="text-sm line-through text-ink/60 mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                <div class="font-black text-coral text-xl mb-2">Rp {{ number_format($product->final_price, 0, ',', '.') }}</div>

                                <!-- Badge tag harga miring -->
                                <div class="inline-block bg-sun border-2 border-ink px-2 py-0.5 text-xs font-bold transform -rotate-3 shadow-brutal-hover">
                                    Diskon Aktif!
                                </div>
                            @else
                                <div class="font-black text-ink text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            @endif
                        </td>

                        <!-- Tombol Aksi -->
                        <td class="p-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="#" class="bg-sun border-2 border-ink px-4 py-2 font-bold text-sm shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                                    Edit
                                </a>
                                <button class="bg-coral text-white border-2 border-ink px-4 py-2 font-bold text-sm shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <!-- Jika tabel kosong -->
                    <tr>
                        <td colspan="5" class="p-12 text-center">
                            <div class="font-display font-bold text-ink text-2xl mb-2">Belum ada produk.</div>
                            <p class="font-body font-medium text-ink/70">Ayo tambahkan joran atau reel pertamamu!</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
