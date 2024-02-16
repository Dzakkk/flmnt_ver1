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
        Schema::create('production_controls', function (Blueprint $table) {
            $table->string('no_production')->primary();
            $table->enum('cleanless', ['yes', 'no']);
            $table->enum('oddorless', ['yes', 'no']);
            $table->string('preparation_start');
            $table->string('preparation_finish');
            $table->string('wheiging_start');
            $table->string('wheiging_finish');
            $table->string('rpm');
            $table->string('temperature');
            $table->string('setting_time_mixing');
            $table->enum('QC_checked', ['yes', 'no']);
            $table->string('adjustment_rpm')->nullable();
            $table->string('adjustment_time')->nullable();
            $table->string('production_time_start');
            $table->string('production_time_finish');
            $table->string('packaging_time_start');
            $table->string('packaging_time_finish');
            $table->json('packaging_qty');
            $table->string('warehouse');
            $table->text('remark');
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
        Schema::dropIfExists('production_controls');
    }
};
