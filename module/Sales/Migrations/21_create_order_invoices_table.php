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
        Schema::create('order_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('submitted_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('sale_point_id')->constrained('sale_points')->cascadeOnDelete();
            $table->foreignId('territory_id')->constrained('territories')->cascadeOnDelete();
            $table->foreignId('depot_id')->nullable()->constrained('depots')->nullOnDelete();
            // $table->foreignId('depot_id')->constrained('depots')->cascadeOnDelete(); letter it will be final
            $table->string('invoice_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->integer('discount')->nullable(); // discount
            $table->enum('type', ['seed', 'agrochemicals'])->nullable();
            $table->enum('payment_type', ['Cash', 'Credit'])->default('Credit');
            $table->enum('status', ['Requested', 'Accepted', 'Assigned', 'Delivered', 'Partial Return', 'Return', 'Cancel'])->default('Requested');
            $table->decimal('return_amount', 10, 2)->nullable();
            $table->text('return_note')->nullable();
            $table->dateTime('invoice_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->boolean('is_printed')->default(false);
            $table->dateTime('printed_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_invoices');
    }
};
