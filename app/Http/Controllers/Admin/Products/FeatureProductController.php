<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FeaturedProducts;
use App\Models\Product;

class FeatureProductController extends Controller
{
    private $products_route = 'admin-panel/products/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';
    
    // view to see added products table
    public function INDEX(Request $request){

        define("DEFAULT_RECORD_LIMIT", 10);

        $limit = ($request->has("limit")) ? $request->query("limit") : DEFAULT_RECORD_LIMIT ;
        $search_keyword = ($request->has("search_keyword")) ? $request->query("search_keyword") : "" ;

        $featured_products = Product::from('products as PRO')
                        ->join('featured_collection as FC', function($join){
                            $join->on('FC.product_id', '=', 'PRO.id');
                        })
                        ->join('sub_category as SC', function($join){
                            $join->on('FC.collection_id', '=', 'SC.id');
                        })
                        ->select(
                            'PRO.id', 'PRO.product_name', 'PRO.product_slug',
                            'SC.sub_category_name as collection_type'
                        )
                        ->where('PRO.status', 1)
                        ->orderBy('FC.collection_id');
        
        $featured_product_list = $featured_products->paginate($limit)->withQueryString();
        
        // This does exactly what is being done in the above loop but maintaining the pagination and laravel logic.
        //  

        $return_data = array(
            "product_list" => $featured_product_list,
            "search_keyword" => $search_keyword
        );
        
        return view($this->products_route.'featured', $return_data);
    }
    
    public function CREATE_FEATURED_PRODUCTS(Request $request){
                
        return view($this->products_route.'add-featured-products');
    }

    // Store Featured products
    public function STORE_FEATURED_PRODUCTS(Request $request){
        // Validate the incoming data
        $request->validate([
            'selectProduct' => 'required|string|unique:products,product_slug',
            'selectCollection' => 'integer',
            'display_page' => 'required|string|max:255',
        ]);

        try{

            // Save the data in the database
            $product_data = FeaturedProducts::create([
                'display_page' => $request->display_page,
                'product_id' => $request->selectProduct,
                'collection_id' => $request->selectCollection
            ]);

            return redirect()->back()->with('success', 'Featured product added successfully!');
        }
        catch(QueryException $e){
            return redirect()->back()->with('error', 'Failed to add featured product details: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
        catch(Exception $e){   // General Error
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
    }
}
