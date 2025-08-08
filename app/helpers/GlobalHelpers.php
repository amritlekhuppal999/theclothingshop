<?php

use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\AttributeService;
use App\Services\WishlistService;

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

    // ATTRIBUTES
        if (!function_exists('getAttributeList')) {
            function getAttributeList($attributeType=""){   // can use slug aswell

                return app(AttributeService::class)->getAttributeList($attributeType);
                // if confused what the hell this is , its a service class, read docs
            }
        }
    // ATTRIBUTES END
    
    // CATEGORIES
        if (!function_exists('getCategoryName')) {
            function getCategoryName($category_id){

                return app(CategoryService::class)->getCategoryName($category_id);
                // if confused what the hell this is , its a service class, read docs
            }
        }

        if (!function_exists('getCategoryslug')) {
            function getCategoryslug($category_id){

                return app(CategoryService::class)->getCategoryslug($category_id);
                // if confused what the hell this is , its a service class, read docs
            }
        }

        if (!function_exists('getCategoryId')) {
            function getCategoryId($category_slug){

                return app(CategoryService::class)->getCategoryId($category_slug);
                // if confused what the hell this is , its a service class, read docs
            }
        }
    // CATEGORIES END

    // SUB CATEGORIES
        if (!function_exists('getSubCategoryName')) {
            function getSubCategoryName($sub_category_id){

                return app(CategoryService::class)->getSubCategoryName($sub_category_id);
                // if confused what the hell this is , its a service class, read docs
            }
        }

        if (!function_exists('getSubCategoryId')) {
            function getSubCategoryId($sub_category_slug){

                return app(CategoryService::class)->getSubCategoryId($sub_category_slug);
                // if confused what the hell this is , its a service class, read docs
            }
        }

        if(!function_exists('get_sub_category_list')){
            function get_sub_category_list($product_id){
                return app(CategoryService::class)->get_sub_category_list($product_id);
            }
        }
    // SUB CATEGORIES END

    
    // PRODUCTS
        if (!function_exists('getProductName')) {
            function getProductName($product_id){   // can use slug aswell

                return app(ProductService::class)->getProductName($product_id);
                // if confused what the hell this is , its a service class, read docs
            }
        }

        if (!function_exists('getProductSlug')) {
            function getProductSlug($product_id){

                return app(ProductService::class)->getProductSlug($product_id);
                // if confused what the hell this is , its a service class, read docs
            }
        }
        
        if (!function_exists('getProductId')) {
            function getProductId($product_slug){

                return app(ProductService::class)->getProductId($product_slug);
                // if confused what the hell this is , its a service class, read docs
            }
        }
    // PRODUCTS END

    
    // WISHLIST
        if (!function_exists('isAddedToWishlist')) {
            function isAddedToWishlist($product_id){   // can use slug aswell

                return app(WishlistService::class)->isAddedToWishlist($product_id);
                // if confused what the hell this is , its a service class, read docs
            }
        }
    // WISHLIST END
    
    
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


    if(!function_exists('getAddressType')){
        function getAddressType($address_type){
            $type_arr = array(
                "1" => "Home",
                "2" => "Office",
                "3" => "Other"
            );
            return $type_arr[$address_type];
        }
    }
    if(!function_exists('getAddressIcon')){
        function getAddressIcon($address_type){
            $type_arr = array(
                "1" => '<i class="fas fa-home text-primary" style="font-size: 1.5rem;"></i>',
                "2" => '<i class="fas fa-building text-info" style="font-size: 1.5rem;"></i>',
                "3" => '<i class="fas fa-map-pin text-warning" style="font-size: 1.5rem;"></i>'
            );
            return $type_arr[$address_type];
        }
    }

    if(!function_exists('getAddressCategory')){
        function getAddressCategory($address_category){
            $cat_arr = array(
                "1" => "Shipping",
                "2" => "Billing",
            );
            return $cat_arr[$address_category];
        }
    }


    // GENERATE RANDOM CODE
        // returns a 6 digit numeric code
        // function generateSixDigitCode(): int{
        //     return random_int(100000, 999999);
        // }

        // returns a 6 digit numeric code that can lead with 0 aswell
        function generateSixDigitCode(): string{
            return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        }

        // function generateNumericCode(int $digits = 6): int{
        //     // Enforce min/max boundaries
        //     $digits = max(3, min(8, $digits));

        //     $min = (int) str_repeat('1', 1) . str_repeat('0', $digits - 1); // e.g., 100000 for 6 digits
        //     $max = (int) str_repeat('9', $digits);                          // e.g., 999999 for 6 digits

        //     return random_int($min, $max);
        // }

        // returns a 6 digit alpha-numeric code
        // function generateAlphanumericCode(int $length = 6): string{
        //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //     $code = '';

        //     for ($i = 0; $i < $length; $i++) {
        //         $code .= $characters[random_int(0, strlen($characters) - 1)];
        //     }
        //     return $code;
        // }
    // GENERATE RANDOM CODE END



    
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


    // Logging data
        // $log_data = [
        //     // "product_list" => $product_list,
        //     "sql_query" => $sql_query,
        //     "sql_str_binding" => $sql_str_binding,
        // ];

        // \Log::info("Product List Data:", $log_data);
    // Logging data