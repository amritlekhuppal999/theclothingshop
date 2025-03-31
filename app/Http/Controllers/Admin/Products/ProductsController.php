<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;

use App\Models\SubProduct;      //ProductVariant
use App\Models\AttributeMapper;

use Illuminate\Support\Facades\DB;      // to use transactions
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{

    private $products_route = 'admin-panel/products/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    // view to see added products table
    public function INDEX()
    {
        return view($this->products_route.'products');
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

    
    public function CREATE_VARIANT($productSlug=null){   
        $return_data['productSlug'] = $productSlug;
        return view($this->products_route.'add-product-variant', $return_data);

    }


    // function to add Variants 
    public function STORE_VARIANT(Request $request){

        // validate input
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'variant_name' => 'required|string|max:255',
            'variant_slug' => 'required|string|max:255|unique:sub_products,variant_slug',
            'sku' => 'required|string|max:255|unique:sub_products,sku',
            'price' => 'required|numeric|min:1|max:100000',
            'quantity' => 'required|integer|min:0'
        ]);

        if($validator->fails()){
            // This makes it more structured
            return response()->json([
                "type" => "Failed",
                "message" => "Unable to add this variant",
                "errors" => $validator->errors()->all(),
                "requested_action_performed" => false,
                "reload" => false
            ], 422);
        }

        // check for attribute values
        if(count($request->attribute_pair) === 0 || !isset($request->attribute_pair)){
            return response()->json([
                "type" => "Failed",
                "message" => "Attributes field must not be empty!!",
                "errors" => null,
                "requested_action_performed" => false,
                "reload" => false
            ], 400);
        }

        DB::beginTransaction();

        // DB operation to add the image file locations to the database
        try{
            $attr_mapper_arr = [];

            $insertVariant = SubProduct::create([
                "product_id" => $request->product_id,
                "variant_name" => $request->variant_name,
                "variant_slug" => $request->variant_slug,
                "sku" => $request->sku,
                "price" => $request->price,
                "stock" => $request->quantity,
                "status" => 1
            ]);

            $last_inserted_variant_id = $insertVariant->id;
            
            foreach ($request->attribute_pair as $att_obj) {
                $att_data_arr = array(
                    "attribute_value_id" => $att_obj["attribute_value_id"],
                    "variant_id" => $last_inserted_variant_id
                );
                
                array_push($attr_mapper_arr, $att_data_arr);
            }
            
            $insertAttrMapper = AttributeMapper::insert($attr_mapper_arr);

             // Commit the transaction if everything is successful
            DB::commit();
            
            // This makes it more structured
            return response()->json([
                "type" => "Success",
                "message" => "Variant added successfully!",
                "requested_action_performed" => true,
                "reload" => false
            ], 200);

            // Laravel automatically converts arrays to JSON, but it does not allow setting custom HTTP status codes.
        }
        catch(\Exception $e){   // General Error
            // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            DB::rollBack(); 

            // This makes it more structured
            return response()->json([
                "type" => "Failed",
                //"message" => "An unexpected error occurred. Try again in sometime.",
                "message" => "Not your fault, we messed up. Try again in sometime.",
                "errors" => $e->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ], 500);
        }
        catch(\Error $e){

            DB::rollBack(); 
            return response()->json([
                "type" => "Failed",
                "message" => "Unable to add Variant!",
                "errors" => $e->getMessage(),
                "requested_action_performed" => false,
                "reload" => false
            ], 500);
        }

    }
    // TAGS: xhrRequest, ASYNC, Handling validation, USE THIS

    
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
}
