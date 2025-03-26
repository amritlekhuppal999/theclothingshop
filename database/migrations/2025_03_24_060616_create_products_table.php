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
            $table->id();
            $table->string("product_name");
            $table->string("product_slug");
            $table->integer("category_id");
            $table->integer("sub_category_id");
            $table->decimal("base_price", 8, 2);    // 8 means upto 8 digits including decimal places, 2 means only upto 2 decimal places
            $table->text("short_description");
            $table->text("long_description");
            $table->integer("status")->default(0)->comment("0 => Inactive, 1 => Active");
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
