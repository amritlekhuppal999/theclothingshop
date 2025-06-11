
<?php

use App\Services\CategoryService;
use App\Services\ProductService;

    if (!function_exists('base64_to_file')) {
        
        function base64_to_file($base64String){
            // return "BASE 64 function";

            preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches);
            $fileExtension = $matches[1] ?? 'png'; // Default to PNG if not found

            // Remove the metadata (data:image/png;base64,)
            $base64Data = preg_replace('/^data:image\/\w+;base64,/', '', $base64String);
            $decodedImage = base64_decode($base64Data);

            // Generate a unique filename
            $fileName = uniqid() . '.' . $fileExtension;

            // Define the storage path (inside storage/app/public/uploads/)
            // $filePath = "uploads/".$fileName;

            // Save the file
            // Storage::disk('public')->put($filePath, $decodedImage);

            // Output the stored file path or URL
            // return response()->json(['file_path' => $filePath, 'file_url' => $fileUrl]);
            return array(
                'decodedImage' => $decodedImage, 
                'fileName' => $fileName
            );
        }
    }

    // function to create safe routes for blade binding
    function safe_route(string $name, array $params = [], string $fallback = '#') {
        return Route::has($name) ? route($name, $params) : $fallback;
    }


    //a general status function 
    if (!function_exists('getGeneralStatus')) {
        function getGeneralStatus($status_code){

            $status_arr = array(
                "0" => "Inactive",
                "1" => "Active",
            );

            return $status_arr[$status_code];
        }
    }

    //a general status function 
    if (!function_exists('getStockStatus')) {
        function getStockStatus($status_code){

            $status_arr = array(
                "0" => "Out Of Stock",
                "1" => "In-Stock",
            );

            return $status_arr[$status_code];
        }
    }


    if (!function_exists('getCategoryName')) {
        function getCategoryName($category_id){

            return app(CategoryService::class)->getCategoryName($category_id);
            // if confused what the hell this is , its a service class, read docs
        }
    }

    if (!function_exists('getSubCategoryName')) {
        function getSubCategoryName($sub_category_id){

            return app(CategoryService::class)->getSubCategoryName($sub_category_id);
            // if confused what the hell this is , its a service class, read docs
        }
    }

    if(!function_exists('get_sub_category_list')){
        function get_sub_category_list($product_id){
            return app(CategoryService::class)->get_sub_category_list($product_id);
        }
    }



    if(!function_exists('get_target_group')){
        function get_target_group($gender_code){
            return app(ProductService::class)->get_target_group($gender_code);
        }
    }




    if(!function_exists('getUserRole')){
        function getUserRole($role_id){
            $role_arr = array(
                "1" => "Customer",
                "2" => "Seller",
                "3" => "Super Admin",
                "4" => "Regional Admin",
                "5" => "Inventory",
            );

            return $role_arr[$role_id];
        }
    }

    
    // function get_featured_group(){
    //     $feature_array = array(
    //         "1" =>  "New Arrivals",
    //         "2" =>  "Best Sellers",
    //         "3" =>  "Supima",
    //         "4" =>  "Pop Culture",
    //         "4" =>  "Top 10 This Week",
    //         "4" =>  "Styles in Spotlight",
    //         "4" =>  "Trendy Fits",
    //         "4" =>  "Summer Collection",
    //         "4" =>  "Winter Collection",
    //         "4" =>  "Shop's Special",
    //     );
    // }