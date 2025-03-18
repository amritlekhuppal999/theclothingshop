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
        Schema::create('sub_category_images', function (Blueprint $table) {
            $table->id();
            $table->integer('sub_category_id'); 
            $table->string('image_location');
            $table->integer('prime_image');
            $table->integer('status')->comment("1 => active, 0 => deleted");
            $table->integer('deleted')->default(0)->comment("0 => FILE NOT DELETED, 1 => FILE DELETED");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_category_images');
    }
};
