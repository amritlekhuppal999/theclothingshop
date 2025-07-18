<?php

namespace App\Http\Controllers\FrontEnd\cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\SubProduct;      
use App\Models\Cart;      
use App\Models\Wishlist;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  // Added
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    
    private $FRONT_END = 'front-end';
    private $VIEW_NOT_FOUND = '404';
    
    private $default_quantity_limit = 10;
    private $cooldown_period = '1 Day';


    // view cart page
    public function CREATE() {
        try {
            
            $userId = session()->has('web.UUID') ? session('web.UUID') : null;

            /**
             * NOTE !!!!!!!!
             * When dealing with RELATIONS and you intend to chain the relations like below.... 
             * MAKE SURE TO INCLUDE THE `foreign_key` column that makes that relation possible aswell as local_key column wherever necessary.
             * 
             * These dont throw conventional error like laravel does so be carefull and check for missing foreign keys religiously if you dont see 
             * your desigred result. It took me 3-4 days to understand and fix the Laravel Eloquent Relations.
             * 
             */

            // CART ITEM DETAILS
            $cartData = Cart::with([
                                'product' => fn($q) => $q->select('id', 'product_name', 'product_slug', 'discount_percentage'),
                                'product.primaryImage' => fn($q) => $q->select('product_id', 'image_location'),
                                'variants.productAttributes.attributeValues.attribute',
                                'product.PCM.subCategory' => fn($q) => $q->select('id', 'sub_category_name')
                            ])
                            ->select('id', 'product_id', 'variant_id', 'quantity')
                            ->where('user_id', $userId);
                            // ->get();

            
            // CART SUMMARY DETAILS
            $cartSummaryData = Cart::join('sub_products as SUB_PROD', function($query){
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
                                    ->where('cart.user_id', $userId);

            /**
             * What have we done here?
             * So we need sum total of our prices of items in the cart.
             * We ran a query to collect the values from cart, products and sub_products table.
             * We needed discount percentage from products, price from sub_products and quantity from carts.
             * When we have those, we need the sum total of : price_before_discount, price_after_discount and total discount amount which is how much a user saved.
             * So formula for that is simple:
             *      discountAmt = (discount_percentage/100) * price;
             * since we got quantity in our hands we do this:
             *      discountAmt *= qty;
             * 
             * and price after discount:
             *      priceAfterdiscount = (price * qty) - discountAmt;
             * 
             * Thats what the above SQL IS DOING.... 
             */

            // \Log::info("\nsummary Data: ", [
            //         // "sql" => $cartSummaryData->toSql(),
            //         // "binding" => $cartSummaryData->getBindings(),
            //         "summary" => $cartSummaryData->get()->toArray()
            //     ]
            // );
            
            $returnData = [
                "cartData" => $cartData->get(),
                "cartSummary" => $cartSummaryData->get()
            ];
        } 
        
        catch (\Throwable $th) {
             \Log::info("\Error Data: ", [$th->getMessage()]);
            $returnData = [
                "cartData" => [],
                "message" => "Unable to load cart data.",
                "error" => $th->getMessage()
            ];
        }
        
        return view($this->FRONT_END.'/cart', $returnData);
    }

    // saves in cart 
    public function STORE(Request $request){

        if (!Auth::guard('web')->check()) {
            return response()->json([
                "type" => "Failed",
                "message" => "Please login to continue",
                "errors" => "Session Expired",
                "requested_action_performed" => false,
                "reload" => false
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'variant_id' => 'required|integer',
            'price' => 'required|numeric|min:1|max:100000',
            'quantity' => 'required|integer|min:0|max:10'
        ]);

        if($validator->fails()){
            // This makes it more structured
            return response()->json([
                "type" => "Failed",
                "message" => "Product could not be added to cart.",
                "errors" => $validator->errors()->all(),
                "requested_action_performed" => false,
                "reload" => false
            ], 422);
        }

        try {
            
            $userId = session()->has('web.UUID') ? session('web.UUID') : null;
            
            $check_product = Cart::where('product_id', $request->product_id)
                                    ->where('variant_id', $request->variant_id)
                                    ->where('user_id', $userId);
                                    
            // update quantity if product is already present
            if($check_product->get()->isNotEmpty()){
                $check_product_arr = $check_product->get()->toArray();
                $new_quantity = $check_product_arr[0]["quantity"] + $request->quantity;

                if($new_quantity <= $this->default_quantity_limit){

                    $check_product->update([
                        'quantity' => $new_quantity,
                    ]);
                }

                // Cart limit exceeded
                else{
                    return response()->json([
                        "type" => "Failed",
                        "message" => "Cart Limit Exceeded!",
                        "errors" => "You cannot add more than 10 items a product.",
                        "requested_action_performed" => false,
                        "reload" => false
                    ], 400);
                }
                
            }

            // add new product to cart if no entry present
            else{

                $insertVariant = Cart::create([
                    "product_id" => $request->product_id,
                    "variant_id" => $request->variant_id,
                    "price" => $request->price,
                    "quantity" => $request->quantity,
                    "user_id" => session('web.UUID'),
                ]);
            }
                                    
            return response()->json([
                "type" => "Success",
                "message" => "Product added to cart successfully!",
                "requested_action_performed" => true,
                "reload" => false
            ], 200);

        } catch (\Throwable $th) {

            // $error_data = ["error" => $th->getMessage()];
            // \Log::info("\nError Data: ", $error_data);

            return response()->json([
                "type" => "Failed",
                "message" => "Not your fault, we messed up. Try again in sometime.",
                "errors" => $th->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ], 500);
        }

    }

    public function DELETE(Request $request){

        if (!Auth::guard('web')->check()) {
            return response()->json([
                "type" => "Failed",
                "message" => "Please login to continue",
                "errors" => "Session Expired",
                "code" => 401,
                "requested_action_performed" => false,
                "reload" => true
            ]);
        }

        $cartItemId = $request->cartItemId;
        $userId = session()->has('web.UUID') ? session('web.UUID') : null;

        try {
            //$cartRecord = Cart::findOrFail($cartItemId);
            $cartRecord = Cart::where('id', $cartItemId)->where('user_id', $userId)->firstOrFail();
            $cartRecord->delete();
            
            return response()->json([
                "type" => "Success",
                "message" => "Requested item removed from cart.",
                "errors" => "",
                "code" => 200,
                "requested_action_performed" => true,
                "reload" => false
            ]);

        } 
        
        catch (ModelNotFoundException $e) {

            return response()->json([
                "type" => "Failed",
                "message" => "Invalid cart item.",
                "errors" => $e->getMessage(),
                "code" => 404,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
        
        catch (\Throwable $th) {
            
            return response()->json([
                "type" => "Failed",
                "message" => "Something went wrong. Unable to delete cart item.",
                "errors" => $th->getMessage(),
                "code" => 500,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
        
    }

    // update cart item (qty)
    public function UPDATE(Request $request){

        if (!Auth::guard('web')->check()) {
            return response()->json([
                "type" => "Failed",
                "message" => "Please login to continue",
                "errors" => "Session Expired",
                "requested_action_performed" => false,
                "reload" => false
            ], 401);
        }

        try {
            $cartItemId = $request->cartItemId;
            $newQuantity = $request->newQuantity;
            $userId = session()->has('web.UUID') ? session('web.UUID') : null;
            
            $cartRecord = Cart::findOrFail($cartItemId);
            $cartRecord->update([
                'quantity' => $newQuantity,
            ]);
                                    
            return response()->json([
                "type" => "Success",
                "message" => "Product quantity updated!",
                "errors" => "",
                "code" => 200,
                "requested_action_performed" => true,
                "reload" => false
            ]);

        } 
        catch (ModelNotFoundException $e) {

            return response()->json([
                "type" => "Failed",
                "message" => "Invalid cart item.",
                "errors" => $e->getMessage(),
                "code" => 404,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }

        catch (\Throwable $th) {

            //\Log::info("\nError Data: ", ["error" => $th->getMessage()]);

            return response()->json([
                "type" => "Failed",
                "message" => "Not your fault, we messed up. Try again in sometime.",
                "errors" => $th->getMessage(),
                "code" => 500,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }

    }
    
}






// $log_data = [
//     "product_id" => $variant_data->toSql(),
//     "variant_id" => $variant_data->getBindings(),
//     "price" => $product_id,
//     "quantity" => $product_id,
//     "request_data" => 'product: '.$request->product_id.', variant:'.$request->variant_id,
// ];
// \Log::info("\Request Data: ", $log_data);