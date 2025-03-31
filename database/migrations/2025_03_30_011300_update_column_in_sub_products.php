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
        Schema::table('sub_products', function (Blueprint $table) {
            //
            $table->integer('product_id')->default(0)->change();
            $table->integer('stock')->default(0)->change();
            $table->string('variant_name')->default('')->change();
            $table->string('variant_slug')->default('')->change();
            $table->string('sku')->default('')->change();
            $table->integer('price')->default(0.00)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_products', function (Blueprint $table) {
            //
            $table->integer('product_id')->default(null)->change();
            $table->integer('stock')->default(null)->change();
            $table->string('variant_name')->default(null)->change();
            $table->string('variant_slug')->default(null)->change();
            $table->string('sku')->default(null)->change();
            $table->integer('price')->default(null)->change();
        });
    }
};
