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
        Schema::create('collection_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submitted_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('approved_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('sale_point_id')->constrained('sale_points')->cascadeOnDelete();
            $table->json('selected_invoices')->nullable();
            $table->enum('invoice_type', ['Cash', 'Credit'])->nullable();
            $table->decimal('total_collect', 10, 2)->nullable();
            $table->decimal('adjustment_amt', 10, 2)->nullable();
            $table->decimal('return_amt', 10, 2)->nullable();
            $table->decimal('advance', 15, 2)->nullable();
            $table->enum('payment_type', ['Cash', 'Cheque', 'AC Transfer'])->nullable();
            $table->string('receipt_number')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->nullable();
            $table->dateTime('collection_date');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_requests');
    }
};
