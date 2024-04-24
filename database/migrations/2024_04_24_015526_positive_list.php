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
        Schema::create('positive_list', function (Blueprint $table) {
            $table->id();
            $table->string('CAS')->nullable();
            $table->string('nama_kimia')->nullable();
            $table->string('pangan')->nullable();
            $table->string('kosmetik')->nullable();
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
        //
    }
};
