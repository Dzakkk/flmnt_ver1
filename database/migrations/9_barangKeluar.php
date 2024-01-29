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
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id('id_pengeluaran');
            $table->string('jenis_pengeluaran');
            $table->date('tanggal_keluar');
            $table->string('shipment');
            $table->string('id_customer');
            $table->string('NoSuratJalankeluar_NoProduksi');
            $table->string('NoPO_NoWO');
            $table->string('kategori_barang');
            $table->string('no_LOT');
            $table->string('dokumen');
            $table->string('FAI_code');
            $table->date('tanggal_produksi');
            $table->date('tanggal_expire');
            $table->float('total_qty_keluar_LOT', 8, 2);
            $table->string('unit');
            $table->string('jenis_kemasan');
            $table->float('berat_per_kemasan_KG', 8, 2);
            $table->float('total_QTY_kemasan', 8,2);
            $table->string('status');
            $table->string('id_rak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
