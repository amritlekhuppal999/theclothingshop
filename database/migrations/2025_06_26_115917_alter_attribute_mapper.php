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
            $table->integer('primary_pair')->default(0)->after("variant_id")
                    ->comment("1 => is a primary pair, 0 => Not a primary pair. meaning The ones set 0 will decide the variant type.");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attribute_mappers', function (Blueprint $table) {
            //
            $table->dropColumn(['primary_pair']);
        });
    }
};
