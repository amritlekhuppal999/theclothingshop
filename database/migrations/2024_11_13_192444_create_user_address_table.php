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
        Schema::create('user_address', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('house_no');
            $table->string('house_name');
            $table->string('city');
            $table->string('state');
            $table->integer('pincode');
            $table->string('street_name');
            $table->string('full_address'); 
            $table->integer('primary');     // 1 or 0 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_address');
    }
};
