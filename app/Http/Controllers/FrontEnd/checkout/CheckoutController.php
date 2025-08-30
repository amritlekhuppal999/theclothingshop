<?php

namespace App\Http\Controllers\FrontEnd\checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;   // to use intended route, else normal function call works aswell
use Illuminate\Support\Str;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderItems;


use Razorpay\Api\Api;   // Razorpay API

use Illuminate\Support\Facades\DB;  // Added
use Illuminate\Database\QueryException; // Added


class CheckoutController extends Controller
{
    // private $checkout_route = 'front-end/checkout/;'
    private $checkout_route = 'front-end/';

    private $key;
    private $secret;

    public function __construct(){
        $this->key = config('services.razorpay.key');
        $this->secret = config('services.razorpay.secret');
    }

    public function INDEX(Request $request){

        // if (!Auth::guard('web')->check()) {
            
        //     // Not working as intended
        //     return redirect()
        //             ->intended('/checkout') // specify the route here
        //             ->withErrors([
        //                 'error'=> 'Session expired. Login to continue.'
        //             ]);
        // }

        $userId = session()->has('web.UUID') ? session('web.UUID') : null;

        $cartData = Cart::where('user_id', $userId)->get();
        if($cartData->isEmpty()){
            return redirect('cart');
        }

        $orderSummaryData = getCheckoutBill();

        return view($this->checkout_route.'checkout', ["orderSummaryData" => $orderSummaryData]);
    }


    public function STORE_ADDRESS(Request $request){

        return view($this->checkout_route.'checkout-add-address');
    }


    
    public function PLACE_ORDER(Request $request){  // the post data is sent from the RAZORPAY server

        // \Log::info('payment info:', [$request->toArray()]);
        
        // Store payment data to session and then to DB
        // session(
        //     [
        //         'payment_data.payment' => [
        //             "razorpay_payment_id" => $payment_data["razorpay_payment_id"],
        //             "razorpay_order_id" => $payment_data["razorpay_order_id"],
        //             "razorpay_signature" => $payment_data["razorpay_signature"]
        //         ]
        //     ]
        // );

        // $payment_order = session()->get('payment_data.order');

        $userId = session()->has('web.UUID') ? session('web.UUID') : null;
        $payment_data = $request->toArray();
        $billing_address_id = session()->get('payment_data.billing_address_id');
        $shipping_address_id = session()->get('payment_data.shipping_address_id');

        DB::beginTransaction();

        try {
            
            $api = new Api($this->key, $this->secret);
            $payment_order = $api->order->fetch($payment_data["razorpay_order_id"]);
            $payment_order = $payment_order->toArray();

            $payment_method = "ONLINE";
            $payment_provider = "RAZORPAY";


            $storePayment = Payment::create(
                [
                    "razorpay_order_id" => $payment_data["razorpay_order_id"],
                    "razorpay_payment_id" => $payment_data["razorpay_payment_id"],
                    "razorpay_signature" => $payment_data["razorpay_signature"],
                    "user_id" => $userId,

                    "amount" => $payment_order["amount"],
                    "currency" => $payment_order["currency"],
                    "payment_date" => $payment_order["created_at"],   // unix timestamp
                    "receipt" => $payment_order["receipt"],
                    "attempts" => $payment_order["attempts"],
                    "payment_stage" => $payment_order["status"],
                    "payment_method" => $payment_method,
                    "payment_provider" => $payment_provider,
                    // "transaction_id" => "",
                    "ip_address" => $request->ip(),
                    // "status" => "",
                ]
            );

            

            // CREATE USER ORDER 
            $checkoutBillingSummary = getCheckoutBill();
            $totalItems = Cart::where('user_id', $userId)->sum('quantity');

            $createUserOrder = Order::create([
                'order_id' => (string) Str::uuid(),
                'user_id' => $userId,
                // 'guest_email' => '',
            
                'total_items' => $totalItems,
                'subtotal_amount' => $checkoutBillingSummary["total_price_before_discount"],
                'discount_amount' => $checkoutBillingSummary["total_discount_amount"],
                'tax_amount' => 0.0,
                'shipping_amount' => 0.0,
                'grand_total' => $checkoutBillingSummary["total_price_after_discount"],
                // 'currency' => '',
            
                'payment_id' => $storePayment->id,
                // 'payment_method' => '',
            
                'billing_address_id' => $billing_address_id,
                'shipping_address_id' => $shipping_address_id,
                'shipping_method' => '',
                'tracking_number' => '',
            
                'order_status' => 'confirmed',
                'notes' => 'We are currently in dev mode',
                // 'coupon_code' => '',
                'ip_address' => $request->ip(),
                // 'placed_at' => '',
                // 'cancelled_at' => '',
                // 'delivered_at' => ''
            ]);

            $cartItems = Cart::where('user_id', $userId)->get();
            $orderItemArr = [];
            
            foreach ($cartItems as $cart => $item) {
                
                array_push($orderItemArr, array(
                    "order_id" => $createUserOrder->order_id,
                    "product_id" => $item->product_id,
                    "variant_id" => $item->variant_id,
                    "quantity" => $item->quantity,
                    "price" => $item->price,
                    "total" => $item->quantity * $item->price,
                    "status" => 'confirmed',
                    "created_at" => now(),  // insert method does not fill this
                    "updated_at" => now(),  // insert method does not fill this
                ));
            }

            
            $insertOrderItem = OrderItems::insert($orderItemArr);   // insert method returns boolean
            
            // \Log::info('cart items', [$cartItems]);
            // \Log::info('order_items before insert', [$orderItemArr]);
            // \Log::info('inserted order items', [$insertOrderItem]);

            // Remove Cart Items ones the order is placed 
            $this->clearCartItem();

            // upon successful order creation, clear sessions
            session()->forget('payment_data');

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect('payment-successful');
        }
        
        catch (QueryException $e) {
            
            \Log::error("DB Error: ", [$e->getMessage()]);

            DB::rollBack();

            return redirect('payment-unsuccessful');
        }
        
        catch (\Throwable $th) {
            
            \Log::error("Something Went Wrong: ", [$th->getMessage()]);

            DB::rollBack();

            return redirect('payment-unsuccessful');
        }        
    }

    // function to clear cart items for given user
    private function clearCartItem(){
        $userId = session()->has('web.UUID') ? session('web.UUID') : null;

        Cart::where('user_id', $userId)->delete();
    }


    // load a thankyou page 
    public function PAYMENT_SUCCESSFUL(Request $request){

        // \Log::info('payment info:', [$request]);

        return view('front-end.payment-successful');
    }

    // load a sorry page 
    public function PAYMENT_UNSUCCESSFUL(Request $request){

        // \Log::info('payment info:', [$request]);

        return view('front-end.payment-unsuccessful');
    }
}
