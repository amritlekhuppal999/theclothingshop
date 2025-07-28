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
            $table->string('name');
            $table->string('apartment_no')->nullable();
            $table->string('building_no')->nullable();
            $table->string('building_name')->nullable();
            $table->string('city');
            $table->string('state');
            $table->integer('pincode');
            $table->string('street_name')->nullable();
            $table->string('full_address');
            $table->string('phone');
            $table->integer('address_type')->default("0")->comment("0->unset, 1->home, 2->office, 3->other");    // home, office, others
            $table->integer('address_category')->default("0")->comment("0->unset, 1->shipping, 2->billing");     // shipping, billing
            $table->integer('primary')->default("0");     // 1 or 0 
            $table->integer('status')->default("1");     // 1 or 0 
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
