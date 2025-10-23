<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promolist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('product')->onDelete('cascade');
            $table->foreignId('id_promo')->constrained('promo')->onDelete('cascade');
            $table->string('path_thumbnail', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promolist');
    }
};
