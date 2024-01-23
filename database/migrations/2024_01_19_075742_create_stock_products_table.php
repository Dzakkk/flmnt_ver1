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
        Schema::create('stock_product', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('FAI_code');
            $table->string('FINA_code');
            $table->string('product_name');
            $table->string('storage');
            $table->float('weight', 8, 2);
            $table->string('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_product');
    }
};
