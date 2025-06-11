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