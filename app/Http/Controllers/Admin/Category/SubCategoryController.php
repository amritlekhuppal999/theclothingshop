<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SubCategory;

class SubCategoryController extends Controller{
    //
    private $category_route = 'admin-panel/category/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    // Sub Category View
    public function INDEX($categorySlug = null){
        // do the thing with the slug
        
        // if (strtolower($categorySlug) == "all") {
        //     $subCategories = SubCategory::orderBy('sub_category.status', 'desc')->paginate(10);   
        // }

        // $status = request('status') !== null ? request('status') : null;
        $status = null;
        $status = (strtolower(request('status')) == "deleted") ? 0 : 1;

        $search_value = request('search_value') !== null ? request('search_value') : null;

        if (!empty($categorySlug)) {


            $subCategories = SubCategory::join('category as C', 'sub_category.category_id', '=', 'C.id')
                                        ->where('C.category_slug', $categorySlug)
                                        ->select('sub_category.*')
                                        ->orderBy('sub_category.status', 'desc')
                                        ->when(isset($status), function($query) use($status){
                                            return $query->where('sub_category.status', $status);
                                        })
                                        ->paginate(10)->withQueryString(); // queryString works together/after paginate is called.
        }

        else {
            $subCategories = SubCategory::orderBy('sub_category.status', 'desc')
                            ->when(isset($status), function($query) use($status){
                                return $query->where('sub_category.status', $status);
                            })
                            ->paginate(10)->withQueryString();  // queryString works together/after paginate is called.
        }

        return view($this->category_route.'sub-category', ["categorySlug" => $categorySlug, "subCategories" => $subCategories]);
    }

    // Add Category Form
    public function CREATE($categorySlug=""){
        // do the thing with the slug

        // This category will allow us pass category slug in URL and use it over and over
        // Currently not in use!!!
        if($categorySlug){
            return view($this->category_route.'add-sub-category', ["categorySlug" => $categorySlug]);
        }

        else return view($this->category_route.'add-sub-category');
    }

    // save sub category
    public function STORE(Request $request){
        // Validate the incoming data
        $request->validate([
            'subCategoryName' => 'required|string|max:255',
            'subCategorySlug' => 'required|string|unique:sub_category,sub_category_slug',
            'select_category' => 'required|integer'
        ]);

        // create validation for checking if the slug is unique

        try{

            // Save the data in the database
            $subCategory = SubCategory::create([
                'sub_category_name' => $request->subCategoryName,
                'sub_category_slug' => $request->subCategorySlug,
                'category_id' => $request->select_category,
                'status' => 1
            ]);

            if($subCategory){
                // Redirect with a success message
                return redirect()->back()->with('success', 'Sub-Category added successfully!');
            }
            else {
                return back()->withErrors([ "error" => "Failed to add the sub-category." ]);
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

    // Add Category EDIT Form
    public function EDIT($subCategorySlug){

        // $subCategory = SubCategory::select('sub_category_name', 'sub_category_slug', 'category_id')->where('sub_category_slug', $subCategorySlug)->get();

        
        try {
            $test_subcat = SubCategory::where('sub_category_slug', $subCategorySlug)->firstOrFail();
            
            $subCategory = SubCategory::join('category as C', 'sub_category.category_id', '=', 'C.id')
                                            ->where('sub_category.sub_category_slug', $subCategorySlug)
                                            ->select('sub_category.id', 'sub_category.sub_category_name', 'sub_category.sub_category_slug',
                                                    'sub_category.category_id', 'C.category_slug')
                                            ->get();

            // var_dump($subCategory);
            return view($this->category_route.'update-sub-category', ["subCategory" => $subCategory]);
        } 
        catch (ModelNotFoundException $e) {
            //return not found view with message...
            return view($VIEW_NOT_FOUND, ["error_message" => "Invalid Sub-Category. Please Enter a valid Sub Category Slug"]);
        }

        catch(QueryException $e){
            // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            return view($VIEW_NOT_FOUND, ["error_message" => "Invalid Sub-Category. Please Enter a valid Sub Category Slug"]);
        }
    }

    // UPDATE sub category
    public function UPDATE(Request $request){
        // Validate the incoming data
        $request->validate([
            'subCategoryName' => 'required|string|max:255',
            'subCategorySlug' => 'required|string|unique:sub_category,sub_category_slug, '.$request->sub_category_id,
            'select_category' => 'required|integer'
        ]);
        
        try{

            // Find the existing attribute by its ID
            $sub_category = SubCategory::findOrFail($request->sub_category_id);

            // Save the data in the database
            $update_subCat = $sub_category->update([
                'category_id' => $request->select_category,
                'sub_category_name' => $request->subCategoryName,
                'sub_category_slug' => $request->subCategorySlug
            ]);

            if($update_subCat){
                // Redirect with a success message
                return redirect()->to('admin/sub-category-edit/'.$request->subCategorySlug)->with('success', 'Sub-Category updated successfully!');
            }

            else return back()->withErrors([ "error" => "Failed to update sub-category." ]);
        }
        catch (ModelNotFoundException $e) {
            // Handle the case where the attribute doesn't exist
            return back()->withErrors([ "error" => "Invalid Sub Category." ]);
        }
        catch(QueryException $e){
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // DELETE sub category
    public function DELETE(Request $request){
        // Validate the incoming data
        
        try{
             // Find the existing attribute by its ID
            $sub_category = SubCategory::findOrFail($request->sub_category_id);

            $status_value = ($request->requested_action == "delete-sub-category") ? 0 : 1;
            $requested_action = ($request->requested_action == "delete-sub-category") ? "deleted" : "restored";

            // Save the data in the database
            $sub_category->update([
                'status' => $status_value
            ]);

            // Redirect with a success message
            return [
                "type" => "Success",
                "message" => "Sub-Category ".$requested_action." successfully.",
                "requested_action_performed" => true,
                "reload" => true
            ];
        }
        catch (ModelNotFoundException $e) {
            // Handle the case where the attribute doesn't exist
            // return redirect()->back()->withErrors(['error' => 'Attribute not found.']);
            return [
                "type" => "Failed",
                "message" => "Sub-Category not found.",
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
}
