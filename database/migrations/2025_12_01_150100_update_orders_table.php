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
        Schema::table('orders', function (Blueprint $table) {
            // Add new columns
            $table->string('order_number')->unique()->after('id');
            $table->foreignId('address_id')->nullable()->after('user_id')->constrained('addresses')->onDelete('set null');
            $table->decimal('subtotal', 10, 2)->after('address_id');
            $table->decimal('shipping_cost', 10, 2)->default(0)->after('subtotal');
            $table->decimal('discount', 10, 2)->default(0)->after('shipping_cost');
            $table->string('payment_method')->nullable()->after('discount');
            $table->string('shipping_method')->default('regular')->after('payment_method');
            $table->text('notes')->nullable()->after('shipping_method');
            $table->dateTime('order_date')->nullable()->after('notes');
            
            // Rename existing columns if needed
            if (Schema::hasColumn('orders', 'id_pemesan')) {
                $table->renameColumn('id_pemesan', 'user_id');
            }
            
            // Drop columns that are no longer needed
            if (Schema::hasColumn('orders', 'id_produk')) {
                $table->dropColumn('id_produk');
            }
            if (Schema::hasColumn('orders', 'id_promo')) {
                $table->dropColumn('id_promo');
            }
            if (Schema::hasColumn('orders', 'kuantitas')) {
                $table->dropColumn('kuantitas');
            }
            if (Schema::hasColumn('orders', 'total_harga')) {
                $table->dropColumn('total_harga');
            }
            if (Schema::hasColumn('orders', 'total_instalment')) {
                $table->dropColumn('total_instalment');
            }
            if (Schema::hasColumn('orders', 'waktu_berlaku')) {
                $table->dropColumn('waktu_berlaku');
            }
            
            // Rename total_harga to total if it exists but wasn't dropped
            if (Schema::hasColumn('orders', 'total_harga') && !Schema::hasColumn('orders', 'total')) {
                $table->renameColumn('total_harga', 'total');
            }
            
            // Add total column if it doesn't exist
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->after('discount');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn([
                'order_number',
                'address_id',
                'subtotal',
                'shipping_cost',
                'discount',
                'payment_method',
                'shipping_method',
                'notes',
                'order_date'
            ]);
            
            // Restore old columns if needed
            $table->renameColumn('user_id', 'id_pemesan');
            $table->foreignId('id_produk')->nullable()->after('id_pemesan')->constrained('products');
            $table->foreignId('id_promo')->nullable()->after('id_produk')->constrained('promos');
            $table->integer('kuantitas')->after('id_promo');
            $table->decimal('total_harga', 10, 2)->after('kuantitas');
            $table->decimal('total_instalment', 10, 2)->nullable()->after('total_harga');
            $table->date('waktu_berlaku')->nullable()->after('total_instalment');
        });
    }
};