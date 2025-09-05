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

    
    public function orderItems() {
        return $this->hasMany(OrderItems::class, 'order_id', 'order_id')
                // ->from('order_items as OI')
                ->leftjoin('products as PROD', function($join){
                    $join->on('PROD.id', '=', 'order_items.product_id');
                })
                ->leftjoin('product_images as PI', function($join){
                    $join->on('PROD.id', '=', 'PI.product_id')->where('PI.prime_image', 1);
                })
                ->leftjoin('category as CAT', function($join){
                    $join->on('CAT.id', '=', 'PROD.category_id');
                })
                ->select('order_items.order_id', 'order_items.product_id',
                        'PROD.product_name', 'PROD.product_slug', 
                        'PI.image_location',
                        'CAT.category_name', 'CAT.category_slug'
                    );
    }


    // public function orderItems() {
    //     return $this->hasMany(OrderItems::class, 'order_id', 'order_id')
    //             ->select('order_items.*');
    // }

}
