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
});

// --- ROUTE KHUSUS SUPER ADMIN ---
// Menggunakan middleware 'role:super' (hanya Super Admin yang bisa mengakses)
Route::middleware(['auth', 'role:super'])->prefix('admin')->group(function () {

    // CRUD Kategori
    Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');

    // CRUD Produk
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');

});

require __DIR__.'/auth.php';
