<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Fungsi untuk menambah barang ke keranjang
    public function store(Request $request, Product $product)
    {
        // Cek apakah produk ini sudah ada di keranjangnya user yang sedang login?
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, tinggal tambah jumlahnya (quantity) 1
            $cartItem->increment('quantity');
        } else {
            // Jika belum ada, buat entri keranjang baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        // Kembalikan ke halaman katalog dengan notifikasi sukses
        return redirect()->route('dashboard')->with('success', 'Hore! ' . $product->name . ' berhasil masuk ke keranjang belanja Anda.');
    }

    public function index()
    {
        // Ambil semua isi keranjang milik user yang sedang login, bawa juga data produknya
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->latest()->get();

        // Hitung total harga (Quantity x Harga Final Produk)
        $totalPrice = $cartItems->sum(function($cart) {
            return $cart->quantity * $cart->product->final_price;
        });

        return view('member.cart', compact('cartItems', 'totalPrice'));
    }
    // Fungsi untuk menambah/mengurangi kuantitas
    public function update(Request $request, Cart $cart)
    {
        // Pastikan keranjang ini benar milik user yang login
        if ($cart->user_id === Auth::id()) {
            if ($request->action === 'increase') {
                $cart->increment('quantity');
            } elseif ($request->action === 'decrease') {
                // Jika jumlahnya lebih dari 1, kurangi. Jika 1, jangan lakukan apa-apa (harus pakai tombol hapus)
                if ($cart->quantity > 1) {
                    $cart->decrement('quantity');
                }
            }
        }

        return back(); // Kembali ke halaman keranjang
    }

    // Fungsi untuk menghapus barang dari keranjang
    public function destroy(Cart $cart)
    {
        if ($cart->user_id === Auth::id()) {
            $cart->delete();
        }

        return back()->with('success', 'Barang berhasil dibuang dari keranjang.');
    }
}
