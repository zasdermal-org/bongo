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
        Schema::create('transections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('stock_id')->nullable()->constrained('stocks')->nullOnDelete();
            $table->foreignId('order_invoice_id')->nullable()->constrained('order_invoices')->nullOnDelete();
            // $table->string('product_name');
            $table->string('sku');
            $table->integer('pre_stock');
            $table->integer('tran_quant');
            $table->integer('curr_stock');
            $table->decimal('sales_value', 10, 2)->nullable();
            $table->enum('tran_type', ['Warehouse Stock In',  'Warehouse to Sale Point', 'Sale Point to Warehouse']);
            $table->enum('status', ['Stock In', 'Stock Out', 'Return']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transections');
    }
};
