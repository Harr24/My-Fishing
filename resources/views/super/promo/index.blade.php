<x-app-layout>
    <x-slot name="header">Kelola Promo</x-slot>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="mb-6 bg-seaweed text-white border-3 border-ink shadow-brutal p-4 flex items-center justify-between">
            <div class="flex items-center gap-2 font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="square" stroke-linejoin="miter" d="m4.5 12.75 6 6 9-13.5" /></svg>
                {{ session('success') }}
            </div>
            <button onclick="this.parentElement.style.display='none'" class="hover:text-ink transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="square" stroke-linejoin="miter" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="font-display font-bold text-2xl text-ink">Daftar Promo & Diskon 🏷️</h2>
        <a href="{{ route('promo.create') }}" class="btn-brutal bg-ocean text-white">
            + Buat Promo Baru
        </a>
    </div>

    <!-- Tabel Promo -->
    <div class="bg-white border-3 border-ink shadow-brutal overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-sun border-b-3 border-ink font-display text-ink text-lg">
                    <th class="p-4 border-r-3 border-ink">Nama Promo</th>
                    <th class="p-4 border-r-3 border-ink">Potongan</th>
                    <th class="p-4 border-r-3 border-ink">Masa Berlaku</th>
                    <th class="p-4 border-r-3 border-ink text-center">Jml Produk</th>
                    <th class="p-4 border-r-3 border-ink text-center">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-body">
                @forelse($promos as $promo)
                    <tr class="border-b-3 border-ink last:border-b-0 hover:bg-foam transition-colors">
                        <td class="p-4 border-r-3 border-ink font-bold text-ocean text-lg">
                            {{ $promo->name }}
                        </td>
                        <td class="p-4 border-r-3 border-ink font-black text-xl">
                            @if($promo->type == 'percentage')
                                {{ (int)$promo->value }}%
                            @else
                                Rp {{ number_format($promo->value, 0, ',', '.') }}
                            @endif
                        </td>
                        <td class="p-4 border-r-3 border-ink text-sm font-medium">
                            <div class="text-ink">Mulai: {{ $promo->start_date->format('d M Y, H:i') }}</div>
                            <div class="text-coral">Akhir: {{ $promo->end_date->format('d M Y, H:i') }}</div>
                        </td>
                        <td class="p-4 border-r-3 border-ink text-center font-bold text-xl">
                            {{ $promo->products_count }}
                        </td>
                        <td class="p-4 border-r-3 border-ink text-center">
                            @if($promo->is_active && $promo->end_date > now())
                                <span class="bg-seaweed text-white border-2 border-ink px-2 py-1 text-xs font-bold shadow-brutal-hover">AKTIF</span>
                            @else
                                <span class="bg-foam text-ink border-2 border-ink px-2 py-1 text-xs font-bold shadow-brutal-hover">TIDAK AKTIF</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('promo.edit', $promo->id) }}" class="bg-sun border-2 border-ink px-3 py-1 font-bold text-sm shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                                    Edit
                                </a>
                                <form action="{{ route('promo.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus promo ini? Semua produk akan kembali ke harga normal.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-coral text-white border-2 border-ink px-3 py-1 font-bold text-sm shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center">
                            <div class="font-display font-bold text-ink text-2xl mb-2">Belum ada promo aktif.</div>
                            <p class="font-body font-medium text-ink/70">Buat diskon untuk menarik minat pelanggan!</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
