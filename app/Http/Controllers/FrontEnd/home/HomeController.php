<?php   //FRONT END 

namespace App\Http\Controllers\FrontEnd\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;    // ADDED

use App\Models\BannerImages;        // ADDED
use App\Models\SubCategory;         // ADDED
use App\Models\SubCategoryImage;    // ADDED

use App\Models\Product;         // ADDED
use App\Models\ProductImage;    // ADDED

use App\Models\FeaturedProducts; // ADDED


class HomeController extends Controller
{
    private $HOME_ROUTE = 'front-end/';
    private $VIEW_NOT_FOUND = 'front-end/404';
    private $COMPONENT_FRONT = 'components.front.';


    public function CREATE(){

        // try {
        //     $bannerImages = BannerImages::where('status', 1)->where('active_in_banner', 0)->get();

        //     $return_data = [
        //         "bannerImages" => $bannerImages
        //     ];
        // } 
        // catch (\Throwable $th) {
        //     //throw $th;
        //     $return_data = [
        //         "bannerImages" => collect()
        //     ];
        // }

        // return view($this->HOME_ROUTE.'home', $return_data);
        return view($this->HOME_ROUTE.'home');
    }

    // function to dynamically load a component using JS API call
    public function GET_BANNER_CAROUSEL(){
        try {
            $bannerImages = BannerImages::where('status', 1)->where('active_in_banner', 1)->get();

            $return_data = [
                "bannerImages" => $bannerImages
            ];
        } 
        catch (\Throwable $th) {
            //throw $th;
            $return_data = [
                "bannerImages" => collect()
            ];
        }

        return view($this->COMPONENT_FRONT.'carousel', $return_data);
    }

    public function GET_FEATURED_CATEGORIES(){
        $sql_str = "";
        try {
            $sub_category = SubCategory::from('sub_category as SC')
                            // ->join('sub_category_images as SCI', 'SC.id', '=', 'SCI.sub_category_id')
                            ->leftjoin('sub_category_images as SCI', function($join){
                                $join->on('SC.id', '=', 'SCI.sub_category_id')
                                    ->where('SCI.prime_image', 1)
                                    ->where('SCI.status', 1);
                                // Just mutate, no return
                            })
                            ->join('category as CAT', function($join){
                                $join->on('SC.category_id', '=', 'CAT.id');
                            })
                            ->select(
                                "SC.id as sub_cat_id", 
                                "SC.sub_category_name as SC_name", 
                                "SC.sub_category_slug as SC_slug", 
                                "SCI.image_location as SCIL", 
                                "SCI.prime_image as SC_prime_image",
                                "CAT.category_slug"
                            )
                            ->where('SC.status', 1)
                            ->where('SC.featured', 1);

            // $sql_str_binding = $sub_category->getBindings();
            $sql_str = $sub_category->toSql();
            $sub_category = $sub_category->get();
                                
            // Rendering 2nd degree component for nesting (product component)
            $product_array = [];
            foreach ($sub_category->toArray() as $key => $sub_cat) {
                $prod_data = array(
                    "displayPage" => "home",
                    "cardType" => "category",
                    "cardSize" => "4",
                    "cardTheme" => ($key == 0) ? "dark" : "",
                    "slug" => 'category/'.$sub_cat["category_slug"].'?sc='.$sub_cat["SC_slug"],
                    "imageSlug" => ($sub_cat["SCIL"]) ? $sub_cat["SCIL"] : "images/product-card-loader.jpg",
                    "description" => "",
                    "itemName" => $sub_cat["SC_name"],
                );
                $product_html = view('components.front.product.product-card', $prod_data)->render();
                array_push($product_array, $product_html);
            }

            // Rendering 2nd degree component for nesting (product component) END

            // LOG DATA
                $log_data = [
                    "sub_category" => $sub_category->toArray(),
                    "product_array" => $product_array,
                    "sql_query" => $sql_str,
                    //"sql_str_binding" => $sql_str_binding,
                ];
                //\Log::info("GET_FEATURED_CATEGORIES:", $log_data);
            // LOG DATA END


            $return_data = [
                // "sub_category" => $sub_category,
                "product_array" => $product_array,
                "error_msg" => "",
                "sql_query" => $sql_str
            ];
        } 
        catch (\Throwable $th) {

            // LOG DATA
                $log_data = [
                    "error_msg" => $th->getMessage(),
                    "sql_query" => $sql_str,
                    //"sql_str_binding" => $sql_str_binding,
                ];
                //\Log::info("GET_FEATURED_CATEGORIES ERROR:", $log_data);
            // LOG DATA END

            //throw $th;
            $return_data = [
                // "sub_category" => collect(),
                "product_array" => [],
                "error_msg" => $th->getMessage(),
                "sql_query" => $sql_str
            ];
        }

        return view($this->COMPONENT_FRONT.'home.featured-big-three', $return_data)->render();
        // return view('components.front.home.featured-big-three', $return_data)->render();

        
        
    }

    public function GET_REMAINING_FEATURED_CATEGORIES(){
        $sql_str = "";
        try {
            $sub_category = SubCategory::from('sub_category as SC')
                            ->leftjoin('sub_category_images as SCI', function($join){
                                $join->on('SC.id', '=', 'SCI.sub_category_id')
                                    ->where('SCI.prime_image', 1)
                                    ->where('SCI.status', 1);
                                // Just mutate, no return
                            })
                            ->join('category as CAT', function($join){
                                $join->on('SC.category_id', '=', 'CAT.id');
                            })
                            ->select(
                                "SC.id as sub_cat_id", 
                                "SC.sub_category_name as SC_name", 
                                "SC.sub_category_slug as SC_slug", 
                                "SCI.image_location as SCIL", 
                                "SCI.prime_image as SC_prime_image",
                                "CAT.category_slug"
                            )
                            ->where('SC.status', 1)
                            ->where('SC.featured', 0)->limit(8);

            $sql_str_binding = $sub_category->getBindings();
            $sql_str = $sub_category->toSql();
            $sub_category = $sub_category->get();
                                
            // Rendering 2nd degree component for nesting (product component)
            $product_array = [];
            foreach ($sub_category->toArray() as $key => $sub_cat) {
                $prod_data = array(
                    "displayPage" => "home",
                    "cardType" => "category",
                    "cardSize" => "3",
                    "cardTheme" => ($key == 0) ? "dark" : "",
                    "slug" => 'category/'.$sub_cat["category_slug"].'?sc='.$sub_cat["SC_slug"],
                    "imageSlug" => ($sub_cat["SCIL"]) ? $sub_cat["SCIL"] : "images/product-card-loader.jpg",
                    "description" => "",
                    "itemName" => $sub_cat["SC_name"],
                );
                $product_html = view('components.front.product.product-card', $prod_data)->render();
                array_push($product_array, $product_html);
            }

            // Rendering 2nd degree component for nesting (product component) END


            $return_data = [
                // "sub_category" => $sub_category,
                "product_array" => $product_array,
                "error_msg" => "",
                "sql" => $sql_str,
                "sql_str_binding" => $sql_str_binding
            ];
        } 
        catch (\Throwable $th) {
            //throw $th;
            $return_data = [
                // "sub_category" => collect(),
                "product_array" => [],
                "error_msg" => $th->getMessage(),
                "sql" => $sql_str,
                "sql_str_binding" => $sql_str_binding
            ];
        }

        return view($this->COMPONENT_FRONT.'home.featured-remaining-category', $return_data)->render();
        // return view('components.front.home.featured-big-three', $return_data)->render();

        
        
    }

    

    public function GET_FEATURED_PRODUCTS(Request $request){
        $sql_str = "";
        define("MAX_DISPLAY_RECORD_COUNT", 4);
        $feature_group = $request->query("feature_group");
        $sql_str_binding = '';
        try {
            //$new_addition = FeaturedProducts::where
            $new_addition = FeaturedProducts::from('featured_collection as FC')
                            ->select(
                                "products.id as product_id", 
                                "products.product_name as product_name", 
                                "products.product_slug as product_slug", 
                                "PI.image_location as image_location", 
                                "PI.prime_image as prime_image"
                            )
                            ->join('products', 'products.id', '=', 'FC.product_id')
                            ->leftjoin('product_images as PI', function($join){
                                $join->on('products.id', '=', 'PI.product_id')
                                    ->where('PI.prime_image', 1)
                                    ->where('PI.status', 1);
                                // Just mutate, no return
                            })
                            ->where('FC.collection_id', function($query)use($feature_group){
                                return $query->from('sub_category')
                                        ->where('sub_category_slug', $feature_group)
                                        ->select('id')
                                        ->limit(1);
                            })
                            ->limit(MAX_DISPLAY_RECORD_COUNT);

            $sql_str_binding = $new_addition->getBindings();
            $sql_str = $new_addition->toSql();
            $new_addition = $new_addition->get();
                                
            // Rendering 2nd degree component for nesting (product component)
            $product_array = [];
            foreach ($new_addition->toArray() as $key => $arrivals) {
                $prod_data = array(
                    "displayPage" => "home",
                    "cardType" => "product",
                    "cardSize" => "3",
                    "cardTheme" => ($key == 0) ? "dark" : "",
                    "slug" => 'product/'.$arrivals["product_slug"],
                    "imageSlug" => ($arrivals["image_location"]) ? $arrivals["image_location"] : "images/product-card-loader.jpg",
                    "description" => "",
                    "itemName" => $arrivals["product_name"],
                );
                $product_html = view('components.front.product.product-card', $prod_data)->render();
                array_push($product_array, $product_html);
            }

            // Rendering 2nd degree component for nesting (product component) END


            $return_data = [
                // "sub_category" => $sub_category,
                "product_array" => $product_array,
                "sql" => $sql_str,
                "sql_str_binding" => $sql_str_binding,
                "error_msg" => "",
            ];
        } 
        catch (\Throwable $th) {
            //throw $th;
            $return_data = [
                // "sub_category" => collect(),
                "product_array" => [],
                "sql" => $sql_str,
                "sql_str_binding" => $sql_str_binding,
                "error_msg" => $th->getMessage(),
            ];
        }

        return view($this->COMPONENT_FRONT.'home.featured-products', $return_data)->render();
        // return view('components.front.home.featured-big-three', $return_data)->render();
    }

    
}

// $html = View::make($this->COMPONENT_FRONT.'product.featured-big-three', $return_data)->render();
// return response($html, 200)->header('Content-Type', 'text/html');

// return view($this->COMPONENT_FRONT.'product.wrapper-big-three', $return_data)->render();

// i am trying to pass collections through my components...