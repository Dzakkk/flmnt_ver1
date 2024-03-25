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
        Schema::create('quality_controls', function (Blueprint $table) {
            $table->id();
            $table->string('LOT');
            $table->string('FAI_code');
            $table->string('product_name');
            $table->string('no_production')->nullable();
            $table->string('qty');
            $table->string('customer')->nullable();
            $table->date('tanggal_produksi')->nullable();
            $table->string('test_methode');
            $table->string('appereance')->nullable();
            $table->string('range_color')->nullable();
            $table->string('odour_taste')->nullable();
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
            $table->float('sg_d20_value', 8, 3)->nullable();
            $table->float('sg_d25_value', 8, 3)->nullable();
            $table->float('ri_d20_value', 8, 3)->nullable();
            $table->float('ri_d25_value', 8, 3)->nullable();
            $table->string('sg_d20_result')->nullable();
            $table->string('sg_d25_result')->nullable();
            $table->string('ri_d20_result')->nullable();
            $table->string('ri_d25_result')->nullable();
            $table->string('color_value')->nullable();
            $table->string('odour_value')->nullable();
            $table->string('taste_value')->nullable();
            $table->string('color_result')->nullable();
            $table->string('odour_result')->nullable();
            $table->string('taste_result')->nullable();
            $table->text('note')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('quality_controls');
    }
};
