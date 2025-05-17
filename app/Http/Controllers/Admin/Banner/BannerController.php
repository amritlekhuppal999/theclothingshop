<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;  // to use transactions
use App\Models\BannerImages;

class BannerController extends Controller
{
    private $banner_route = 'admin-panel/banner/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';


    public function CREATE_BANNER_IMAGES(Request $request){

        // $return_data = array(
        //     "product_list" => $product_list,
        //     "search_keyword" => $search_keyword,
        //     "total_products_added" => $total_products_added,
        //     "inventory" => $inventory,
        //     "out_of_stock" => $out_of_stock
        // );
        
        return view($this->banner_route.'banner-images-update');
    }



    // function to add images
    public function UPDATE_BANNER_IMAGES(Request $request){

        // $request->validate([
        //     'category_id' => 'required|integer',
        //     'primary_img_id' => 'integer'
        // ]);

        
        // $category_id = $request->category_id;
        $primary_img_id = $request->primary_img_id;
        $image_arr = $request->image_arr;

        // wrapper array to add bulk data 
        $insert_image_data = [];

        // Loop to convert base64 to image files and save them in the server location.
        foreach ($image_arr as $img_object) {
            $img_id = $img_object["img_id"];
            $img_string = $img_object["img_uri"];
            $active_in_banner = $img_object["active_in_banner"];

            // Takes base64 string converts it to a file and returns its path and link
            $image_data = base64_to_file($img_string);
            $decodedImage = $image_data["decodedImage"]; 
            $fileName = $image_data["fileName"];

            $path = "images/banner/";
            $filePath = public_path($path. $fileName);
            file_put_contents($filePath, $decodedImage);
            $fileUrl = asset($path . $fileName);

            $some_arr = array(
                // "image_location" => '/'.$path.$fileName,
                "image_location" => $path.$fileName,
                "active_in_banner" => $active_in_banner,
                "status" => 1
            );

            array_push($insert_image_data, $some_arr);
        }

        // DB operation to add the image file locations to the database
        try{

            // Save the data in the database
            $insert_banner_img = BannerImages::insert($insert_image_data);

            if($insert_banner_img){
                // Redirect with a success message
                // return redirect()->back()->with('success', 'Category Images added successfully!');
                return [
                    "type" => "Success",
                    "message" => "Banner Images added successfully!",
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
        catch(\Throwable $th){
            // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
            return [
                "type" => "Failed",
                "message" => "An error occurred:".$th->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ];
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


    public function SET_BANNER_IMAGE(Request $request){
        
        $img_id = $request->img_id;
        $action = ($request->action) ? 1 : 0;
        $msg = ($request->action) ? "active" : "in-active";

        define("MAX_ACTIVE_BANNER_IMAGE", 7);

        try {
            $count_active = BannerImages::where("active_in_banner", 1)->count();
            
            if(!$action){
                BannerImages::where("id", $img_id)->update([ "active_in_banner" => 0 ]);
                
                return [
                    "type" => "Success",
                    "message" => "Image is now ".$msg." in banner.",
                    "requested_action_performed" => true,
                    "reload" => false
                ];
            }

            else {
                if($count_active < MAX_ACTIVE_BANNER_IMAGE){

                    BannerImages::where("id", $img_id)->update([ "active_in_banner" => $action ]);
    
                    return [
                        "type" => "Success",
                        "message" => "Image is now ".$msg." in banner.",
                        "requested_action_performed" => true,
                        "reload" => false
                    ];
                }

                return [
                    "type" => "Failed",
                    "message" => "Cannot set more than ".MAX_ACTIVE_BANNER_IMAGE." images to banner.",
                    "requested_action_performed" => false,
                    "reload" => false
                ];
            }
            
        
        }
        catch (\Throwable $th) {
            
            return [
                "type" => "Failed",
                "message" => "Something went wrong: " . $th->getMessage(),
                "requested_action_performed" => false,
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

    public function REMOVE_BANNER_IMAGE(Request $request){
        
        $img_id = $request->img_id;

        try {
            $category_image = BannerImages::select("image_location")->where("id", $img_id)->get();
            $image_path = $category_image[0]["image_location"];
            // $prime_image = $category_image[0]["prime_image"];

            $filePath = public_path($image_path);

            $delete_opr = BannerImages::where("id", $img_id)->update([
                "status" => 0
            ]);

            if ($delete_opr) {
                
                // To delete the file files and update its status 
                if (file_exists($filePath) && unlink($filePath)) {

                    BannerImages::where("id", $img_id)->update([
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


    // View Category Image Gallery
    public function GET_BANNER_IMAGES(){
        // do the thing with the slug
        
        
        try {
            $bannerImages = BannerImages::where('status', 1)->get();

            // return ["categoryImages" => $categoryImages];

            if (count($bannerImages)) {
                # code...
                return [
                    "type" => "Success",
                    "bannerImages" => $bannerImages,
                    "message" => "",
                    "requested_action_performed" => true,
                    "reload" => false
                ];
            }
            else {
                return [
                    "type" => "Failure",
                    "bannerImages" => $bannerImages,
                    "message" => "No images added.",
                    "requested_action_performed" => false,
                    "reload" => false
                ];
            }

        } 
        catch (QueryException $e) {
            
            return [
                "type" => "Failed",
                "bannerImages" => [],
                "message" => "An error occurred: " . $e->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ];
        }
        
        // var_dump($categoryImages);
        // return view($this->category_route.'category-images', ["categorySlug" => $categorySlug]);
        // return ["categoryImages" => $categoryImages];
        
    }
}



