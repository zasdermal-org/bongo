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
        Schema::create('sale_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('territory_id')->nullable()->constrained('territories')->nullOnDelete();
            $table->string('name');
            $table->string('code_number')->unique();
            $table->text('address')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->enum('customer_type', ['Trnder Govt', 'Tender Pvt', 'Deller'])->default('Deller');
            $table->enum('payment_type', ['Cash', 'Credit'])->default('Cash');
            $table->integer('discount')->nullable();
            $table->enum('is_active', ['Active', 'Inactive'])->default('Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_points');
    }
};
