<?php

namespace App\Http\Controllers\FrontEnd\wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Wishlist;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WishlistController extends Controller
{
    //

    public function STORE(Request $request){

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

        $productId = $request->productId;
        $userId = session()->has('web.UUID') ? session('web.UUID') : null;

        try {
            Product::findOrFail($productId);
            $wishlistItem = Wishlist::where('product_id', $productId)->where('user_id', $userId);

            if($wishlistItem->get()->isEmpty()){

                $insertWishlist = Wishlist::create([
                    "product_id" => $productId,
                    "user_id" => $userId
                ]);
                
                return response()->json([
                    "type" => "Success",
                    "message" => "Product added to wishlist",
                    "errors" => "",
                    "code" => 200,
                    "requested_action_performed" => true,
                    "reload" => false
                ]);
            }
            else{
                return response()->json([
                    "type" => "Success",
                    "message" => "Product already in wishlist",
                    "errors" => "",
                    "code" => 204,
                    "requested_action_performed" => true,
                    "reload" => false
                ]);
            }
        } 
        
        catch (ModelNotFoundException $e) {

            return response()->json([
                "type" => "Failed",
                "message" => "Invalid product.",
                "errors" => $e->getMessage(),
                "code" => 404,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
        
        catch (\Throwable $th) {
            // \Log::info("\Error Data: ", ["error" => $th->getMessage()]);

            return response()->json([
                "type" => "Failed",
                "message" => "Something went wrong. Unable to add product to your wishlist.",
                "errors" => $th->getMessage(),
                "code" => 500,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
        
    }
}
