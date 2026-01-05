<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->constrained('order')->onDelete('cascade');
            $table->string('payment_method'); // e.g., 'credit_card', 'qris', 'bank_transfer'
            $table->decimal('amount', 12, 2);
            $table->string('status'); // e.g., 'pending', 'capture', 'settlement', 'expire'
            $table->timestamp('payment_date')->nullable();
            $table->json('raw_response')->nullable(); // Store full webhook payload
            $table->string('bank')->nullable(); // For bank_transfer, credit_card
            $table->string('masked_card')->nullable(); // For credit_card
            $table->string('va_number')->nullable(); // For bank_transfer
            $table->timestamp('settlement_time')->nullable(); // For settlement status
            $table->string('transaction_id')->nullable(); // Midtrans transaction ID
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
