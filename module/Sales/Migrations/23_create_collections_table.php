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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('sale_point_id')->constrained('sale_points')->cascadeOnDelete();
            $table->text('invoice_numbers');
            $table->decimal('total_collect', 10, 2)->nullable();
            $table->decimal('adjustment_amt', 10, 2)->nullable();
            $table->decimal('return_amt', 10, 2)->nullable();
            $table->enum('payment_type', ['Cash', 'Cheque', 'AC Transfer'])->nullable(); // cash or cheque
            $table->string('receipt_number')->nullable(); // transection details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
