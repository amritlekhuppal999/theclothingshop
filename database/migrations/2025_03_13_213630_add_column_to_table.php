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
        Schema::table('category_images', function (Blueprint $table) {
            // $table->integer('deleted')->after('status')->nullable();
            $table->integer('deleted')->after('status')->default(0)->comment("0 => Not Deleted, 1 => Deleted");
            // change comment to comment("0 => FILE NOT DELETED, 1 => FILE DELETED")
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_images', function (Blueprint $table) {
            //
        });
    }
};
