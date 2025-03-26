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
        Schema::table('products', function (Blueprint $table) {
            $table->integer("target_group")
                    ->after("product_slug")
                    ->comment("gender/sex | 0 => unset, 1 => M, 2 => F, 3 => Unisex");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            
            $table->dropColumn(['target_group']);
        });
    }
};
