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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // values we get when a payment is successfully made in razorpay
            $table->string("razorpay_order_id")->comment("Unique id when a payment operation is requested. Can have multiple razorpay_payment_id.");
            $table->string("razorpay_payment_id")->comment("Unique id when new payment made.");
            $table->string("razorpay_signature")->comment("This is a HMAC signature sent by Razorpay.");
            
            // We might not need this but still saving it here
            $table->string("user_id")->default("");
            
            // values we get when order is created in STEP 1
            $table->decimal("amount", 10, 2);
            $table->string("currency")->default("");
            $table->bigInteger("payment_date")->nullable()->comment("unix timestamp");
            $table->string("receipt")->nullable();
            $table->integer("attempts");
            $table->string("payment_stage")->comment("Razorpay payment status.");
            
            // values needed for the pairing user order with the payment maed
            $table->string("payment_method")->default("")->comment("COD/POD, Credit Card, Debit Card, Netbanking, UPI");
            $table->string("payment_provider")->nullable()->comment("Razorpay, Paytm, Stripe, etc or leave it blank.");
            $table->string("transaction_id")->nullable()->comment("Payment Ids from bank. Optional");
            $table->string("ip_address")->nullable();
            $table->integer("status")->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
