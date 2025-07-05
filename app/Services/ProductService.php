<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SubProduct;
use App\Models\ProductImage;

use App\Models\AttributeMapper;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductCategoryMapper;


class ProductService{

    // PRODUCTS 
        // returns Product name
        public function getProductName($product_id){  // can use slug aswell
            $product_name = Product::where('id', $product_id)->orWhere('product_slug', $product_id)->value('product_name');

            return $product_name;
        }

        // returns Product slug
        public function getProductSlug($product_id){
            $product_slug = Product::where('id', $product_id)->value('product_slug');

            return $product_slug;
        }

        // returns Product id
        public function getProductId($product_slug){   // can use slug aswell
            $product_id = Product::where('product_slug', $product_slug)->value('id');

            return $product_id;
        }
    // PRODUCTS END

    // Product target group: Male, Female, Unisex
    public function get_target_group($gender_code){
        $gen_arr = array(
            "0" => "Unset",
            "1" => "Male",
            "2" => "Female"
        );

        return $gen_arr[$gender_code];
    }
}