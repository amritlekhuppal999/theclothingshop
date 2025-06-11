<?php

namespace App\Services;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductCategoryMapper;

class CategoryService{

    // returns category name
    public function getCategoryName($category_id){
        $category_name = Category::where('id', $category_id)->value('category_name');

        return $category_name;
    }

    // returns sub-category name
    public function getSubCategoryName($sub_category_id){
        $sub_category_name = SubCategory::where('id', $sub_category_id)->value('sub_category_name');

        return $sub_category_name;
    }

    // return list of all the sub_categories for a given product_id
    public function get_sub_category_list($product_id){
        return ProductCategoryMapper::from('product_category_mapper as PCM')
                    ->select('SC.sub_category_name', 'SC.sub_category_slug')
                    ->where('PCM.product_id', $product_id)
                    ->leftjoin('sub_category as SC', function($join){
                        $join->on('PCM.sub_category_id', '=', 'SC.id');
                    })
                    ->get();
    }
}