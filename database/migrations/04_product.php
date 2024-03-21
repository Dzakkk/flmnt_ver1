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
        Schema::create('products', function (Blueprint $table) {
            $table->string('FAI_code')->primary();
            $table->string('category');
            $table->string('aspect');
            $table->string('FINA_code');
            $table->string('product_name');
            $table->string('build_product');
            $table->string('formula_id');
            $table->string('range_color');
            $table->string('odour_taste');
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
            $table->string('segment');
            $table->string('solubility');
            $table->date('created_date');
            $table->date('release_date');
            $table->string('created_by');
            $table->text('note')->nullable();
            $table->float('target_order', 8, 2);
            $table->string('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
