<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;  // Added


class BillingService{

    public function getCheckoutBill(){

        $userId = session()->has('web.UUID') ? session('web.UUID') : null;
        
        $orderSummaryData = Cart::join('sub_products as SUB_PROD', function($query){
            $query->on('cart.variant_id', '=', 'SUB_PROD.id');
        })
        ->join('products as PRO', function($query){
            $query->on('SUB_PROD.product_id', '=', 'PRO.id')
            ->whereColumn('cart.product_id', 'PRO.id');
        })
        ->select(
                DB::raw('SUM(SUB_PROD.price * cart.quantity ) AS total_price_before_discount'),
                
                DB::raw('SUM(
                                ((PRO.discount_percentage/100) * SUB_PROD.price) * cart.quantity
                            ) AS total_discount_amount'
                        ),

                DB::raw('SUM(
                                (SUB_PROD.price * cart.quantity) -
                                (
                                    ((PRO.discount_percentage/100) * SUB_PROD.price ) * cart.quantity
                                )
                            ) AS total_price_after_discount'
                        )
            )
        ->where('cart.user_id', $userId)->get();

        $orderSummaryData = $orderSummaryData->toArray();
        $orderSummaryData = $orderSummaryData[0];
        // \Log::info("summary data", [$cartSummaryData->toArray()]);

        return $orderSummaryData;
    }
}