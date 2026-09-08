<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua produk beserta data kategori dan promonya
        $products = Product::with(['category', 'promos'])->latest()->get();

        // Melempar data ke file view (yang akan kita buat setelah ini)
        return view('super.produk.index', compact('products'));
    }

    public function create()
    {
        // Mengambil semua data kategori untuk dropdown
        $categories = \App\Models\Category::all();

        return view('super.produk.create', compact('categories'));
    }


    public function store(Request $request)
    {
        // 1. Validasi Input Server-Side
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku', // Pastikan SKU tidak kembar
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Kategori harus valid
            'stock_alert_threshold' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ], [
            // Pesan error kustom (opsional tapi bagus untuk UX)
            'sku.unique' => 'SKU ini sudah digunakan, silakan pakai kode yang lain.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.'
        ]);

        // 2. Handle Upload Gambar (Jika User Memasukkan Gambar)
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder storage/app/public/products
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // 3. Tangkap nilai checkbox (karena jika tidak dicentang, HTML tidak mengirim apa-apa)
        $validated['is_active'] = $request->has('is_active') ? true : false;

        // 4. Simpan ke Database
        Product::create($validated);

        // 5. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk baru berhasil ditambahkan ke katalog!');
    }
    public function edit(Product $product)
    {
        $categories = \App\Models\Category::all();
        return view('super.produk.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Pengecualian SKU: Boleh pakai SKU yang sama ASALKAN milik ID produk ini sendiri
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock_alert_threshold' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar fisik dari folder sebelum datanya dihapus dari database
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus dari sistem!');
    }

    public function show(\App\Models\Product $product)
    {
        // Pastikan data kategori dan promo ikut dimuat (Eager Loading)
        $product->load(['category', 'promos']);

        // Tampilkan ke halaman detail khusus member
        return view('member.detail', compact('product'));
    }

    public function katalog()
    {
        // Ambil produk untuk halaman katalog member
        $products = \App\Models\Product::with(['category', 'promos'])->where('is_active', true)->latest()->get();
        return view('member.katalog', compact('products'));
    }
}
