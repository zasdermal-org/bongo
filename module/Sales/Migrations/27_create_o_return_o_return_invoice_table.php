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
        Schema::create('o_return_o_return_invoice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('o_return_id')->constrained('o_returns')->cascadeOnDelete();
            $table->foreignId('o_return_invoice_id')->constrained('o_return_invoices')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_return_o_return_invoice');
    }
};
