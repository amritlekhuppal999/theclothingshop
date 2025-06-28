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

use Illuminate\Database\Eloquent\ModelNotFoundException;

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
                'quantity' => 'required|integer|min:0',
                'size' => 'required|integer',
                'color' => 'required|integer'
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
            // if(count($request->attribute_pair) === 0 || !isset($request->attribute_pair)){
            //     return response()->json([
            //         "type" => "Failed",
            //         "message" => "Attributes field must not be empty!!",
            //         "errors" => null,
            //         "requested_action_performed" => false,
            //         "reload" => false
            //     ], 400);
            // }

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
                        "variant_id" => $last_inserted_variant_id,
                        "primary_pair" => 0
                    );
                    
                    array_push($attr_mapper_arr, $att_data_arr);
                }

                /*The size and color values we get from form is ultimately passed into the attribute mapper 
                with additional attributes.*/
                $sizeAttVals = array(
                    "attribute_value_id" => $request->size,
                    "variant_id" => $last_inserted_variant_id,
                    "primary_pair" => 1
                );
                $colorAttVals = array(
                    "attribute_value_id" => $request->color,
                    "variant_id" => $last_inserted_variant_id,
                    "primary_pair" => 1
                );
                array_push($attr_mapper_arr, $sizeAttVals, $colorAttVals);
                
                $insertAttrMapper = AttributeMapper::insert($attr_mapper_arr);

                // Commit the transaction if everything is successful
                DB::commit();

                // $log_data = [
                //     "attr_mapper_arr" => $attr_mapper_arr,
                //     "variant_data" => $var_arr,
                //     //"sql_query" => $sql_query,
                //     //"sql_str_binding" => $sql_str_binding,
                // ];

                // \Log::info("Variant Data:", $log_data);
                
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


        // Update variant view
        public function CREATE_VARIANT_UPDATE($subProductSlug){
            
            try {
                
                // to check if the variant of given slug is present or not. Throws model not found exception.
                $variant = SubProduct::where('variant_slug', $subProductSlug)->firstOrFail();

                $variant = SubProduct::from('sub_products as SP')
                        ->join('products as PRO', function($join){
                            $join->on('SP.product_id', '=', 'PRO.id');
                        })
                        ->select('SP.*', 'PRO.product_name')
                        ->where('variant_slug', $subProductSlug)->get();

                //$variant_arr = $variant->toArray();
                $variant_id = $variant[0]["id"];
                

                $size_data = $this->get_primary_attribute($variant_id, "size");
                $color_data = $this->get_primary_attribute($variant_id, "color");

                // Log data
                    $log_data = [
                        "size_data" => $size_data->toArray(),
                        "color_data" => $color_data->toArray(),
                        // "sql_query" => $sql_query,
                        // "sql_str_binding" => $sql_str_binding,
                    ];

                    // \Log::info("\n\nVariant Data:\n", $log_data);
                // Log data END

                // USING MULTI JOIN 
                $variant_attr = AttributeMapper::join("attribute_values as ATV", "attribute_value_id", "=", "ATV.id")
                                                ->join("attributes as ATR", "ATV.attribute_id", "=", "ATR.id")
                                                ->where('variant_id', $variant_id)
                                                ->select("ATR.id as AID", 
                                                    "ATV.id as AVID", 
                                                    "ATR.name as ATTRIBUTE_NAME", 
                                                    "ATV.value as ATTRIBUTE_VALUE", 
                                                    "ATV.label as ATTRIBUTE_LABEL"
                                                )->get();
                
                $return_data = array(
                    "variant_selected" => true,
                    "variant" => $variant[0],
                    "variant_attr" => $variant_attr,
                    "primary_size" => $size_data[0]["attribute_value_id"],
                    "primary_color" => $color_data[0]["attribute_value_id"]
                );
                
            } 
            catch (ModelNotFoundException $e) {
                $return_data = [
                    "variant_selected" => false,
                    "variant" => [],
                    "message" => "No variant present for the given variant slug: " . $e->getMessage(),
                ];

                return view($this->VIEW_NOT_FOUND, $return_data);
            }
            catch (\Throwable $th) {
                $return_data = [
                    "variant_selected" => false,
                    "variant" => [],
                    "message" => "Something went wrong " . $th->getMessage(),
                ];
            }

            return view($this->products_route.'update-variants', $return_data);
        }

        public function get_primary_attribute($variant_id, $attribute_name){
            return AttributeMapper::from('attribute_mappers as ATM')
                                    ->join("attribute_values as ATV", function($join){
                                        $join->on("ATM.attribute_value_id", "=", "ATV.id");
                                    })
                                    ->join("attributes as ATR", function($join) use($attribute_name){
                                        $join->on("ATV.attribute_id", "=", "ATR.id")
                                            ->where(function($query)use($attribute_name){
                                                $query->where("ATR.name", $attribute_name)
                                                ->orWhere("ATR.name", ucfirst($attribute_name));
                                            });
                                    })
                                    ->where('ATM.variant_id', $variant_id)
                                    ->where('ATM.primary_pair', 1)
                                    ->select(
                                        // "ATR.name as attribute",
                                        // "ATV.value",
                                        "ATV.id as attribute_value_id"
                                    )->get();
        }

        // store the updated details of variant
        public function STORE_VARIANT_UPDATE(Request $request){

            $validation_arr = [
                'variant_name' => 'required|string|max:255',
                // 'variant_slug' => 'required|string|max:255|unique:sub_products,variant_slug',
                // 'sku' => 'required|string|max:255|unique:sub_products,sku',
                'price' => 'required|numeric|min:1|max:100000',
                'quantity' => 'required|integer|min:0',
                'size' => 'required|integer',
                'color' => 'required|integer'
            ];

            if($request->variant_slug !== $request->variant_slug_backup){
                $validation_arr['variant_slug'] = 'required|string|max:255|unique:sub_products,variant_slug';
            }
            if($request->sku !== $request->sku_backup){
                $validation_arr['sku'] = 'required|string|max:255|unique:sub_products,sku';
            }

            // validate input
            $validator = Validator::make($request->all(), $validation_arr);

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
            // if(count($request->attribute_pair) === 0 || !isset($request->attribute_pair)){
            //     return response()->json([
            //         "type" => "Failed",
            //         "message" => "Attributes field must not be empty!!",
            //         "errors" => null,
            //         "requested_action_performed" => false,
            //         "reload" => false
            //     ], 400);
            // }

            DB::beginTransaction();

            // DB operation to add the image file locations to the database
            try{
                $attr_mapper_arr = [];

                $variant_id = $request->variant_id;

                $variant = SubProduct::findOrFail($variant_id);

                $var_arr = [
                    "variant_name" => $request->variant_name,
                    "variant_slug" => $request->variant_slug,
                    "sku" => $request->sku,
                    "price" => $request->price,
                    "stock" => $request->quantity,
                    "status" => 1
                ];

                $variant->Update($var_arr);

                foreach ($request->attribute_pair as $att_obj) {
                    
                    $att_data_arr = [];

                    $att_data_arr = array(
                        "attribute_value_id" => $att_obj["attribute_value_id"],
                        "variant_id" => $variant_id,
                        "primary_pair" => 0
                    );
                    
                    array_push($attr_mapper_arr, $att_data_arr);                                                
                }

                /*The size and color values we get from form is ultimately passed into the attribute mapper 
                with additional attributes.*/
                $sizeAttVals = array(
                    "attribute_value_id" => $request->size,
                    "variant_id" => $variant_id,
                    "primary_pair" => 1
                );
                $colorAttVals = array(
                    "attribute_value_id" => $request->color,
                    "variant_id" => $variant_id,
                    "primary_pair" => 1
                );
                array_push($attr_mapper_arr, $sizeAttVals, $colorAttVals);
                // array_push($attr_mapper_arr, $colorAttVals);
                
                if(count($attr_mapper_arr)){
                    AttributeMapper::where('variant_id', $variant_id)->delete();
                    $insertAttrMapper = AttributeMapper::insert($attr_mapper_arr);
                }

                // Commit the transaction if everything is successful
                DB::commit();
                // $return_URI
                
                // This makes it more structured
                return response()->json([
                    "type" => "Success",
                    "message" => "Variant updated successfully!",
                    "requested_action_performed" => true,
                    "reload" => false
                ], 200);

                // Laravel automatically converts arrays to JSON, but it does not allow setting custom HTTP status codes.
            }
            catch (ModelNotFoundException $e) {
                return response()->json([
                    "type" => "Failed",
                    "message" => "No variant present for the given id",
                    "errors" => $e->getMessage(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 500);
            }
            catch(\Exception $e){   // General Error
                DB::rollBack(); 

                // Log data
                    $log_data = [
                        // "var_arr" => $var_arr,
                        // "attr_mapper_arr" => $attr_mapper_arr,
                        "error" => $e->getMessage(),
                    ];

                    \Log::info("\n\nVariant Data:", $log_data);
                // Log data END

                // This makes it more structured
                return response()->json([
                    "type" => "Failed",
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
                    "message" => "Unable to update Variant!",
                    "errors" => $e->getMessage(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 500);
            }

        }
        // TAGS: xhrRequest, ASYNC, Handling validation, USE THIS

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
    
    // STOCK
        public function GET_VARIANT_STOCK(Request $request){
            
            $variant_id = $request->query("variant_id");

            $variant_stock = SubProduct::select('stock', 'price')->where('id', $variant_id)->where('status', 1)->get();
            
            return ["variant_stock" => $variant_stock[0]];
        }

        public function UPDATE_VARIANT_STOCK(Request $request){

            $validation_arr = [
                'price' => 'required|numeric|min:1|max:100000',
                'quantity' => 'required|integer|min:0'
            ];

            // DB operation to add the image file locations to the database
            try{
                $variant_id = $request->variant_id;

                $variant = SubProduct::findOrFail($variant_id);

                $variant->Update([
                    "price" => $request->price,
                    "stock" => $request->quantity,
                ]);

                return redirect()->back()->with('success', 'Stock updated successfully!');
            }
            catch (ModelNotFoundException $e) {
                return redirect()->back()->with('error', 'Failed to update stock. Invalid product.');
            }
            catch(QueryException $e){
                return redirect()->back()->with('error', 'Failed to update stock: ' . $e->getMessage());
            }
            catch(Exception $e){   // General Error
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
            catch(\Error $e){
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }

        }
    // STOCK END

    
    // GENRAL PURPOSE FUNCTIONS
                
        // function to get variant list 
        public function GET_VARIANT_LIST(Request $request){
            
            $variant_list = SubProduct::when($request->has("product_id"), function($query) use($request){
                                $product_id = $request->query("product_id");
                                return $query->where('product_id', $product_id);
                            })
                            ->select('id', 'variant_name', 'variant_slug')->where('status', 1)->get();


            return ["variant_list" => $variant_list];
        }

        
    // GENRAL PURPOSE FUNCTIONS END


}
