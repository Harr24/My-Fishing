<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Untuk bikin kode acak

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Validasi input pembayaran (opsional tapi disarankan agar tidak error jika dikosongkan)
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // 1. Ambil semua isi keranjang
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        // Cegah checkout kalau keranjang kosong
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        // 2. Hitung Total Harga
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->quantity * $item->product->final_price;
        }

        // 3. Buat Struk Pesanan (Order)
        // Format Invoice: INV-TahunBulanTanggal-KodeAcak
        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice_number' => $invoice,
            'total_amount' => $total,
            'status' => 'pending', // Menunggu pembayaran
            // Ambil dari dropdown pilihan user
            'payment_method' => $request->payment_method
        ]);

        // 4. Pindahkan isi keranjang ke dalam struk (Order Items)
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name, // Simpan nama saat dibeli
                'quantity' => $item->quantity,
                'price' => $item->product->final_price // Simpan harga saat dibeli
            ]);
        }

        // 5. KOSONGKAN KERANJANG (Karena sudah pindah ke pesanan)
        Cart::where('user_id', Auth::id())->delete();

        // 6. Arahkan ke halaman sukses/detail pesanan (nanti kita buat view-nya)
        return redirect()->route('pesanan.show', $order->id)->with('success', 'Checkout berhasil! Silakan lakukan pembayaran.');
    }

    // Fungsi sementara agar halamannya tidak error setelah diredirect
    public function show(Order $order)
    {
        // Pastikan hanya pemilik pesanan yang bisa melihat
        if($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product'); // Muat relasi
        return view('member.pesanan_detail', compact('order'));
    }
    // Fungsi untuk melihat semua riwayat pesanan member
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('member.pesanan_index', compact('orders'));
    }

    // Fungsi untuk membatalkan pesanan
    public function cancel(Order $order)
    {
        // Hanya bisa dibatalkan jika statusnya masih pending dan milik user tersebut
        if ($order->user_id === Auth::id() && $order->status === 'pending') {
            $order->update(['status' => 'dibatalkan']);
            return back()->with('success', 'Pesanan ' . $order->invoice_number . ' berhasil dibatalkan.');
        }
        return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
    }
}
