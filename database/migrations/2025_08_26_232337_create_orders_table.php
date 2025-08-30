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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id')->unique();

            // Customer
            // $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('user_id')->nullable();
            $table->string('guest_email')->nullable();

            // product details -> in order_items table            

            // Order details
            $table->integer('total_items')->default(0);
            $table->decimal('subtotal_amount', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('shipping_amount', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->string('currency', 10)->default('INR');

            // Payment
            $table->integer('payment_id')->nullable();
            $table->string('payment_method')->nullable();
            // $table->enum('payment_status', [
            //     'pending', 'paid', 'failed', 'refunded', 'partially_refunded'
            // ])->default('pending');
            // $table->string('transaction_id')->nullable();
            // $table->timestamp('payment_date')->nullable();

            // Shipping & Billing
            $table->foreignId('billing_address_id')->nullable();
            $table->foreignId('shipping_address_id')->nullable();
            $table->string('shipping_method')->nullable();
            $table->string('tracking_number')->nullable();

            // Order workflow
            $table->enum('order_status', [
                'pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'
            ])->default('pending');
            $table->text('notes')->nullable();

            // Extra (optional for analytics / fraud detection)
            $table->string('coupon_code')->nullable();
            $table->string('ip_address', 45)->nullable(); // IPv4 or IPv6
            // $table->text('user_agent')->nullable();
            // $table->string('source')->nullable(); // e.g. web, mobile

            // Timestamps
            $table->timestamp('placed_at')->useCurrent();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('delivered_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
