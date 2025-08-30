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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            $table->uuid('order_id');
            $table->foreign('order_id')->references("order_id")->on("orders")->cascadeOnDelete();
            $table->foreignId('product_id')->constrained("products");
            $table->foreignId('variant_id')->constrained("sub_products");
            $table->integer('quantity')->default(1);
            $table->decimal('price', 12, 2)->default(0); // per item
            $table->decimal('total', 12, 2)->default(0); // quantity * price
            $table->enum('status', [
                'pending', 'confirmed', 'shipped', 'delivered', 'cancelled', 'returned'
            ])->default('pending');
            $table->string('tracking_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
