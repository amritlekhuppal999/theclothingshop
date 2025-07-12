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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->default(0);
            $table->integer('variant_id')->default(0);
            $table->decimal("price", 8, 2);    // 8 means upto 8 digits including decimal places, 2 means only upto 2 decimal places
            $table->integer('quantity')->default(1);
            $table->string('user_id')->default("");
            // $table->integer('sub_category_id')->default(0)->comment("");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
