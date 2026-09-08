<x-app-layout>
    <x-slot name="header">Riwayat Pesanan</x-slot>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="mb-6 bg-seaweed text-white border-3 border-ink shadow-brutal p-4 font-bold">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-6 bg-coral text-white border-3 border-ink shadow-brutal p-4 font-bold">{{ session('error') }}</div>
    @endif

    <div class="mb-8">
        <h2 class="font-display font-black text-3xl text-ink">Riwayat Transaksi 🧾</h2>
        <p class="font-body text-ink/70 mt-1">Pantau status pesanan dan riwayat belanja Anda di sini.</p>
    </div>

    <!-- Tabel Riwayat -->
    <div class="bg-white border-3 border-ink shadow-brutal overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-sun border-b-3 border-ink">
                        <th class="p-4 font-black uppercase tracking-widest text-sm border-r-3 border-ink">Invoice & Tanggal</th>
                        <th class="p-4 font-black uppercase tracking-widest text-sm border-r-3 border-ink">Total & Metode</th>
                        <th class="p-4 font-black uppercase tracking-widest text-sm border-r-3 border-ink text-center">Status</th>
                        <th class="p-4 font-black uppercase tracking-widest text-sm text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b-2 border-ink hover:bg-foam transition-colors">
                            <!-- Kolom Invoice -->
                            <td class="p-4 border-r-3 border-ink">
                                <div class="font-black text-lg text-ink">{{ $order->invoice_number }}</div>
                                <div class="text-sm font-bold text-ink/60">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </td>

                            <!-- Kolom Harga & Metode -->
                            <td class="p-4 border-r-3 border-ink">
                                <div class="font-black text-lg text-coral">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                <div class="text-xs font-bold bg-white border-2 border-ink inline-block px-2 py-1 mt-1 shadow-brutal">
                                    {{ $order->payment_method ?? 'Bank Transfer' }}
                                </div>
                            </td>

                            <!-- Kolom Status -->
                            <td class="p-4 border-r-3 border-ink text-center">
                                @if($order->status == 'pending')
                                    <span class="bg-sun border-2 border-ink px-3 py-1 font-bold text-sm shadow-brutal">Menunggu Pembayaran</span>
                                @elseif($order->status == 'dibatalkan')
                                    <span class="bg-coral text-white border-2 border-ink px-3 py-1 font-bold text-sm shadow-brutal">Dibatalkan</span>
                                @else
                                    <span class="bg-seaweed text-white border-2 border-ink px-3 py-1 font-bold text-sm shadow-brutal">{{ strtoupper($order->status) }}</span>
                                @endif
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('pesanan.show', $order->id) }}" class="bg-ocean text-white border-2 border-ink px-3 py-2 font-bold text-sm shadow-brutal-hover hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                                        Detail
                                    </a>

                                    <!-- Tombol Batal (Hanya jika masih pending) -->
                                    @if($order->status === 'pending')
                                        <form action="{{ route('pesanan.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-white text-coral border-2 border-ink px-3 py-2 font-bold text-sm shadow-brutal-hover hover:bg-coral hover:text-white transition-all cursor-pointer">
                                                Batal
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center bg-white font-bold text-ink/70">
                                <div class="text-5xl mb-4">👻</div>
                                Belum ada riwayat pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
