<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesan')->constrained('user')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('product')->onDelete('cascade');

            // REMOVED: id_promo foreign key
            // $table->foreignId('id_promo')->nullable()->constrained('promo')->onDelete('set null');

            // Product snapshot columns
            $table->string('nama_produk')->nullable();      // Product name at purchase time
            $table->decimal('harga_produk', 12, 2)->nullable(); // Product price at purchase time

            // Promo snapshot columns
            $table->string('nama_promo')->nullable();       // Promo name at purchase time
            $table->decimal('potongan_harga', 5, 2)->nullable()->default(0); // Discount percentage

            $table->integer('kuantitas');
            $table->decimal('total_harga', 12, 2);
            $table->decimal('total_instalment', 12, 2)->nullable();

            // Add payment method column
            $table->string('payment_method', 50)->nullable()->default('transfer');

            $table->timestamp('waktu_berlaku')->nullable();
            $table->string('status', 100)->default('pending');
            $table->timestamps();

            // Indexes for better performance
            $table->index(['id_pemesan', 'status']);
            $table->index('waktu_berlaku');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
