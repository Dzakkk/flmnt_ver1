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
        Schema::create('rak_gudang', function (Blueprint $table) {
            $table->string('id_rak')->primary();
            $table->integer('id_gudang');
            $table->string('keterangan');
            $table->string('posisi_lokasi');
            $table->float('kapasitas', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rak_gudang');
    }
};
