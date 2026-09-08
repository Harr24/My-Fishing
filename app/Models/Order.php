<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu pesanan bisa punya banyak barang
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
