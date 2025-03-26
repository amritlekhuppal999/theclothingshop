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
        Schema::create('sub_products', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->string("variant_name");
            $table->string("variant_slug");
            $table->integer("stock");
            $table->string("sku");
            $table->decimal("price", 8, 2); // 8 means upto 8 digits including decimal places, 2 means only upto 2 decimal places.
            $table->integer("status")->default(0)->comment("0 => Inactive, 1 => Active, 2 => Out of Stock");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_products');
    }
};
