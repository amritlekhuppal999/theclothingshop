<?php

namespace App\Services;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductCategoryMapper;

class CategoryService{

    // CATEGORIES 
        // returns category name
        public function getCategoryName($category_id){  // can use slug aswell
            $category_name = Category::where('id', $category_id)->orWhere('category_slug', $category_id)->value('category_name');

            return $category_name;
        }

        // returns category slug
        public function getCategorySlug($category_id){
            $category_slug = Category::where('id', $category_id)->value('category_slug');

            return $category_slug;
        }

        // returns category id
        public function getCategoryId($category_slug){   // can use slug aswell
            // $category_id = SubCategory::where('category_slug', $category_slug)->value('id');
            $category_id = Category::where('category_slug', $category_slug)->value('id');

            return $category_id;
        }
    // CATEGORIES END


    // SUB CATEGORIES
        // returns sub-category name
        public function getSubCategoryName($sub_category_id){   // can use slug aswell
            $sub_category_name = SubCategory::where('id', $sub_category_id)->orWhere('sub_category_slug', $sub_category_id)->value('sub_category_name');

            return $sub_category_name;
        }

        // returns sub-category id
        public function getSubCategoryId($sub_category_slug){   // can use slug aswell
            $sub_category_id = SubCategory::where('sub_category_slug', $sub_category_slug)->value('id');

            return $sub_category_id;
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
    // SUB CATEGORIES END
}