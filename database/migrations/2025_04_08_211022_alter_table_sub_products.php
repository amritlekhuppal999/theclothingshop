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
            $table->decimal("price", 8, 2)->default(0.00)->change(); // 8 means upto 8 digits including decimal places, 2 means only upto 2 decimal places.
            $table->integer("stock_status")->after("stock")->default(1)->comment("0 => Out Of Stock, 1 => In Stock");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_products', function (Blueprint $table) {
            //
            $table->decimal("price", 8, 2)->default(0.00)->change(); // 8 means upto 8 digits including decimal places, 2 means only upto 2 decimal places.
            $table->dropColumn(['stock_status']);
        });
    }
};
