<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $table = 'payments';

    protected $fillable = [
        "razorpay_order_id",
        "razorpay_payment_id",
        "razorpay_signature",
        "user_id",
        "amount",
        "currency",
        "payment_date",
        "receipt",
        "attempts",
        "payment_stage",
        "payment_method",
        "payment_provider",
        "transaction_id",
        "ip_address",
        "status",
    ];
}
