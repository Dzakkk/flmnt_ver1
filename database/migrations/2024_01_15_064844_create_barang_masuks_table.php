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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id('id_penerimaan');
            $table->string('jenis_penerimaan');
            $table->date('tanggal_masuk');
            $table->string('id_supplier');
            $table->string('NoSuratJalanMasuk_NoProduksi');
            $table->string('NoPO_NoWO');
            $table->string('kategori_barang');
            $table->string('dokumen');
            $table->string('FAI_code');
            $table->string('no_LOT');
            $table->date('tanggal_produksi');
            $table->date('tanggal_expire');
            $table->float('qty_masuk_LOT', 8, 2);
            $table->string('unit');
            $table->string('jenis_kemasan');
            $table->float('satuan_QTY_kemasan', 8, 2);
            $table->float('total_QTY_kemasan',8 ,2);
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
        Schema::dropIfExists('barang_masuk');
    }
};
