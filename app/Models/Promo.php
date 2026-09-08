<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    // Mengizinkan semua kolom diisi secara massal kecuali ID
    protected $guarded = ['id'];

    // Memastikan format tanggal otomatis diubah menjadi objek Carbon/Datetime
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relasi Many-to-Many ke Produk (Jangan lupa sebutkan nama tabel pivot-nya!)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'promo_product');
    }

    // Relasi ke User yang membuat promo (Super Admin)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
