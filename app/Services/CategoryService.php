<?php

namespace App\Services;

use App\Models\Category;
use App\Models\SubCategory;

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
}