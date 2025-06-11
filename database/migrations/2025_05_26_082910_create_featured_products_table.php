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
        Schema::create('featured_collection', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->default(0);
            $table->integer('collection_id')->default(0)->comment("This holds the sub category ids of collection category");
            $table->string('display_page')->default("");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_products');
    }
};

/*
Purpose of this table:
    I want to feature products on homepage.
    To do that i will then have to add more category to my products which breaks my current table structure.
    Also I just need Collection Catgegory, The sub categories in it are the named groups for featuring products.
    So to achieve that, i have created this mapper table between product and collection.
*/