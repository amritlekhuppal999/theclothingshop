<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductsController extends Controller
{

    private $products_route = 'admin-panel/products/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    // view to see added products table
    public function INDEX()
    {
        return view($this->products_route.'products');
    }

    // add product form view
    public function CREATE(Request $request){
        
        $category_slug = $request->query('cat');
        $sub_category_slug = $request->query('sub_cat');

        $return_data = array(
            "category_slug" => $category_slug,
            "sub_category_slug" => $sub_category_slug
        );
        return view($this->products_route.'add-products', $return_data);
    }

    // Save Category
    public function STORE(Request $request){
        // Validate the incoming data
        $request->validate([
            'targetGroup' => 'required|integer',
            'product_name' => 'required|string|max:255',
            'product_slug' => 'required|string|unique:products,product_slug',
            'category_id' => 'integer',
            'sub_category_id' => 'integer',
            'base_price' => 'required|numeric|min:1|max:100000',
            'discount_percentage' => 'required|numeric|min:0.01',
            'short_description' => 'string|max:1000',
            'long_description' => 'string|max:65535',
        ]);

        try{

            // Save the data in the database
            $product_data = Product::create([
                'product_name' => $request->product_name,
                'product_slug' => $request->product_slug,
                'target_group' => $request->targetGroup,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'base_price' => $request->base_price,
                'discount_percentage' => $request->discount_percentage,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'status' => 1
            ]);

            // if($category){
            //     // Redirect with a success message
            //     return redirect()->back()->with('success', 'Category added successfully!');
            // }
            // else {
            //     return back()->withErrors([ "error" => "Failed to add the category." ]);
            //     // return redirect()->back()->with('error', 'Failed to add the attribute.');
            // }

            return redirect()->back()->with('success', 'Product added successfully!');
        }
        catch(QueryException $e){
            return redirect()->back()->with('error', 'Failed to add product details: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
        catch(Exception $e){   // General Error
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
        

        // Redirect with a success message
        // return redirect()->back()->with('success', 'Data has been saved successfully!');
    }

    
    
    // add image product form
    public function CREATE_IMAGE($productSlug=null){   
        
        $return_data['productSlug'] = $productSlug;
        return view($this->products_route.'add-product-image', $return_data);

    }

    
    
    public function CREATE_VARIANT($productSlug=null)
    {   
        $return_data['productSlug'] = $productSlug;
        return view($this->products_route.'add-product-variant', $return_data);

    }


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
}
