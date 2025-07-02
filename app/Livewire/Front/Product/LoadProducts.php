<?php

namespace App\Livewire\Front\Product;

use Livewire\Component;

use Illuminate\Http\Request;    // Added
use Illuminate\Support\Facades\DB;  // Added

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
    protected $queryString = ["sc", "theme", "size", "color", "price", "sort"];
    public $sc, $theme, $size, $color, $price, $sort;

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
    public function updateSort($newSort){
        $this->sort = $newSort;
    }
    
    // fetch product details
    private function getProductData(){

        /* TODO
            1   Need to be modified later to show paginated results instead of what we are doing right now,
                which is just increasing count of total no of produced results for lazy load

            2   DUPLICATE RESULTS!!!
        */

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
                        ->when($this->color || $this->size, function($query) { // querying/joining the same table
                            $color_arr = ($this->color) ? explode(",", $this->color) : [];   // get the comma separated values from query params
                            $size_arr = ($this->size) ? explode(",", $this->size) : [];

                            // $attribute_name = !empty($color_arr) ? 'Color' : 'Size';

                            $primary_attribute_array = [...$size_arr, ...$color_arr];

                            /*  // METHOD 2 (NOT WORKING AS INTENDED)
                                $subProductSubQuery = DB::table('sub_products')
                                    ->select(DB::raw('MIN(id) as id'), 'product_id')->groupBy('product_id');

                                $ATM_subQuery = DB::table('attribute_mappers as ATM')
                                    ->join('attribute_values as ATV', 'ATV.id', '=', 'ATM.attribute_value_id')
                                    ->whereIn('ATV.value', $primary_attribute_array)
                                    ->whereRaw('ATM.id = (
                                        SELECT MIN(id)
                                        FROM attribute_mappers
                                        WHERE variant_id = ATM.variant_id
                                    )')
                                    ->select('ATM.id', 'ATM.variant_id', 'ATM.attribute_value_id');

                                return $query
                                    ->joinSub($subProductSubQuery, 'SUB_PROD', function ($join) {
                                        $join->on('SUB_PROD.product_id', '=', 'PRO.id');
                                    })
                                    ->joinSub($ATM_subQuery, 'ATM', function ($join) {
                                        $join->on('ATM.variant_id', '=', 'SUB_PROD.id');
                                    });
                            
                            */

                            // METHOD 1 (NOT WORKING AS INTENDED)
                            return $query
                                ->join('sub_products as SUB_PROD', function($join){
                                    $join->on('SUB_PROD.product_id', '=', 'PRO.id');
                                })

                                ->join('attribute_mappers as ATM', function($join){
                                    $join->on('ATM.variant_id', '=', 'SUB_PROD.id')->where('ATM.primary_pair', 1);
                                })
                                
                                ->join('attribute_values as ATV', function($join) use($primary_attribute_array){
                                    $join->on('ATV.id', '=', 'ATM.attribute_value_id')->whereIN('ATV.value', $primary_attribute_array);
                                });
                            
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
                        
                        
                        ->when($this->sort, function($query) {  // SORT FILTER (ORDER BY)
                            if(isset($this->sort) && !empty($this->sort)){
                                
                                $sort_level = $this->sort;
                                $sort_column = ''; $sort_order = '';
                                
                                if($sort_level == 1){
                                    $sort_column = 'PRO.product_name'; $sort_order = 'ASC';
                                }
                                else if($sort_level == 2){
                                    $sort_column = 'PRO.product_name'; $sort_order = 'DESC';
                                }
                                else if($sort_level == 3){
                                    $sort_column = 'PRO.base_price'; $sort_order = 'DESC';
                                }
                                else if($sort_level == 4){
                                    $sort_column = 'PRO.base_price'; $sort_order = 'ASC';
                                }
                                else if($sort_level == 5){
                                    $sort_column = 'PRO.id'; $sort_order = 'DESC';
                                }


                                return $query->orderBy($sort_column, $sort_order);
                            }
                            
                            else return $query->orderBy('PRO.id', 'ASC');
                        })
                        // ->orderBy('PRO.id', 'ASC')
                        ->where('PRO.category_id', $this->categoryId)
                        ->distinct()    // THIS IS A QUICK FIX TO A MUCH MUCH BIGGER PROBLEM, WILL DEAL WITH IT LATER
                        ->limit($this->loadAmount);
                        
        // $productData = $productData->distinct();
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

        // \Log::info("\n\nProduct List Data:", $log_data);

        return view('livewire.front.product.load-products')->with([
            'productList' => $productList
        ]);
    }
}
