<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            // $table->foreignId('product_id')->nullable()->after('id')->unique()->constrained('products')->nullOnDelete();
            $table->unsignedBigInteger('product_id')->nullable()->unique()->after('id');
        });

        DB::table('stocks')->orderBy('id')->chunk(100, function ($stocks) {
            foreach ($stocks as $stock) {
                $product = DB::table('products')->where('sku', $stock->sku)->first();
                if ($product) {
                    DB::table('stocks')
                        ->where('id', $stock->id)
                        ->update(['product_id' => $product->id]);
                }
            }
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('RESTRICT');
        });

        Schema::table('stocks', function (Blueprint $table) {
            // Drop product_name, since product_id will be used
            $table->dropColumn('product_name');
            $table->foreignId('product_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
