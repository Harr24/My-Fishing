<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    // Memasukkan atribut buatan ke dalam respons JSON/Array
    protected $appends = ['final_price', 'active_promo'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function promos() {
        return $this->belongsToMany(Promo::class, 'promo_product');
    }

    // Accessor: Logika promo terbaik
    public function getActivePromoAttribute() {
        $now = now();
        $validPromos = $this->promos()
            ->where('is_active', true)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->get();

        if ($validPromos->isEmpty()) return null;

        return $validPromos->sortByDesc(function ($promo) {
            return $promo->type === 'percentage'
                ? ($this->price * ($promo->value / 100))
                : $promo->value;
        })->first();
    }

    // Accessor: Perhitungan harga akhir
    public function getFinalPriceAttribute() {
        $promo = $this->active_promo;
        if (!$promo) return $this->price;

        return $promo->type === 'percentage'
            ? $this->price - ($this->price * ($promo->value / 100))
            : max(0, $this->price - $promo->value);
    }
}
