<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    private $category_route = 'admin-panel/category/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    public function showCategoryView()
    {
        return view($this->category_route.'category');
    }

    public function showAddCategoryForm($catgorySlug="")
    {
        // do the thing with the slug
        
        return view($this->category_route.'add-category');
    }

    public function showSubCategoryView($catgorySlug="")
    {
        // do the thing with the slug
        
        return view($this->category_route.'sub-category');
    }
}
