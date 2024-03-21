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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('FAI_code')->primary();
            $table->string('FINA_code');
            $table->string('kategori_barang')->nullable();
            $table->string('aspect')->nullable();
            $table->float('reOrder_qty', 8, 2)->nullable();
            $table->string('unit')->nullable();
            $table->string('supplier')->nullable();
            $table->string('packaging_type')->nullable();
            $table->string('documentation')->nullable();
            $table->string('halal_certification')->nullable();
            $table->string('name');
            $table->string('common_name')->nullable();
            $table->string('brandProduct_code')->nullable();
            $table->string('chemical_IUPACname')->nullable();
            $table->string('CAS_number')->nullable();
            $table->string('ex_origin')->nullable();
            $table->string('initial_ex')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->string('remark')->nullable();
            $table->string('usage_level')->nullable();
            $table->float('harga_ex_work_USD', 8, 2)->nullable();
            $table->float('harga_CIF_USD', 8, 2)->nullable();
            $table->float('harga_MOQ_USD', 8, 2)->nullable();
            $table->string('appearance')->nullable();
            $table->string('color_rangeColor')->nullable();
            $table->string('odour_taste')->nullable();
            $table->string('material')->nullable();
            $table->string('sg_d20_min')->nullable();
            $table->string('sg_d20_max')->nullable();
            $table->string('sg_d20_target')->nullable();
            $table->string('sg_d25_min')->nullable();
            $table->string('sg_d25_max')->nullable();
            $table->string('sg_d25_target')->nullable();
            $table->string('ri_d20_min')->nullable();
            $table->string('ri_d20_max')->nullable();
            $table->string('ri_d20_target')->nullable();
            $table->string('ri_d25_min')->nullable();
            $table->string('ri_d25_max')->nullable();
            $table->string('ri_d25_target')->nullable();
            $table->float('berat_gram', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
