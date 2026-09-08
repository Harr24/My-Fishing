<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoController extends Controller
{
    public function index()
    {
        // Ambil semua promo beserta jumlah produk yang diikutkan promo
        $promos = Promo::withCount('products')->latest()->get();
        return view('super.promo.index', compact('promos'));
    }

    public function create()
    {
        // Ambil produk yang aktif untuk dipilih masuk ke dalam promo
        $products = Product::where('is_active', true)->get();
        return view('super.promo.create', compact('products'));
    }

    public function edit(Promo $promo)
    {
        $products = Product::where('is_active', true)->get();
        // Kita ambil daftar ID produk yang saat ini sedang memakai promo ini
        $selectedProducts = $promo->products->pluck('id')->toArray();

        return view('super.promo.edit', compact('promo', 'products', 'selectedProducts'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id'
        ]);

        $validated['is_active'] = $request->has('is_active');

        // 1. Update data inti promo
        $promo->update($validated);

        // 2. Sync relasi tabel pivot (Otomatis menyesuaikan centangan baru)
        $promo->products()->sync($request->product_ids);

        return redirect()->route('promo.index')->with('success', 'Perubahan promo berhasil disimpan!');
    }

    public function destroy(Promo $promo)
    {
        // Putuskan dulu semua relasi produk di tabel pivot agar tidak ada data yatim piatu (orphan data)
        $promo->products()->detach();

        // Baru hapus promonya
        $promo->delete();

        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus dan harga produk kembali normal!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'product_ids' => 'required|array', // Harus memilih minimal 1 produk
            'product_ids.*' => 'exists:products,id'
        ]);

        // Tambahkan ID pembuat promo dan status aktif
        $validated['created_by'] = Auth::id();
        $validated['is_active'] = $request->has('is_active');

        // 1. Simpan data ke tabel promos
        $promo = Promo::create($validated);

        // 2. Simpan relasi produk ke tabel pivot (promo_product)b dengan sync!
        $promo->products()->sync($request->product_ids);

        return redirect()->route('promo.index')->with('success', 'Promo spesial berhasil diluncurkan!');
    }
}
