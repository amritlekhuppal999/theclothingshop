<?php

namespace App\Http\Controllers\FrontEnd\checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;   // to use intended route, else normal function call works aswell
use App\Models\Cart;
use Illuminate\Support\Facades\DB;  // Added
use App\Models\Payment;
use Illuminate\Database\QueryException; // Added

class CheckoutController extends Controller
{
    // private $checkout_route = 'front-end/checkout/;'
    private $checkout_route = 'front-end/';

    public function INDEX(Request $request){

        // if (!Auth::guard('web')->check()) {
            
        //     // Not working as intended
        //     return redirect()
        //             ->intended('/checkout') // specify the route here
        //             ->withErrors([
        //                 'error'=> 'Session expired. Login to continue.'
        //             ]);
        // }

        
        $orderSummaryData = getCheckoutBill();

        return view($this->checkout_route.'checkout', ["orderSummaryData" => $orderSummaryData]);
    }


    public function STORE_ADDRESS(Request $request){

        return view($this->checkout_route.'checkout-add-address');
    }


    
    public function PLACE_ORDER(Request $request){  // the post data is sent from the RAZORPAY server

        // \Log::info('payment info:', [$request->toArray()]);
        $userId = session()->has('web.UUID') ? session('web.UUID') : null;

        $payment_data = $request->toArray();

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

        $payment_order = session()->get('payment_data.order');


        try {
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
                    "payment_method" => "ONLINE",
                    "payment_provider" => "Razorpay",
                    // "transaction_id" => "",
                    "ip_address" => $request->ip(),
                    // "status" => "",
                ]
            );

            session()->forget('payment_data');

            return redirect('payment-successful');
        }
        catch (QueryException $e) {
            // \Log::error("DB Error: ", [$e->getMessage()]);

            return redirect('payment-unsuccessful');
        }
        catch (\Throwable $th) {
            // \Log::error("Something Went Wrong: ", [$th->getMessage()]);

            return redirect('payment-unsuccessful');
        }        
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
