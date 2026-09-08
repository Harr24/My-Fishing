<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard Dinamis berdasarkan Role
Route::get('/dashboard', function () {
    // Ambil nama role pertama dari user yang sedang login
    $role = auth()->user()->roles->first()->name ?? 'member';

    // 1. KHUSUS UNTUK MEMBER (Hanya panggil view dashboard utama, tanpa bawa data produk)
    if ($role === 'member') {
        return view('member.dashboard');
    }

    // 2. UNTUK ROLE LAIN (Super Admin, dll)
    // Cek apakah file view-nya ada (misal: resources/views/super/dashboard.blade.php)
    if (view()->exists("{$role}.dashboard")) {
        return view("{$role}.dashboard");
    }

    // Jika file belum dibuat, fallback ke dashboard default
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTE KATALOG (BARU & DETAIL) ---
    Route::get('/katalog', [ProductController::class, 'katalog'])->name('katalog.index');
    Route::get('/katalog/{product}', [ProductController::class, 'show'])->name('katalog.show');

    // --- RUTE KERANJANG ---
    Route::post('/keranjang/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('keranjang.store');
    Route::get('/keranjang', [App\Http\Controllers\CartController::class, 'index'])->name('keranjang.index');
});

// ROUTE SUPER ADMIN
// Menggunakan middleware 'role:super'
Route::middleware(['auth', 'role:super'])->prefix('admin')->group(function () {

    // CRUD Kategori
    Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');

    // CRUD Produk
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{product}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{product}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('produk.destroy');

    // CRUD Promo
    Route::get('/promo', [App\Http\Controllers\PromoController::class, 'index'])->name('promo.index');
    Route::get('/promo/create', [App\Http\Controllers\PromoController::class, 'create'])->name('promo.create');
    Route::post('/promo', [App\Http\Controllers\PromoController::class, 'store'])->name('promo.store');
    Route::get('/promo/{promo}/edit', [App\Http\Controllers\PromoController::class, 'edit'])->name('promo.edit');
    Route::put('/promo/{promo}', [App\Http\Controllers\PromoController::class, 'update'])->name('promo.update');
    Route::delete('/promo/{promo}', [App\Http\Controllers\PromoController::class, 'destroy'])->name('promo.destroy');

});

require __DIR__.'/auth.php';
