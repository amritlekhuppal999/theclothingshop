<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Models\Category;


// Category class
class CategoryController extends Controller
{
    //
    private $category_route = 'admin-panel/category/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    // Category View
    public function INDEX(){

        $status = null;
        $status = (strtolower(request('status')) == "deleted") ? 0 : 1;
        
        
        if(!isset($status)){
            $categories = Category::paginate(10)->withQueryString();
            
        }

        else{

            $categories = Category::when(isset($status), function($query) use($status){
                                        return $query->where('status', $status);
                                    })
                                    ->paginate(10)->withQueryString();
        }



        return view($this->category_route.'category', ["categories" => $categories]);
    }

    // Add Category Form
    public function CREATE($catgorySlug=""){
        // do the thing with the slug
        
        return view($this->category_route.'add-category');
    }

    // Save Category
    public function STORE(Request $request){
        // Validate the incoming data
        $request->validate([
            'categoryName' => 'required|string|max:255',
            'categorySlug' => 'required|string|unique:category,category_slug'
        ]);

        try{

            // Save the data in the database
            $category = Category::create([
                'category_name' => $request->categoryName,
                'category_slug' => $request->categorySlug,
                'theme_id' => 1,
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

    // Edit Category
    public function EDIT($categorySlug){
        
        try {
            $test_cat = Category::where('category_slug', $categorySlug)->firstOrFail();

            $category = Category::where('category_slug', $categorySlug)->select('id', 'category_slug', 'category_name')->get();
            return view($this->category_route.'update-category', ["category" => $category]);

        } 
        catch (ModelNotFoundException $e) {
            // return view($VIEW_NOT_FOUND, ["error_message" => "Invalid Sub-Category. Please Enter a valid Sub Category Slug"]);
        }
        catch (QueryException $e) {
            // return view($VIEW_NOT_FOUND, ["error_message" => "Invalid Sub-Category. Please Enter a valid Sub Category Slug"]);
        }
    }

    // UPDATE Category
    public function UPDATE(Request $request){
        // Validate the incoming data
        $request->validate([
            'categoryName' => 'required|string|max:255',
            'categorySlug' => 'required|string|unique:category,category_slug, '.$request->category_id,
        ]);
        
        try{

            // Find the existing attribute by its ID
            $category = Category::findOrFail($request->category_id);

            // Save the data in the database
            $update_cat = $category->update([
                'category_name' => $request->categoryName,
                'category_slug' => $request->categorySlug
            ]);

            if($update_cat){
                // Redirect with a success message
                return redirect()->to('admin/category-edit/'.$request->categorySlug)->with('success', 'Sub-Category updated successfully!');
            }

            else return back()->withErrors([ "error" => "Failed to update category." ]);
        }
        catch (ModelNotFoundException $e) {
            // Handle the case where the attribute doesn't exist
            return back()->withErrors([ "error" => "Invalid Category." ]);
        }
        catch(QueryException $e){
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // DELETE or RESTORE sub category
    public function DELETE(Request $request){
        // Validate the incoming data
        
        try{
             // Find the existing attribute by its ID
            $category = Category::findOrFail($request->category_id);

            $status_value = ($request->requested_action == "delete-category") ? 0 : 1;
            $requested_action = ($request->requested_action == "delete-category") ? "deleted" : "restored";

            // Save the data in the database
            $category->update([
                'status' => $status_value
            ]);

            // Redirect with a success message
            return [
                "type" => "Success",
                "message" => "Category ".$requested_action." successfully.",
                "requested_action_performed" => true,
                "reload" => true
            ];
        }
        catch (ModelNotFoundException $e) {
            // Handle the case where the attribute doesn't exist
            // return redirect()->back()->withErrors(['error' => 'Attribute not found.']);
            return [
                "type" => "Failed",
                "message" => "Category not found.",
                "requested_action_performed" => false,
                "reload" => false
            ];
        }
        catch(QueryException $e){
            // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            return [
                "type" => "Failed",
                "message" => "An error occurred: " . $e->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ];
        }
    }


    // View Category Image Gallery
    public function IMAGE_GALLERY($categorySlug=null){
        // do the thing with the slug
        
        // return view($this->category_route.'category-images', ["categorySlug" => $categorySlug]);
        return view($this->category_route.'category-images-add', ["categorySlug" => $categorySlug]);
    }


    // function to add images
    public function ADD_IMAGE(Request $request){

        //print_r($request);

        // Redirect with a success message
        return [
            "type" => "Success",
            "message" => "Upload Request received successfully!",
            "requested_action_performed" => true,
            "reload" => true
        ];
    }

    // DEALS With Front-End JS requests
    public function get_category_list(){

        $category_list = Category::where('status', '!=', 0)->select('id', 'category_name', 'category_slug')->get();
        return ["category_list" => $category_list];
    }
}