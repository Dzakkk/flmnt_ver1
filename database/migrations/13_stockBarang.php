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
        Schema::create('stock_barang', function (Blueprint $table) {
            $table->string('FAI_code')->primary();
            $table->string('product_name');
            $table->string('common_name');
            $table->string('aspect');
            $table->string('category');
            $table->float('quantity', 8, 2);
            $table->string('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_barang');
    }
};