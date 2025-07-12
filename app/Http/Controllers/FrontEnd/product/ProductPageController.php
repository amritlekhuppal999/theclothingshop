<?php

namespace App\Http\Controllers\FrontEnd\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;

use App\Models\SubProduct;      //ProductVariant
use App\Models\AttributeMapper;
use App\Models\AttributeValue;
use App\Models\ProductCategoryMapper;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductPageController extends Controller
{
    
    private $products_route = 'front-end';
    private $VIEW_NOT_FOUND = '404';

    //
    public function INDEX($product_slug){

        try {
            Product::where('product_slug', $product_slug)->firstOrFail();
            
            $product = Product::where('product_slug', $product_slug)->get();
            
            $product_id = getProductId($product_slug);
            
            $product_images = ProductImage::select('id', 'image_location', 'prime_image')
                                ->where('product_id', $product_id)
                                ->where('status', 1)
                                ->get();
            
            $product_attribute_map = SubProduct::from('sub_products as SUB_PROD')
                                        ->select( 
                                            // SubProduct::raw('MAX(SUB_PROD.id) as variant_id')
                                            SubProduct::raw('COUNT(ATV.value) as ATV_COUNT'),
                                            'ATV.value'
                                        )
                                        ->join('attribute_mappers as ATM', function($query){
                                            $query->on('ATM.variant_id', '=', 'SUB_PROD.id')
                                            ->where('ATM.primary_pair', '=', 1);
                                        })
                                        ->join('attribute_values as ATV', function($query){
                                            $query->on('ATV.id', '=', 'ATM.attribute_value_id');
                                        })
                                        ->join('attributes as ATR', function($query){
                                            $query->on('ATR.id', '=', 'ATV.attribute_id')
                                            ->where('ATR.name', 'size');
                                        })
                                        ->where('SUB_PROD.product_id', '=', $product_id)
                                        ->where('SUB_PROD.stock', '>', 0)
                                        // ->orWhere('SUB_PROD.stock_status', '=', 0)
                                        ->groupBy('ATV.value');

            $attr_array = [];

            $pamArr = $product_attribute_map->get()->toArray();
            foreach($pamArr as $key => $attribute){
                $attr_array[$attribute["value"]] = $attribute["ATV_COUNT"];
            }
            

            $product_data = [
                "product" => $product[0],
                "product_attribute_list" => $attr_array,
                "product_images" => $product_images
            ];

            // LOG
                $log_data = [
                    // "product_attribute_map" => $product_attribute_map->get()->toArray(),
                    // "sql_query" => $product_attribute_map->toSql(),
                    // "sql_str_binding" => $product_attribute_map->getBindings(),
                    "attr_array" => $attr_array,
                ];
                /*
                    select MAX(SUB_PROD.id) as variant_id, `ATR`.`name` from `sub_products` as `SUB_PROD` 
                    inner join `attribute_mappers` as `ATM` on `ATM`.`variant_id` = `SUB_PROD`.`id` and `ATM`.`primary_pair` = 1 
                    inner join `attribute_values` as `ATV` on `ATV`.`id` = `ATM`.`attribute_value_id` 
                    inner join `attributes` as `ATR` on `ATR`.`id` = `ATV`.`attribute_id` and `ATR`.`name` = "color" 
                    where `SUB_PROD`.`product_id` = 77 
                    group by `ATR`.`name`
                */

                // \Log::info("\nProduct Data: ",  $log_data);
            // LOG END

            return view($this->products_route.'/product', ['product_data' => $product_data]);
        } 
        
        catch (ModelNotFoundException $e) {
            // \Log::info("Exception Thrown: ", ["error_msg" => $e->getMessage()]);
            
            return view($this->products_route.'/'.$this->VIEW_NOT_FOUND, [
                "message" => "Product not found."
            ]);
        }

        catch (\Throwable $th) {
            // \Log::info("Exception Thrown: ", ["error_msg" => $th->getMessage()]);
            
            return view($this->products_route.'/'.$this->VIEW_NOT_FOUND, [
                "message" => "Something went wrong!"
            ]);
        }
        
    }


    // public function get_variant_attribute(Request $request){
    //     $log_data = [
    //         "request_data" => $request->all()
    //     ];
    //     \Log::info("\nProduct Data: ",  $log_data);
    // }

    public function get_variant_attribute(Request $request){
        $product_id = isset($request->product_id) ? $request->product_id : null;
        $attribute_value = isset($request->attribute_value) ? $request->attribute_value : null;

        // \Log::info("\nproduct_id: ",  ["product_id" => $product_id, "attribute_value" => $attribute_value]);
        
        $return_data = response()->json([
            "type" => "Failed",
            "message" => "Invalid request",
            "errors" => "",
            "requested_action_performed" => false,
            "reload" => false
        ], 400);
        
        if($product_id && $attribute_value){

            try {

                /*
                    select ATV.value from attribute_values as ATV 
                    inner join attribute_mappers as ATM on ATV.id = ATM.attribute_value_id and ATM.variant_id IN(

                        select SUB_PROD.id
                            from `sub_products` as `SUB_PROD` 
                        inner join `attribute_mappers` as `ATM` on `SUB_PROD`.`id` = `ATM`.`variant_id` 
                        inner join `attribute_values` as `ATV` on `ATV`.`id` = `ATM`.`attribute_value_id` and ATV.value = "M"
                        where `SUB_PROD`.`product_id` = 77
                    )
                    inner join attributes as ATR on ATR.id = ATV.attribute_id and ATR.name = "color"
                */
    
                $color_data = AttributeValue::from('attribute_values as ATV')
                                ->join('attribute_mappers as ATM', function($query){
                                    $query->on('ATV.id', '=', 'ATM.attribute_value_id');
                                })
                                ->join('attributes as ATR', function($query){
                                    $query->on('ATR.id', '=', 'ATV.attribute_id')
                                    ->where('ATR.name', "color");
                                })
                                ->whereIn('ATM.variant_id', function($query)use($attribute_value, $product_id){
                                    $query->select('SUB_PROD.id')
                                        ->from('sub_products as SUB_PROD')
                                        ->join('attribute_mappers as ATM2', 'SUB_PROD.id', '=', 'ATM2.variant_id')
                                        ->join('attribute_values as ATV2', function ($join) use ($attribute_value) {
                                            $join->on('ATV2.id', '=', 'ATM2.attribute_value_id')
                                                ->where('ATV2.value', $attribute_value);
                                        })
                                        ->where('SUB_PROD.product_id', '=', $product_id);
                                })
                                ->join('sub_products as SUB_PROD', 'SUB_PROD.id', '=', 'ATM.variant_id')
                                ->select('ATV.id', 'ATV.value', 'ATV.label', 'ATM.variant_id', 'SUB_PROD.stock', 'SUB_PROD.price');



                $log_data = [
                    // "sql_query" => $variant_data->toSql(),
                    // "sql_str_binding" => $variant_data->getBindings(),
                    // "product_id" => $product_id,
                    "attr_array" => $color_data->get()->toArray(),
                ];
                // \Log::info("\Color Data: ",  $log_data);

                return response()->json([
                    "type" => "Success",
                    "message" => "",
                    "color_data" => $color_data->get()->toArray(),
                    "requested_action_performed" => true,
                    "reload" => false
                ], 200);
            } 
            
            catch (\Throwable $th) {

                $return_data = response()->json([
                    "type" => "Failed",
                    "message" => "Unable to get variant",
                    "errors" => $th->getMessage(),
                    "requested_action_performed" => false,
                    "reload" => false
                ], 204);
            }
        }

        return $return_data;
    }
}

