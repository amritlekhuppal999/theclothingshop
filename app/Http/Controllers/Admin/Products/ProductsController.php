<?php

namespace App\Http\Controllers\Admin\Products;

//use App\Services\CategoryService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;

use App\Models\SubProduct;      //ProductVariant
use App\Models\AttributeMapper;

use Illuminate\Support\Facades\DB;      // to use transactions
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductsController extends Controller
{

    private $products_route = 'admin-panel/products/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    // PRODUCT
        // view to see added products table
        public function INDEX(Request $request){

            $total_products_added = Product::count();
            $inventory = SubProduct::sum('stock');
            $out_of_stock = SubProduct::where('stock', 0)->count();

            $limit = ($request->has("limit")) ? $request->query("limit") : 10 ;
            $search_keyword = ($request->has("search_keyword")) ? $request->query("search_keyword") : "" ;

            $product_list = Product::when($request->has("search_keyword"), function($query) use($request){
                                $search_keyword = $request->query("search_keyword");
                                return $query->where('product_name', 'like', '%'.$search_keyword.'%')
                                            ->orWhere('product_slug', 'like', '%'.$search_keyword.'%')
                                            ->orWhere('short_description', 'like', '%'.$search_keyword.'%')
                                            ->orWhere('long_description', 'like', '%'.$search_keyword.'%');
                            })
                            ->paginate($limit)->withQueryString();

            // foreach ($product_list as $products) {
            //     $products["target_group"] = $this->return_gender($products["target_group"]);
            // }
            
            // This does exactly what is being done in the above loop but maintaining the pagination and laravel logic.
            $product_list->getCollection()->transform(function ($product) {
                $product->target_group = $this->return_gender($product->target_group);
                return $product;
            });

            $return_data = array(
                "product_list" => $product_list,
                "search_keyword" => $search_keyword,
                "total_products_added" => $total_products_added,
                "inventory" => $inventory,
                "out_of_stock" => $out_of_stock
            );
            
            return view($this->products_route.'products', $return_data);
        }

        // add product form view
        public function CREATE(Request $request){
            
            $category_slug = $request->query('cat');
            $sub_category_slug = $request->query('sub_cat');

            $return_data = array(
                "category_slug" => $category_slug,
                "sub_category_slug" => $sub_category_slug
            );
            return view($this->products_route.'add-products', $return_data);
        }

        // Save Category
        public function STORE(Request $request){
            // Validate the incoming data
            $request->validate([
                'targetGroup' => 'required|integer',
                'product_name' => 'required|string|max:255',
                'product_slug' => 'required|string|unique:products,product_slug',
                'category_id' => 'integer',
                'sub_category_id' => 'integer',
                'base_price' => 'required|numeric|min:1|max:100000',
                'discount_percentage' => 'required|numeric|min:0.01',
                'short_description' => 'string|max:1000',
                'long_description' => 'string|max:65535',
            ]);

            try{

                // Save the data in the database
                $product_data = Product::create([
                    'product_name' => $request->product_name,
                    'product_slug' => $request->product_slug,
                    'target_group' => $request->targetGroup,
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'base_price' => $request->base_price,
                    'discount_percentage' => $request->discount_percentage,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'status' => 1
                ]);

                // if($category){
                //     // Redirect with a success message
                //     return redirect()->back()->with('success', 'Category added successfully!');
                // }
                // else {
                //     return back()->withErrors([ "error" => "Failed to add the category." ]);
                //     // return redirect()->back()->with('error', 'Failed to add the attribute.');
                // }

                return redirect()->back()->with('success', 'Product added successfully!');
            }
            catch(QueryException $e){
                return redirect()->back()->with('error', 'Failed to add product details: ' . $e->getMessage());
                // return redirect()->back()->with('error', 'An error occurred: ');
            }
            catch(Exception $e){   // General Error
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
                // return redirect()->back()->with('error', 'An error occurred: ');
            }
            

            // Redirect with a success message
            // return redirect()->back()->with('success', 'Data has been saved successfully!');
        }
        
        // UDPATE product form view
        public function CREATE_UPDATE(Request $request, $productSlug){
            
            if(!empty($productSlug)){  // $request->has("ps")
                //$productSlug = $request->query("ps");

                try {
                    $product = Product::where('product_slug', $productSlug)->firstOrFail();
                    $product = Product::where('product_slug', $productSlug)->get();

                    $return_data = array(
                        "product_selected" => true,
                        "product" => $product[0]
                    );
                }
                catch (ModelNotFoundException $e) {
                    $return_data = [
                        "product_selected" => false,
                        "product" => [],
                        "message" => "No product present for the given product slug: " . $e->getMessage(),
                        // "requested_action_performed" => false,
                        // "reload" => false
                    ];
                }
                catch (\Throwable $th) {
                    $return_data = [
                        "product_selected" => false,
                        "product" => [],
                        "message" => "Something went wrong " . $th->getMessage(),
                        // "requested_action_performed" => false,
                        // "reload" => false
                    ];
                }

                return view($this->products_route.'update-products', $return_data);
            }

            else {
                # code...

                $return_data = array(
                    "product_selected" => false,
                    "message" => "Product not selected."
                );
                
                return view($this->VIEW_NOT_FOUND, $return_data);
            }

        }

        // Save Category
        public function STORE_UPDATE(Request $request){

            try{

                $validation_arr = [
                    'targetGroup' => 'required|integer',
                    'product_name' => 'required|string|max:255',
                    // 'product_slug' => 'required|string|unique:products,product_slug',
                    'category_id' => 'integer',
                    'sub_category_id' => 'integer',
                    'base_price' => 'required|numeric|min:1|max:100000',
                    'discount_percentage' => 'required|numeric|min:0.01',
                    'short_description' => 'string|max:1000',
                    'long_description' => 'string|max:65535',
                ];
    
                if($request->product_slug !== $request->product_slug_backup){
                    $validation_arr['product_slug'] = 'required|string|unique:products,product_slug';
                }
    
                // Validate the incoming data
                $request->validate($validation_arr);

                $product_id = $request->product_id;

                $product = Product::findOrFail($product_id);

                // Save the data in the database
                $product->update([
                    'product_name' => $request->product_name,
                    'product_slug' => $request->product_slug,
                    'target_group' => $request->targetGroup,
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'base_price' => $request->base_price,
                    'discount_percentage' => $request->discount_percentage,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'status' => 1
                ]);

                //return back()->withErrors([ "error" => "Failed to add the category." ]);
                // return redirect()->back()->with('error', 'Failed to add the attribute.');

                // return redirect()->back()->with('success', 'Product added successfully!');

                $url = url('/admin/products-update').'/'.$request->product_slug;
                return redirect($url)->with('success', 'Product updated successfully!');
            }
            catch (ModelNotFoundException $e) {
                return redirect()->back()->with('error', 'No product present for the given product slug');
            }
            catch(QueryException $e){
                return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage());
            }
            catch(\Throwable $th){   // General Error
                return redirect()->back()->with('error', 'Failed to update product. An error occurred: ' . $th->getMessage());
            }
            
        }

        // UDPATE product form view
        public function RESTORE_VIEW($productSlug){
            
            // return view($this->products_route.'udpate-products', ["productSlug" => $productSlug]);
            return view($this->VIEW_NOT_FOUND);
        }

    // PRODUCT END
    
    
    
    
    // PRODUCT IMAGE
        // add image product form
        public function CREATE_IMAGE($productSlug=null){   
            
            $return_data['productSlug'] = $productSlug;
            return view($this->products_route.'add-product-image', $return_data);

        }


        // function to add images
        public function STORE_IMAGE(Request $request){

            $request->validate([
                'product_id' => 'required|integer',
                'primary_img_id' => 'integer'
            ]);

            
            $product_id = $request->product_id;
            $primary_img_id = $request->primary_img_id;
            $image_arr = $request->image_arr;

            define("MAX_FILE_UPLOAD_LIMIT", 5);

            // get total no of images added in a particular category
            $img_count = ProductImage::where("product_id", $product_id)->where("status", 1)->count();

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

                    $path = "images/product/";
                    $filePath = public_path($path. $fileName);
                    file_put_contents($filePath, $decodedImage);
                    $fileUrl = asset($path . $fileName);

                    $some_arr = array(
                        "product_id" => $product_id,
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
                        ProductImage::where("product_id", $product_id)->where("prime_image", 1)->update(["prime_image" => 0]);
                    }
        
                    // Save the data in the database
                    $insert_product_img = ProductImage::insert($insert_image_data);
        
                    if($insert_product_img){
                        // Redirect with a success message
                        // return redirect()->back()->with('success', 'Category Images added successfully!');
                        return [
                            "type" => "Success",
                            "message" => "Product Images added successfully!",
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
        public function PRODUCT_IMAGE_GALLERY($productID){
            // do the thing with the slug
            
            
            try {
                $productImages = ProductImage::where('product_id', $productID)
                                                ->where('status', 1)
                                                ->select("id as product_img_id", "image_location", "prime_image")
                                                ->get();

                // return ["productImages" => $productImages];

                if (count($productImages)) {
                    # code...
                    return [
                        "type" => "Success",
                        "productImages" => $productImages,
                        "message" => "",
                        "requested_action_performed" => true,
                        "reload" => false
                    ];
                }
                else {
                    return [
                        "type" => "Failure",
                        "productImages" => $productImages,
                        "message" => "No images added.",
                        "requested_action_performed" => false,
                        "reload" => false
                    ];
                }

            } 
            catch (QueryException $e) {
                
                return [
                    "type" => "Failed",
                    "productImages" => [],
                    "message" => "An error occurred: " . $e->getMessage(),
                    "requested_action_performed" => false,
                    "reload" => false
                ];
            }
            
            // var_dump($productImages);
            // return view($this->category_route.'product-images', ["productSlug" => $categorySlug]);
            // return ["productImages" => $productImages];
            
        }


        public function REMOVE_PRODUCT_IMAGE(Request $request){
            
            $img_id = $request->img_id;

            try {
                $product_image = ProductImage::select("image_location", "prime_image")->where("id", $img_id)->get();
                $image_path = $product_image[0]["image_location"];
                $prime_image = $product_image[0]["prime_image"];

                $filePath = public_path($image_path);

                $delete_opr = ProductImage::where("id", $img_id)->update([
                    "status" => 0
                ]);

                if ($delete_opr) {
                    
                    // To delete the file files and update its status 
                    if (file_exists($filePath) && unlink($filePath)) {

                        ProductImage::where("id", $img_id)->update([
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
            $product_id = $request->product_id;

            try {
                ProductImage::where("product_id", $product_id)->update([ "prime_image" => 0 ]);
                ProductImage::where("id", $img_id)->update([ "prime_image" => 1 ]);

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

    // PRODUCT IMAGE END

    
    
    // Manage Product STOCK
        public function MANAGE_STOCK(Request $request){
                
            return view($this->products_route.'manage-stocks-copy');

        }
    // Manage Product STOCK END
    
    
    // GENRAL PURPOSE FUNCTIONS
        // function to get gender
        public function return_gender($gender_code){
            $gen_arr = array(
                "0" => "Unset",
                "1" => "Male",
                "2" => "Female"
            );

            return $gen_arr[$gender_code];
        }

        
        // function to get product list 
        public function GET_PRODUCT_LIST($options=null){
            /* // Allowed options for query products
            $options = array(
                "product_id" => '',
                "product_slug" => '',
                "category_id" => '',
                "sub_category_id" => '',
                "status" => "",
                "fields" => ["all"]
            );
            */

            $product_list = Product::select('id', 'product_name', 'product_slug')->where('status', 1)->get();
            return ["product_list" => $product_list];
        }
    // GENRAL PURPOSE FUNCTIONS END

    
    
    
    
    // API call
        // SEARCH PRODUCT
            // public function SEARCH_PRODUCT(Request $request){

            //     $search_result_component = 'components.admin.search-result.ProductSearchResult';

            //     $search_keyword = $request->query("search_keyword");
                
            //     if( !empty($search_keyword) ){
            //         $search_keyword = $request->query("search_keyword");
            //         $product_list = Product::where('product_name', 'like', '%'.$search_keyword.'%')
            //                     ->orWhere('product_slug', 'like', '%'.$search_keyword.'%')
            //                     ->orWhere('short_description', 'like', '%'.$search_keyword.'%')
            //                     ->orWhere('long_description', 'like', '%'.$search_keyword.'%')
            //                     ->paginate(10);    
            //     }

            //     else{
            //         // $product_list = Product::where('status', 1)->paginate(10);
            //         $product_list = Product::paginate(10);
            //     }

                
            //     foreach ($product_list as $products) {
            //         $products["target_group"] = $this->return_gender($products["target_group"]);
            //     }
                
            //     return view($search_result_component, [ "productList" => $product_list ])->render();
            // }
        // SEARCH PRODUCT END
    // API call END
}
