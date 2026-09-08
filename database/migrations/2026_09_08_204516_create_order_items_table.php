<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            // Kita tidak pakai cascadeOnDelete di sini,
            // agar jika produk dihapus dari katalog, data riwayat pesanan (struk) tidak ikut hilang.
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();

            // Menyimpan nama produk saat dibeli (jaga-jaga kalau produk aslinya dihapus)
            $table->string('product_name');

            $table->integer('quantity');

            // Harga per item SAAT DIBELI
            $table->decimal('price', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
