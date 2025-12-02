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
        Schema::table('payments', function (Blueprint $table) {
            // Rename table if needed
            if (Schema::hasTable('payment') && !Schema::hasTable('payments')) {
                Schema::rename('payment', 'payments');
            }
            
            // Add new columns
            $table->string('payment_method')->nullable()->after('id_order');
            $table->string('status')->default('pending')->after('payment_method');
            $table->dateTime('payment_date')->nullable()->after('status');
            
            // Rename existing columns if needed
            if (Schema::hasColumn('payments', 'id_order')) {
                $table->renameColumn('id_order', 'order_id');
            }
            
            if (Schema::hasColumn('payments', 'nominal')) {
                $table->renameColumn('nominal', 'amount');
            }
            
            if (Schema::hasColumn('payments', 'bukti_pembayaran')) {
                $table->renameColumn('bukti_pembayaran', 'proof_of_payment');
            }
            
            // Add amount column if it doesn't exist
            if (!Schema::hasColumn('payments', 'amount')) {
                $table->decimal('amount', 10, 2)->after('order_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn([
                'payment_method',
                'status',
                'payment_date'
            ]);
            
            // Restore old column names
            $table->renameColumn('order_id', 'id_order');
            $table->renameColumn('amount', 'nominal');
            $table->renameColumn('proof_of_payment', 'bukti_pembayaran');
        });
    }
};