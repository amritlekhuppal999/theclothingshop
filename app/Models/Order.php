<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        'order_id',
        'user_id',
        'guest_email',
    
        'total_items',
        'subtotal_amount',
        'discount_amount',
        'tax_amount',
        'shipping_amount',
        'grand_total',
        'currency',
    
        'payment_id',
        'payment_method',
    
        'billing_address_id',
        'shipping_address_id',
        'shipping_method',
        'tracking_number',
    
        'order_status',
        'notes',
        'coupon_code',
        'ip_address',
        'placed_at',
        'cancelled_at',
        'delivered_at'
    ];

}
