<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage; // for file access on server



use App\Models\Category;
use App\Models\CategoryImage;


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
    public function IMAGE_GALLERY_INDEX($categorySlug=null){
        // do the thing with the slug
        
        // return view($this->category_route.'category-images', ["categorySlug" => $categorySlug]);
        return view($this->category_route.'category-images', ["categorySlug" => $categorySlug]);
    }

    // View Category Image Gallery
    public function ADD_IMAGE_INDEX($categorySlug=null){
        // do the thing with the slug
        
        // return view($this->category_route.'category-images', ["categorySlug" => $categorySlug]);
        return view($this->category_route.'category-images-add', ["categorySlug" => $categorySlug]);
    }

    // function to add images
    public function ADD_IMAGE(Request $request){

        $request->validate([
            'category_id' => 'required|integer|exists:category,id',
            'primary_img_id' => 'integer'
        ]);

        
        //$tempImg = $request->image_arr[0];
        // var_dump($request->image_arr[0]);
        // return $tempImg["img_uri"];
        // return;

        $category_id = $request->category_id;
        $primary_img_id = $request->primary_img_id;
        $image_arr = $request->image_arr;

        // wrapper array to add bulk data 
        $insert_image_data = [];

        foreach ($image_arr as $img_object) {
            $img_id = $img_object["img_id"];
            $img_string = $img_object["img_uri"];

            // Takes base64 string converts it to a file and returns its path and link
            $image_data = base64_to_file($img_string);
            $decodedImage = $image_data["decodedImage"]; 
            $fileName = $image_data["fileName"];

            $path = "images/category/";
            $filePath = public_path($path. $fileName);
            file_put_contents($filePath, $decodedImage);
            $fileUrl = asset($path . $fileName);

            $some_arr = array(
                "category_id" => $category_id,
                // "image_location" => $fileUrl,
                "image_location" => '/'.$path.$fileName,
                "prime_image" => ($img_id == $primary_img_id) ? 1 : 0,
                "status" => 1
            );

            array_push($insert_image_data, $some_arr);
        }

        
        try{

            // Save the data in the database
            $insert_category_img = CategoryImage::insert($insert_image_data);

            if($insert_category_img){
                // Redirect with a success message
                // return redirect()->back()->with('success', 'Category Images added successfully!');
                return [
                    "type" => "Success",
                    "message" => "Category Images added successfully!",
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
                    "requested_action_performed" => true,
                    "reload" => true
                ];
            }
        }
        catch(QueryException $e){
            // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
            return [
                "type" => "Failed",
                "message" => "An error occurred:".$e->getMessage(),
                "requested_action_performed" => true,
                "reload" => true
            ];
        }
        
    }

    // View Category Image Gallery
    public function UPDATE_IMAGE_INDEX($categorySlug){
        // do the thing with the slug
        
        $category = Category::where('category_slug', $categorySlug)->get();
        // $category = $category[0];
        $category_id = $category[0]["category_id"];
        $category_name = $category[0]["category_name"];
        
        // print_r($category_name);

        $category_images = CategoryImage::where('category_id', $category_id)->get();

        $return_data = array(
            "categorySlug" => $categorySlug,
            "category" => $category[0],
            "category_images" => $category_images
        );

        return view($this->category_route.'category-images-update', $return_data);
    }

    // function to add images
    public function UPDATE_IMAGE(Request $request){

        $request->validate([
            'category_id' => 'required|integer',
            'primary_img_id' => 'integer'
        ]);

        
        $category_id = $request->category_id;
        $primary_img_id = $request->primary_img_id;
        $image_arr = $request->image_arr;

        define("MAX_FILE_UPLOAD_LIMIT", 5);

        // get total no of images added in a particular category
        $img_count = CategoryImage::where("category_id", $category_id)->where("status", 1)->count();

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

                $path = "images/category/";
                $filePath = public_path($path. $fileName);
                file_put_contents($filePath, $decodedImage);
                $fileUrl = asset($path . $fileName);

                $some_arr = array(
                    "category_id" => $category_id,
                    //"image_location" => $fileUrl,
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
                    CategoryImage::where("category_id", $category_id)->where("prime_image", 1)->update(["prime_image" => 0]);
                }
    
                // Save the data in the database
                $insert_category_img = CategoryImage::insert($insert_image_data);
    
                if($insert_category_img){
                    // Redirect with a success message
                    // return redirect()->back()->with('success', 'Category Images added successfully!');
                    return [
                        "type" => "Success",
                        "message" => "Category Images added successfully!",
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

    // View Category Image Gallery
    public function CATEGORY_IMAGE_GALLERY($categoryID){
        // do the thing with the slug
        
        
        try {
            $categoryImages = CategoryImage::where('category_id', $categoryID)
                                            ->where('status', 1)
                                            ->select("id as category_img_id", "image_location", "prime_image")
                                            ->get();

            // return ["categoryImages" => $categoryImages];

            if (count($categoryImages)) {
                # code...
                return [
                    "type" => "Success",
                    "categoryImages" => $categoryImages,
                    "message" => "",
                    "requested_action_performed" => true,
                    "reload" => false
                ];
            }
            else {
                return [
                    "type" => "Failure",
                    "categoryImages" => $categoryImages,
                    "message" => "No images added.",
                    "requested_action_performed" => false,
                    "reload" => false
                ];
            }

        } 
        catch (QueryException $e) {
            
            return [
                "type" => "Failed",
                "categoryImages" => [],
                "message" => "An error occurred: " . $e->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ];
        }
        
        // var_dump($categoryImages);
        // return view($this->category_route.'category-images', ["categorySlug" => $categorySlug]);
        // return ["categoryImages" => $categoryImages];
        
    }


    public function REMOVE_CATEGORY_IMAGE(Request $request){
        
        $img_id = $request->img_id;

        try {
            $category_image = CategoryImage::select("image_location", "prime_image")->where("id", $img_id)->get();
            $image_path = $category_image[0]["image_location"];
            $prime_image = $category_image[0]["prime_image"];

            $filePath = public_path($image_path);

            $delete_opr = CategoryImage::where("id", $img_id)->update([
                "status" => 0
            ]);

            if ($delete_opr) {
                
                // To delete the file files and update its status 
                if (file_exists($filePath) && unlink($filePath)) {

                    CategoryImage::where("id", $img_id)->update([
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
        $category_id = $request->category_id;

        try {
            CategoryImage::where("category_id", $category_id)->update([ "prime_image" => 0 ]);
            CategoryImage::where("id", $img_id)->update([ "prime_image" => 1 ]);

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
    

    // DEALS With Front-End JS requests
    public function get_category_list(){

        $category_list = Category::where('status', '!=', 0)->select('id', 'category_name', 'category_slug')->get();
        return ["category_list" => $category_list];
    }
}