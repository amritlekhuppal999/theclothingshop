<?php

namespace App\Http\Controllers\Admin\Products;

//use App\Services\CategoryService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;

use App\Models\SubProduct;      //ProductVariant
use App\Models\AttributeMapper;

use Illuminate\Support\Facades\DB;      // to use transactions
use Illuminate\Support\Facades\Validator;

class SubProductsController extends Controller
{

    private $products_route = 'admin-panel/products/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    
    // PRODUCT VARIANT
        // view to see added products table
        public function VARIANT_INDEX(Request $request, $productSlug=null){

            // TEMP, REMOVE THIS WHEN VIEW IS READY
            // return view($this->VIEW_NOT_FOUND);

            $limit = ($request->has("limit")) ? $request->query("limit") : 10 ;
            $search_keyword = ($request->has("search_keyword")) ? $request->query("search_keyword") : "" ;

            $sub_product_list = SubProduct::join('products', 'sub_products.product_id', '=', 'products.id')
                                ->select('sub_products.*', 'products.product_name')
                                ->orderBy('sub_products.id', 'desc')
                                ->when(isset($productSlug), function($query) use($productSlug){
                                    return $query->where('products.product_slug', $productSlug);
                                })
                                ->when($request->has("search_keyword"), function($query) use($request){
                                    $search_keyword = $request->query("search_keyword");
                                    return $query->where('variant_name', 'like', '%'.$search_keyword.'%')
                                            ->orWhere('variant_slug', 'like', '%'.$search_keyword.'%')
                                            ->orWhere('sku', 'like', '%'.$search_keyword.'%')
                                            ->orWhere('price', 'like', '%'.$search_keyword.'%');
                                })
                                ->paginate($limit)->withQueryString();

            $return_data = array(
                "sub_product_list" => $sub_product_list,
                "productSlug" => $productSlug,
                "search_keyword" => $search_keyword
            );

            return view($this->products_route.'variants', $return_data);
        }
        
        public function CREATE_VARIANT($productSlug=null){   
            $return_data['productSlug'] = $productSlug;
            return view($this->products_route.'add-product-variant', $return_data);

        }


        // function to add Variants 
        public function STORE_VARIANT(Request $request){

            // validate input
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|integer',
                'variant_name' => 'required|string|max:255',
                'variant_slug' => 'required|string|max:255|unique:sub_products,variant_slug',
                'sku' => 'required|string|max:255|unique:sub_products,sku',
                'price' => 'required|numeric|min:1|max:100000',
                'quantity' => 'required|integer|min:0'
            ]);

            if($validator->fails()){
                // This makes it more structured
                return response()->json([
                    "type" => "Failed",
                    "message" => "Unable to add this variant",
                    "errors" => $validator->errors()->all(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 422);
            }

            // check for attribute values
            if(count($request->attribute_pair) === 0 || !isset($request->attribute_pair)){
                return response()->json([
                    "type" => "Failed",
                    "message" => "Attributes field must not be empty!!",
                    "errors" => null,
                    "requested_action_performed" => false,
                    "reload" => false
                ], 400);
            }

            DB::beginTransaction();

            // DB operation to add the image file locations to the database
            try{
                $attr_mapper_arr = [];

                $insertVariant = SubProduct::create([
                    "product_id" => $request->product_id,
                    "variant_name" => $request->variant_name,
                    "variant_slug" => $request->variant_slug,
                    "sku" => $request->sku,
                    "price" => $request->price,
                    "stock" => $request->quantity,
                    "status" => 1
                ]);

                $last_inserted_variant_id = $insertVariant->id;
                
                foreach ($request->attribute_pair as $att_obj) {
                    $att_data_arr = array(
                        "attribute_value_id" => $att_obj["attribute_value_id"],
                        "variant_id" => $last_inserted_variant_id
                    );
                    
                    array_push($attr_mapper_arr, $att_data_arr);
                }
                
                $insertAttrMapper = AttributeMapper::insert($attr_mapper_arr);

                // Commit the transaction if everything is successful
                DB::commit();
                
                // This makes it more structured
                return response()->json([
                    "type" => "Success",
                    "message" => "Variant added successfully!",
                    "requested_action_performed" => true,
                    "reload" => false
                ], 200);

                // Laravel automatically converts arrays to JSON, but it does not allow setting custom HTTP status codes.
            }
            catch(\Exception $e){   // General Error
                // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
                DB::rollBack(); 

                // This makes it more structured
                return response()->json([
                    "type" => "Failed",
                    //"message" => "An unexpected error occurred. Try again in sometime.",
                    "message" => "Not your fault, we messed up. Try again in sometime.",
                    "errors" => $e->getMessage(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 500);
            }
            catch(\Error $e){

                DB::rollBack(); 
                return response()->json([
                    "type" => "Failed",
                    "message" => "Unable to add Variant!",
                    "errors" => $e->getMessage(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 500);
            }

        }
        // TAGS: xhrRequest, ASYNC, Handling validation, USE THIS


        public function UPDATE_VARIANT($subProductSlug){
            
            // return view($this->products_route.'udpate-products', ["productSlug" => $productSlug]);
            return view($this->VIEW_NOT_FOUND);
        }


        // DELETE or RESTORE variants
        public function VARIANT_ACTIONS(Request $request){
            
            // validate input
            $validator = Validator::make($request->all(), [
                'sub_product_id' => 'required|integer',
                'requested_action' => 'required|string|max:255'
            ]);

            if($validator->fails()){
                // This makes it more structured
                return response()->json([
                    "type" => "Failed",
                    "message" => "Invalid request type.",
                    "errors" => $validator->errors()->all(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 422);
            }

            try {
                
                $sub_product = SubProduct::findOrFail($request->sub_product_id);

                $status_value = ($request->requested_action == "delete-sub_product") ? 0 : 1;
                $requested_action = ($request->requested_action == "delete-sub_product") ? "deleted" : "restored";

                $sub_product->update([
                    'status' => $status_value
                ]);

                // This makes it more structured
                return response()->json([
                    "type" => "Success",
                    "message" => "Variant ".$requested_action." successfully!",
                    "requested_action_performed" => true,
                    "reload" => false
                ], 200);

            }
            catch (ModelNotFoundException $e) {
                // Handle the case where the attribute doesn't exist
                // return redirect()->back()->withErrors(['error' => 'Attribute not found.']);
                return response()->json([
                    "type" => "Failed",
                    "message" => "Variant Not Found",
                    "errors" => $validator->errors()->all(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 404);
            }
            catch(\Exception $e){   // General Error
                // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
                
                // This makes it more structured
                return response()->json([
                    "type" => "Failed",
                    "message" => "Not your fault, we messed up. Try again in sometime.",
                    "errors" => $e->getMessage(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 500);
            }
        }


        // add image product form
        public function CREATE_VARIANT_IMAGE($subProductSlug=null){   

            return view($this->VIEW_NOT_FOUND);
            
            $return_data['subProductSlug'] = $subProductSlug;
            return view($this->products_route.'add-product-image', $return_data);

        }

    // PRODUCT VARIANT END


    
    // GENRAL PURPOSE FUNCTIONS
                
        // function to get product list 
        public function GET_PRODUCT_LIST($options=null){
            /* // Allowed options for query products
            $options = array(
                "product_id" => '',
                "product_slug" => '',
                "category_id" => '',
                "sub_category_id" => '',
                "status" => "",
                "fields" => ["all"]
            );
            */

            $product_list = Product::select('id', 'product_name', 'product_slug')->where('status', 1)->get();
            return ["product_list" => $product_list];
        }
    // GENRAL PURPOSE FUNCTIONS END


}
