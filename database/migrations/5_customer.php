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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('id_customer')->primary();
            $table->string('customer_name');
            $table->string('telephone');
            $table->string('contact_name');
            $table->string('status');
            $table->string('address');
            $table->string('city');
            $table->string('provinces');
            $table->string('postal_code');
            $table->string('country');
            $table->string('email');
            $table->text('note')->nullable();
            $table->string('sales_name'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
