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
            $table->string('FAI_code');
            $table->enum('cleanless', ['yes', 'no']);
            $table->enum('oddorless', ['yes', 'no']);
            $table->string('preparation_start')->nullable();
            $table->string('preparation_finish')->nullable();
            $table->string('wheiging_start')->nullable();
            $table->string('wheiging_finish')->nullable();
            $table->string('rpm')->nullable();
            $table->string('temperature')->nullable();
            $table->string('setting_time_mixing')->nullable();
            $table->enum('QC_checked', ['yes', 'no']);
            $table->string('adjustment_rpm')->nullable();
            $table->string('adjustment_time')->nullable();
            $table->string('production_time_start')->nullable();
            $table->string('production_time_finish')->nullable();
            $table->string('packaging_time_start')->nullable();
            $table->string('packaging_time_finish')->nullable();
            $table->json('packaging_qty')->nullable();
            $table->string('warehouse')->nullable();
            $table->text('remark')->nullable();
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
