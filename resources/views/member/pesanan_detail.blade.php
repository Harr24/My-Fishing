<x-app-layout>
    <x-slot name="header">Detail Pesanan #{{ $order->invoice_number }}</x-slot>

    <!-- Notifikasi Sukses Checkout -->
    @if(session('success'))
        <div class="mb-8 bg-seaweed text-white border-3 border-ink shadow-brutal p-6 flex items-center justify-between transform rotate-1">
            <div class="flex items-center gap-3 font-display font-bold text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="square" stroke-linejoin="miter" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                {{ session('success') }}
            </div>
            <button onclick="this.parentElement.style.display='none'" class="hover:text-ink transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="square" stroke-linejoin="miter" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    <!-- Kertas Invoice -->
    <div class="bg-white border-3 border-ink shadow-brutal p-6 md:p-12 max-w-4xl mx-auto mb-12">

        <!-- Header Invoice -->
        <div class="flex flex-col md:flex-row justify-between items-start border-b-4 border-ink pb-8 mb-8 gap-4">
            <div>
                <h1 class="font-display font-black text-5xl text-ink tracking-tight mb-2">INVOICE</h1>
                <p class="font-bold text-ink/70 text-lg border-2 border-ink inline-block px-3 py-1 bg-foam">
                    {{ $order->invoice_number }}
                </p>
            </div>
            <div class="text-left md:text-right">
                <span class="inline-block bg-sun border-3 border-ink px-4 py-2 font-black uppercase tracking-widest text-sm shadow-brutal mb-2">
                    STATUS: {{ $order->status }}
                </span>
                <p class="font-bold text-ink/80 text-sm">Tanggal: {{ $order->created_at->format('d M Y - H:i') }}</p>
                <p class="font-bold text-ink/80 text-sm">Pembeli: {{ $order->user->name }}</p>
            </div>
        </div>

        <!-- Instruksi Pembayaran -->
        <div class="bg-foam border-3 border-ink p-6 mb-10 transform -rotate-1 shadow-brutal-hover">
            <h3 class="font-display font-black text-2xl mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-ocean"><path stroke-linecap="square" stroke-linejoin="miter" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                Instruksi Pembayaran
            </h3>
            <p class="mb-4 text-ink/80 font-medium text-lg">Silakan transfer tepat sebesar <strong class="text-coral">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> ke rekening berikut:</p>

            <div class="bg-white border-3 border-ink p-5 font-mono font-black text-xl inline-block shadow-brutal tracking-wider text-ocean">
                BCA 123-456-7890 <br>
                <span class="text-sm text-ink/70">a.n. Toko MyFishing Indonesia</span>
            </div>

            <p class="mt-4 text-sm font-bold text-coral flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="square" stroke-linejoin="miter" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" /></svg>
                Jangan lupa simpan bukti transfer Anda untuk verifikasi!
            </p>
        </div>

        <!-- Daftar Barang -->
        <h3 class="font-display font-black text-2xl mb-4">Ringkasan Belanja</h3>
        <div class="overflow-x-auto border-3 border-ink mb-8 shadow-brutal">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-ocean text-white">
                        <th class="border-b-3 border-ink p-4 font-bold uppercase tracking-widest text-sm">Produk</th>
                        <th class="border-b-3 border-l-3 border-ink p-4 font-bold text-center uppercase tracking-widest text-sm">Qty</th>
                        <th class="border-b-3 border-l-3 border-ink p-4 font-bold text-right uppercase tracking-widest text-sm">Harga Satuan</th>
                        <th class="border-b-3 border-l-3 border-ink p-4 font-bold text-right uppercase tracking-widest text-sm">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($order->items as $item)
                    <tr class="hover:bg-foam transition-colors">
                        <td class="border-b-2 border-ink p-4 font-bold text-lg">{{ $item->product_name }}</td>
                        <td class="border-b-2 border-l-3 border-ink p-4 text-center font-black text-lg bg-sun/30">{{ $item->quantity }}</td>
                        <td class="border-b-2 border-l-3 border-ink p-4 text-right font-medium">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="border-b-2 border-l-3 border-ink p-4 text-right font-black text-seaweed">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-sun">
                        <td colspan="3" class="p-5 text-right font-black text-xl border-t-3 border-ink">TOTAL KESELURUHAN</td>
                        <td class="p-5 text-right font-black text-3xl text-coral border-t-3 border-l-3 border-ink">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-wrap justify-center gap-4 mt-8 border-t-4 border-ink pt-8">
            <a href="{{ route('dashboard') }}" class="bg-white text-ink border-3 border-ink px-6 py-3 font-bold text-lg shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="square" stroke-linejoin="miter" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                Kembali
            </a>
            <button onclick="window.print()" class="bg-seaweed text-white border-3 border-ink px-8 py-3 font-black text-lg shadow-brutal hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-brutal-hover transition-all flex items-center gap-2 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="square" stroke-linejoin="miter" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0v2.796c0 1.18.91 2.164 2.09 2.201a51.964 51.964 0 0 0 3.32 0c1.18-.037 2.09-1.022 2.09-2.201V8.25m10.5 0-1.09-1.09a2.25 2.25 0 0 0-1.591-.66h-5.638c-.597 0-1.17.237-1.591.66L6.34 8.25" /></svg>
                CETAK INVOICE
            </button>
        </div>
    </div>
</x-app-layout>
