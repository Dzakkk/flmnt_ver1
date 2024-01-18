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
            $table->string('kategori_barang');
            $table->string('aspect');
            $table->string('initial_code');
            $table->string('number_code');
            $table->string('alokasi_penyimpanan');
            $table->float('reOrder_qty', 8, 3);
            $table->string('unit');
            $table->string('supplier');
            $table->string('packaging_type');
            $table->string('documentation');
            $table->string('halal_certification');
            $table->string('name');
            $table->string('common_name');
            $table->string('brandProduct_code');
            $table->string('chemical_IUPACname');
            $table->string('CAS_number');
            $table->string('ex_origin');
            $table->string('initial_ex');
            $table->string('country_of_origin');
            $table->string('remark');
            $table->string('usage_level');
            $table->float('harga_ex_work_USD', 8, 3);
            $table->float('harga_CIF_USD', 8, 3);
            $table->float('harga_MOQ_USD', 8, 3);
            $table->string('appearance');
            $table->string('color_rangeColor');
            $table->string('odour_taste');
            $table->string('material');
            $table->string('spesific_gravity_d20');
            $table->string('spesific_gravity_d25');
            $table->string('refractive_index_d20');
            $table->string('refractive_index_d25');
            $table->float('berat_gram', 8, 3);
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
