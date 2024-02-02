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
        Schema::create('cust_list', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_code');
            $table->string('PO_customer');
            $table->string('FAI_code');
            $table->string('id_customer');
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
        Schema::dropIfExists('cust_list');
    }
};
