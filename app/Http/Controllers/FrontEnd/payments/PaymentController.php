<?php

namespace App\Http\Controllers\FrontEnd\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;   // Razorpay API
use Illuminate\Support\Facades\Auth;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;  // Added

class PaymentController extends Controller
{
    private $key;
    private $secret;
    private $currency;

    public function __construct(){
        $this->key = config('services.razorpay.key');
        $this->secret = config('services.razorpay.secret');
        $this->currency = 'INR';

        // \Log::info('razorpay', ['key' => $this->key, 'secret' => $this->secret]);
    }

    // RAZORPAY STEP 1, Create a payment order
    public function CREATE_ORDER(Request $request){

        if (!Auth::guard('web')->check()) {
            
            return response()->json([
                "type" => "Failed",
                "message" => "Session expired",
                "errors" => "Authentication Error!",
                "code" => 401,  
                "requested_action_performed" => false,
                "reload" => true
            ]);
        }

        $amount = (int)$request->amount;

        try {
            $api = new Api($this->key, $this->secret);
            $order = $api->order->create(
                            array(
                                //'receipt' => '123', 
                                'amount' => $amount, 
                                'currency' => $this->currency, 
                                'notes'=> array('order_type'=> 'test')
                            )
                        );
                        
            /*
                Razorpay’s SDK (razorpay/razorpay package) doesn’t return a plain array 
                — it returns a Razorpay\Api\Order object.
            */
            $order = $order->toArray();
            // \Log::info('razorpay ORDER', [$order["id"]]);

            if(isset($order["id"])){

                // storing new payment data in sessions
                session(['payment_data.order' => $order]);
                
                return response()->json([
                    "type" => "Success",
                    "order" => $order,
                    "message" => "",
                    "errors" => "",
                    "code" => 200,
                    "requested_action_performed" => true,
                    "reload" => true
                ]);
            }
            

            return response()->json([
                "type" => "Failed",
                "order" => $order,
                "message" => "Failed to create razorpay order.",
                "errors" => $order["error"]["description"],
                // "errors" => "",
                "code" => 400,  
                "requested_action_performed" => false,
                "reload" => false
            ]);
    
            
        } 
        catch (\Throwable $th) {
            \Log::error('razorpay ERROR:', [$th->getMessage()]);
            return response()->json([
                "type" => "Failed",
                "message" => "An unexpected error occurred. Try again in sometime.",
                "errors" => $th->getMessage(),
                "code" => 500,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
    }
}
