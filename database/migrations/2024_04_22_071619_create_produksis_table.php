<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->string('proses')->nullable();
            $table->string('category')->nullable();
            $table->string('barang')->nullable();
            $table->date('tanggal_produksi')->nullable();
            $table->date('tanggal_expire')->nullable();
            $table->string('tanki')->nullable();
            $table->string('noWO')->nullable();
            $table->string('no_produksi')->nullable();
            $table->string('LOT')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('FAI_code')->nullable();
            $table->string('nama_product')->nullable();
            $table->string('formula')->nullable();
            $table->string('aspect')->nullable();
            $table->string('build')->nullable();
            $table->string('segment')->nullable();
            $table->string('solubilty')->nullable();
            $table->string('cust_code')->nullable();
            $table->string('cust_name')->nullable();
            $table->float('total_qty', 8, 2)->nullable();
            $table->float('qty', 8, 2)->nullable();
            $table->string('kemasan')->nullable();
            $table->string('label_kemasan')->nullable();
            $table->string('total_kemasan')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produksi');
    }
};
