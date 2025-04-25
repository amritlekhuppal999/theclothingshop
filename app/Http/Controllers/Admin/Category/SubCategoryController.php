<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SubCategory;
use App\Models\SubCategoryImage;

class SubCategoryController extends Controller{
    //
    private $category_route = 'admin-panel/category/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    // Sub Category View
    public function INDEX(Request $request, $categorySlug=null){
        // do the thing with the slug
        
        $limit = ($request->has("limit")) ? $request->query("limit") : 10 ;
        $search_keyword = ($request->has("search_keyword")) ? $request->query("search_keyword") : "" ;
        $status = ($request->has("status")) ? $request->query("status") : null ;

        $subCategories = SubCategory::when(!empty($categorySlug), function($query) use($categorySlug){
                                        return $query->join('category as C', 'sub_category.category_id', '=', 'C.id')
                                                    ->where('C.category_slug', $categorySlug);
                                    })
                                    ->when($request->has("status"), function($query) use($request){
                                        $status = ($request->query("status") == "active") ? 1 : 0 ;
                                        return $query->where('sub_category.status', $status);
                                    })
                                    ->when($request->has("search_keyword"), function($query) use($request){
                                        $search_keyword = $request->query("search_keyword");
                                        
                                        return $query->where('sub_category_name', 'like', '%'.$search_keyword.'%')
                                                    ->orWhere('sub_category_slug', 'like', '%'.$search_keyword.'%');
                                    })
                                    ->orderBy('sub_category.status', 'desc')
                                    ->paginate($limit)->withQueryString();

        $return_data = [
            "categorySlug" => $categorySlug, 
            "subCategories" => $subCategories,
            "search_keyword" => $search_keyword,
            "status" => $status
        ];

        return view($this->category_route.'sub-category', $return_data);
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
        // Validate the incoming data?
        
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

    // View Category Image Gallery
    public function IMAGE_GALLERY_INDEX($subCategorySlug=null){
        // do the thing with the slug
        
        // return view($this->category_route.'category-images', ["categorySlug" => $categorySlug]);
        return view($this->category_route.'sub-category-images', ["subCategorySlug" => $subCategorySlug]);
    }

    // View Category Image Gallery
    public function SUB_CATEGORY_IMAGE_GALLERY($subCategoryID){
        // do the thing with the slug
        
        
        try {
            $subCategoryImages = SubCategoryImage::where('sub_category_id', $subCategoryID)
                                            ->where('status', 1)
                                            ->select("id as sub_category_img_id", "image_location", "prime_image")
                                            ->get();

            // return ["categoryImages" => $categoryImages];

            if (count($subCategoryImages)) {
                # code...
                return [
                    "type" => "Success",
                    "subCategoryImages" => $subCategoryImages,
                    "message" => "",
                    "requested_action_performed" => true,
                    "reload" => false
                ];
            }
            else {
                return [
                    "type" => "Failure",
                    "subCategoryImages" => $subCategoryImages,
                    "message" => "No images added.",
                    "requested_action_performed" => false,
                    "reload" => false
                ];
            }

        } 
        catch (QueryException $e) {
            
            return [
                "type" => "Failed",
                "subCategoryImages" => [],
                "message" => "An error occurred: " . $e->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ];
        }
        
        // var_dump($subCategoryImages);
        // return view($this->category_route.'category-images', ["categorySlug" => $categorySlug]);
        // return ["subCategoryImages" => $subCategoryImages];
        
    }

    // View Category Image Gallery
    public function ADD_IMAGE_INDEX($subCategorySlug=null){
        // do the thing with the slug
        
        return view($this->category_route.'sub-category-images-update', ["subCategorySlug" => $subCategorySlug]);
    }

    // ADD/UPDATE IMAGE for sub category
    public function UPDATE_IMAGE(Request $request){

        $request->validate([
            'sub_category_id' => 'required|integer',
            'primary_img_id' => 'integer'
        ]);

        
        $sub_category_id = $request->sub_category_id;
        $primary_img_id = $request->primary_img_id;
        $image_arr = $request->image_arr;

        define("MAX_FILE_UPLOAD_LIMIT", 5);

        // get total no of images added in a particular category
        $img_count = SubCategoryImage::where("sub_category_id", $sub_category_id)->where("status", 1)->count();

        $new_img_count = count($image_arr);

        $total_img_count = $img_count + $new_img_count;

        /* 
            check if total img count is greater than or equal to 5, operations occur if its less than 5 and the sum total of the new and old must 
            not exceede 5
        */ 
        if($total_img_count <= MAX_FILE_UPLOAD_LIMIT ){
            
            // wrapper array to add bulk data 
            $insert_image_data = [];

            // Loop to convert base64 to image files and save them in the server location.
            foreach ($image_arr as $img_object) {
                $img_id = $img_object["img_id"];
                $img_string = $img_object["img_uri"];

                // Takes base64 string converts it to a file and returns its path and link
                $image_data = base64_to_file($img_string);
                $decodedImage = $image_data["decodedImage"]; 
                $fileName = $image_data["fileName"];

                $path = "images/sub_category/";
                $filePath = public_path($path. $fileName);
                file_put_contents($filePath, $decodedImage);
                $fileUrl = asset($path . $fileName);

                $some_arr = array(
                    "sub_category_id" => $sub_category_id,
                    "image_location" => '/'.$path.$fileName,
                    "prime_image" => ($img_id == $primary_img_id) ? 1 : 0,
                    "status" => 1
                );

                array_push($insert_image_data, $some_arr);
            }

            // DB operation to add the image file locations to the database
            try{

                if($primary_img_id){
                    // Find the existing attribute by its ID
                    SubCategoryImage::where("sub_category_id", $sub_category_id)->where("prime_image", 1)->update(["prime_image" => 0]);
                }
    
                // Save the data in the database
                $insert_category_img = SubCategoryImage::insert($insert_image_data);
    
                if($insert_category_img){
                    // Redirect with a success message
                    // return redirect()->back()->with('success', 'Category Images added successfully!');
                    return [
                        "type" => "Success",
                        "message" => "Sub-Category Images added successfully!",
                        "requested_action_performed" => true,
                        "reload" => true
                    ];
                }
                else {
                    // return back()->withErrors([ "error" => "Failed to add the images." ]);
                    // return redirect()->back()->with('error', 'Failed to add the attribute.');
                    return [
                        "type" => "Failed",
                        "message" => "Failed to add the images!",
                        "requested_action_performed" => false,
                        "reload" => false
                    ];
                }
                
                
            }
            catch(QueryException $e){
                // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
                // return redirect()->back()->with('error', 'An error occurred: ');
                return [
                    "type" => "Failed",
                    "message" => "An error occurred:".$e->getMessage(),
                    "requested_action_performed" => false,
                    "reload" => false
                ];
            }
            
        }

        else {
            // return back()->withErrors([ "error" => "Failed to add the images." ]);
            // return redirect()->back()->with('error', 'Failed to add the attribute.');
            return [
                "type" => "Failed",
                "message" => 'This category has '.MAX_FILE_UPLOAD_LIMIT.' or more images added. Remove the ones you don\'t need.',
                "requested_action_performed" => false,
                "reload" => false
            ];
        }

    }


    public function REMOVE_SUB_CATEGORY_IMAGE(Request $request){
        
        $img_id = $request->img_id;

        try {
            $category_image = SubCategoryImage::select("image_location", "prime_image")->where("id", $img_id)->get();
            $image_path = $category_image[0]["image_location"];
            $prime_image = $category_image[0]["prime_image"];

            $filePath = public_path($image_path);

            $delete_opr = SubCategoryImage::where("id", $img_id)->update([
                "status" => 0
            ]);

            if ($delete_opr) {
                
                // To delete the file files and update its status 
                if (file_exists($filePath) && unlink($filePath)) {

                    SubCategoryImage::where("id", $img_id)->update([
                        "deleted" => 1  // This means File has been deleted and the DB record is now free for removal
                    ]);
                }

                return [
                    "type" => "Success",
                    "message" => "Selected Image has been deleted",
                    "requested_action_performed" => true,
                    "reload" => false
                ];
                
            }

            else {
                return [
                    "type" => "Failed",
                    "message" => "Unable to delete the selected Image.",
                    "requested_action_performed" => false,
                    "reload" => false
                ];
            }

        } 
        catch (QueryException $e) {
            
            return [
                "type" => "Failed",
                "message" => "An error occurred: " . $e->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ];
        }
    }
    
    public function UPDATE_BANNER_IMAGE(Request $request){
        
        $img_id = $request->img_id;
        $sub_category_id = $request->sub_category_id;

        try {
            SubCategoryImage::where("sub_category_id", $sub_category_id)->update([ "prime_image" => 0 ]);
            SubCategoryImage::where("id", $img_id)->update([ "prime_image" => 1 ]);

            return [
                "type" => "Success",
                "message" => "Banner image update",
                "requested_action_performed" => true,
                "reload" => false
            ];
        
        } 
        catch (QueryException $e) {
            
            return [
                "type" => "Failed",
                "message" => "An error occurred: " . $e->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ];
        }
    }
    
    // DEALS With Front-End API requests
    public function get_sub_category_list($categoryID=null){

        if($categoryID){
            $sub_category_list = SubCategory::where('status', '!=', 0)
                                ->where("category_id", $categoryID)
                                ->select('id', 'sub_category_name', 'sub_category_slug')
                                ->get();
        }
        else $sub_category_list = SubCategory::where('status', '!=', 0)
                                  ->select('id', 'sub_category_name', 'sub_category_slug')
                                  ->get();

        return ["sub_category_list" => $sub_category_list];
    }
}
