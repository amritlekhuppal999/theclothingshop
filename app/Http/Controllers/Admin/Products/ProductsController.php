<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private $products_route = 'admin-panel/products/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    //
    public function showProductsView()
    {
        return view($this->products_route.'products');
    }

    public function selectCategoryView()
    {
        return view($this->products_route.'add-products');
    }

    public function addProductForm($subCategorySlug)
    {   
        // $data_arr = ['subCategorySlug' => $subCategorySlug];

        if(!empty($subCategorySlug)){

            /*
                Verify if the slug is correct and exists in the DB
            */

            $data_arr = [
                'categorySlug' => "category-1", 
                'subCategorySlug' => $subCategorySlug,
                "show_product_form" => TRUE                
            ];
            
            return view($this->products_route.'add-products', $data_arr);

        }

        else {
            $data_arr = [
                "error_message" => "Invalid category. We could not find the page you were looking for. Please enter a valid URL."
            ];
            return view($this->VIEW_NOT_FOUND, $data_arr);
        }

    }

    public function addProductImageForm($productSlug="")
    {   
        $data_arr = array();
        //  !empty($productSlug)
        if(!empty($productSlug)){  // this will check if the product slug is correct or not

            /*
                Verify if the slug is correct and exists in the DB
            */

            $data_arr['productSlug'] = $productSlug;
            
            
        }
        return view($this->products_route.'add-products', $data_arr);

        // else {
        //     $data_arr = [
        //         "error_message" => "Invalid product. We could not find the page you were looking for. Please enter a valid URL."
        //     ];
        //     return view($this->VIEW_NOT_FOUND, $data_arr);
        // }

    }

    public function addProductVariantForm($productSlug="")
    {   
        $data_arr = array();

        // !empty($productSlug)
        if(!empty($productSlug)){  // this will check if the product slug is correct or not

            /*
                Verify if the slug is correct and exists in the DB
            */

            $data_arr['productSlug'] = $productSlug;
        }

        // else {
        //     $data_arr = [
        //         "error_message" => "Invalid product. We could not find the page you were looking for. Please enter a valid URL."
        //     ];
        //     return view($this->VIEW_NOT_FOUND, $data_arr);
        // }
        
        return view($this->products_route.'add-products', $data_arr);

    }
}
