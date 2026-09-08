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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Nomor resi/invoice unik (misal: INV-20260908-XXX)
            $table->string('invoice_number')->unique();

            // Total belanjaan
            $table->decimal('total_amount', 15, 2);

            // Status pesanan: pending, paid, shipped, completed, cancelled
            $table->string('status')->default('pending');

            // Metode pembayaran (Bank Transfer, COD, dll)
            $table->string('payment_method')->nullable();

            // Catatan tambahan dari pembeli
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
