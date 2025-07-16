<?php

namespace App\Http\Controllers\FrontEnd\cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\SubProduct;      
use App\Models\Cart;      

use Illuminate\Support\Facades\Auth;

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
            
            $cartData = Cart::with([
                                'product' => fn($q) => $q->select('id', 'product_name', 'product_slug'),
                                'product.primaryImage' => fn($q) => $q->select('product_id', 'image_location'),
                                'variants.productAttributes.attributeValues.attribute',
                                'product.PCM.subCategory' => fn($q) => $q->select('id', 'sub_category_name')
                            ])
                            ->select('id', 'product_id', 'variant_id', 'quantity')
                            ->get();

            $log_data = [
                // "cartSql" => $cartData->toSql(),
                // "variant_id" => $variant_data->getBindings(),
                // "category_data" => $cart_data[0]["sub_product"]["product_attributes"],
                "cartData" => $cartData->toArray(),
            ];
            //\Log::info("\nCart Data: ", $log_data);
            
            $returnData = [
                // "cartData" => $cartData->get()->toArray()
                "cartData" => $cartData->toArray()
            ];
        } 
        catch (\Throwable $th) {
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
            
            $check_product = Cart::where('product_id', $request->product_id)
                                    ->where('variant_id', $request->variant_id);
                                    
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
}






// $log_data = [
//     "product_id" => $variant_data->toSql(),
//     "variant_id" => $variant_data->getBindings(),
//     "price" => $product_id,
//     "quantity" => $product_id,
//     "request_data" => 'product: '.$request->product_id.', variant:'.$request->variant_id,
// ];
// \Log::info("\Request Data: ", $log_data);