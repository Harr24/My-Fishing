<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Izinkan pengisian data massal
    protected $guarded = ['id'];

    // Relasi: Keranjang ini milik siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Keranjang ini berisi produk apa?
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
