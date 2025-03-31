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
        Schema::table('attribute_mappers', function (Blueprint $table) {
            //
            $table->integer('attribute_value_id')->default(0)->change();
            $table->integer('variant_id')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attribute_mappers', function (Blueprint $table) {
            //
            $table->integer('attribute_value_id')->default(null)->change();
            $table->integer('variant_id')->default(null)->change();
        });
    }
};
