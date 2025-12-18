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

            $table->unsignedBigInteger('id_alamat')->nullable();
            $table->text('alamat_pengiriman')->nullable();
            $table->string('nama_penerima', 100)->nullable();
            $table->string('telepon_penerima', 20)->nullable();

            // Product snapshot columns
            $table->string('nama_produk')->nullable();
            $table->decimal('harga_produk', 12, 2)->nullable();

            // Promo snapshot columns
            $table->string('nama_promo')->nullable();
            $table->decimal('potongan_harga', 5, 2)->nullable()->default(0);

            $table->integer('kuantitas');
            $table->decimal('total_harga', 12, 2);
            $table->decimal('total_instalment', 12, 2)->nullable();
            $table->string('payment_method', 50)->nullable()->default('transfer');
            $table->timestamp('waktu_berlaku')->nullable();
            $table->string('status', 100)->default('pending');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('id_alamat')->references('id')->on('address')->onDelete('set null');

            // Indexes
            $table->index('id_alamat');
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
