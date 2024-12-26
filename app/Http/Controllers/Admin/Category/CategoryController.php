<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    //
    private $category_route = 'admin-panel/category/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    // Category View
    public function showCategoryView(){
        return view($this->category_route.'category');
    }

    // Add Category Form
    public function showAddCategoryForm($catgorySlug=""){
        // do the thing with the slug
        
        return view($this->category_route.'add-category');
    }

    // Sub Category View
    public function showSubCategoryView($catgorySlug=""){
        // do the thing with the slug
        
        return view($this->category_route.'sub-category');
    }

    // Save Category
    public function storeCategory(Request $request){
        // Validate the incoming data
        $request->validate([
            'category' => 'required|string|max:255',
            'category_slug' => 'required|string'
        ]);

        try{

            // Save the data in the database
            $category = Attribute::create([
                'category' => $request->attributeValue,
                'category_slug' => $request->attributeLabel,
                'status' => 1
            ]);

            if($category){
                // Redirect with a success message
                return redirect()->back()->with('success', 'Category added successfully!');
            }
            else {
                return back()->withErrors([ "error" => "Failed to add the category." ]);
                // return redirect()->back()->with('error', 'Failed to add the attribute.');
            }
        }
        catch(QueryException $e){
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
        

        // Redirect with a success message
        // return redirect()->back()->with('success', 'Data has been saved successfully!');
    }
}
