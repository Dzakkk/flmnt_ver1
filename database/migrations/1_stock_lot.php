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
        Schema::create('stock_lot', function (Blueprint $table) {
            $table->id('id_lot');
            $table->string('FAI_code');
            $table->string('no_LOT');
            $table->float('weight', 8, 2);
            $table->string('unit');
            $table->date('tanggal_produksi');
            $table->date('tanggal_expire');
            $table->string('id_rak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_lot');
    }
};
