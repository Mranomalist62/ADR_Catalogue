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
            $table->foreignId('id_promo')->nullable()->constrained('promo')->onDelete('set null');
            $table->integer('kuantitas');
            $table->integer('total_harga');
            $table->integer('total_instalment')->nullable();
            $table->timestamp('waktu_berlaku')->nullable();
            $table->string('status', 100)->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
