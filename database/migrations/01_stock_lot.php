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
            $table->string('no_LOT')->nullable();
            $table->float('quantity', 8, 2);
            $table->string('unit')->nullable();
            $table->float('jumlah_kemasan', 8, 2)->nullable();
            $table->string('jenis_kemasan')->nullable();
            $table->date('tanggal_produksi')->nullable();
            $table->date('tanggal_expire')->nullable();
            $table->string('id_rak')->nullable();
            $table->string('no_production')->nullable();
            $table->string('no_work_order')->nullable();
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
