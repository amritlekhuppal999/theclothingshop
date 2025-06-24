<?php

namespace App\Livewire\Front\Product;

use Livewire\Component;

use Illuminate\Http\Request;    // Added

use App\Models\Product;
// use App\Models\SubProdduct;
// use App\Models\ProdductImages;

use App\Models\Category;
// use App\Models\SubCategory;

use App\Models\ProductCategoryMapper;

class LoadProducts extends Component
{
    
    public $totalRecords;  // total no of records present
    public $loadAmount = 8;    // no of records to load
    
    public $categoryId;

    public $refresh = false;

    //protected $listeners = ["subCatFiltered" => "render"];

    /*
        These are query parameters, instead of using Request object or request helper method (which wont work in lazyload in livewire components), 
        we are using these properties and Livewire automatically binds these properties to their respective queryParams.

        $queryString tells Livewire which public properties to sync with the URL query parameters.
        Those public properties ($sc, $theme, etc.) actually hold the values.
        Without defining these as public properties, Livewire won’t know where to put the values and won’t sync them properly.
    */
    protected $queryString = ["sc", "theme", "size", "color", "price"];
    public $sc, $theme, $size, $color, $price;

    // this is triggered from front end to load more elements. (LAZY LOAD)
    public function loadMore(){
        // if (!empty($params)) {
        //     foreach ($params as $key => $value) {
        //         if (property_exists($this, $key)) {
        //             $this->$key = $value;
        //         }
        //         // $this->queryString[$key] = $value;
        //     }
        // }

        $this->loadAmount += 8;
    }

    // To rerender the livewire component with updated query params
    public function updateSC($new_sub_cat){
        $this->sc = $new_sub_cat;
    }
    public function updateTheme($newTheme){
        $this->theme = $newTheme;
    }
    public function updateSize($newSize){
        $this->size = $newSize;
    }
    public function updateColor($newColor){
        $this->color = $newColor;
    }
    public function updatePrice($newPrice){
        $this->price = $newPrice;
    }
    
    // fetch product details
    private function getProductData(){

        $productData = Product::from('products as PRO')
                        ->select(
                            "PRO.id as product_id", 
                            "PRO.product_name as product_name", 
                            "PRO.product_slug as product_slug", 
                            "PRO.base_price as base_price", 
                            "PRO.discount_percentage as discount_percentage", 
                            "PRO.short_description as short_description", 
                            "PI.image_location as image_location", 
                            "PI.prime_image as prime_image"
                        )
                        ->leftjoin('product_images as PI', function($join){
                            $join->on('PRO.id', '=', 'PI.product_id')
                                ->where('PI.prime_image', 1)
                                ->where('PI.status', 1);
                            // Just mutate, no return
                        })
                        ->when( $this->sc || $this->theme, function($query) {  // SUB CAT FILTER
                            $all_sub_cat_array = [];    // sub-cat array that will store sub-cat of theme and otehr categories from user
                            

                            $sub_cat_array = ($this->sc) ? explode(",", $this->sc) : [];   // get the comma separated values from query params
                            $theme_array = ($this->theme) ? explode(",", $this->theme) : [];  // get the comma separated values from query params

                            $all_sub_cat_array = [...$sub_cat_array, ...$theme_array];  // Dump them to the main array using spread operator... cool right!!?

                            // modifying the values of the array that are as slugs to their respective sub-cat ids
                            $all_sub_cat_array = array_map(function($items){    
                                return getSubCategoryId($items);
                            }, $all_sub_cat_array);            

                            return $query->join('product_category_mapper as PCM', function($join) use($all_sub_cat_array){
                                $join->on('PCM.product_id', '=', 'PRO.id')->whereIn('PCM.sub_category_id', $all_sub_cat_array);
                            });
                        })
                        ->when($this->size, function($query) {
                            // TO DO LATER
                        }) 
                        ->when($this->color, function($query) {
                            // TO DO LATER
                        })
                        ->when($this->price, function($query) {  // PRICE FILTER
                            $price_level = $this->price;
                            $lower_limit = 0; $upper_limit = 0;
                            if($price_level == 1){
                                $lower_limit = 500; $upper_limit = 1073;
                            }
                            else if($price_level == 2){
                                $lower_limit = 1074; $upper_limit = 1548;
                            }
                            else if($price_level == 3){
                                $lower_limit = 1549; $upper_limit = 2500;
                            }
                            else if($price_level == 3){
                                $lower_limit = 2500; $upper_limit = 1000000000;
                            }
                            return $query->whereBetween('PRO.base_price', [$lower_limit, $upper_limit]);

                        })
                        ->where('PRO.category_id', $this->categoryId)
                        ->orderBy('PRO.id', 'ASC')
                        ->limit($this->loadAmount);

        return $productData;
    }

        
    public function mount(Request $request, $categorySlug){
        
        $category_id = Category::where('category_slug', $categorySlug)->first();
        $this->categoryId = ($category_id) ? $category_id->id : 0;
        
        $productData = $this->getProductData();
        
        // $this->totalRecords = $productData->count();
    }


    public function render(Request $request)
    {
        $productData = $this->getProductData();

        $this->totalRecords = $productData->count();

        $productList = $productData->get();
        $sql_query = $productData->toSql();
        $sql_str_binding = $productData->getBindings();

        $log_data = [
            // "product_list" => $productList,
            // "product_image" => $productList->toArray()[1]["image_location"],
            "sql_query" => $sql_query,
            "sql_str_binding" => $sql_str_binding,
        ];

        //\Log::info("\n\nProduct List Data:", $log_data);

        return view('livewire.front.product.load-products')->with([
            'productList' => $productList
        ]);
    }
}
