<?php

namespace App\Http\Controllers\FrontEnd\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;

use App\Models\SubProduct;      //ProductVariant
use App\Models\AttributeMapper;
use App\Models\ProductCategoryMapper;


class ProductPageController extends Controller
{
    
    private $products_route = 'front-end';
    private $VIEW_NOT_FOUND = '404';

    //
    function CREATE($product_slug){

        if(!empty($product_slug)){

            try {
                $product = Product::where('product_slug', $product_slug)->firstOrFail();
                
                $product = Product::where('product_slug', $product_slug)->get();
                
                $product_id = getProductId($product_slug);
                
                $product_images = ProductImage::select('id', 'image_location', 'prime_image')
                                    ->where('product_id', $product_id)
                                    ->where('status', 1)
                                    ->get();
                
                // $product_attribute_map = AttributeMapper::from('attribute_mappers as ATM')
                //                             ->join('attribute_values');

                $product_data = [
                    "product" => $product[0],
                    // "product_attribute_map" => $product_attribute_map,
                    "product_images" => $product_images
                ];

                // LOG
                    // $log_data = [
                    //     // "product_list" => $product_list,
                    //     "sql_query" => $sql_query,
                    //     "sql_str_binding" => $sql_str_binding,
                    // ];

                    // \Log::info("Product Data: ", $product->toArray() );
                // LOG END

                return view($this->products_route.'/product', ['product_data' => $product_data]);
            } 
            
            catch (\Throwable $th) {
                // \Log::info("Exception Thrown: ", ["error_msg" => $th->getMessage()]);

                return view($this->products_route.'/'.$this->VIEW_NOT_FOUND, ["return_data", ""]);
            }
            
            catch (\ModelNotFoundException $e) {
                // \Log::info("Exception Thrown: ", ["error_msg" => $th->getMessage()]);

                return view($this->products_route.'/'.$this->VIEW_NOT_FOUND, ["return_data", ""]);
            }
        }

        else {
            // \Log::info("Error: No Slug found");
            return view($this->products_route.'/'.$this->VIEW_NOT_FOUND, ["return_data", ""]);
        }
        
    }
}
