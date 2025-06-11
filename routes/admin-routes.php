<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Products\FeatureProductController;
use App\Http\Controllers\Admin\Products\SubProductsController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\Attribute\AttributeController;
use App\Http\Controllers\Admin\Banner\BannerController;

use App\Http\Controllers\Admin\AdminLoginController;

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {


    /*
        NOTE !!!

        Route::get('/category-image/{categorySlug?}', [CategoryController::class, 'IMAGE_GALLERY']);

        Here "?" in the route parameter tells laravel that the parameter is optional
    
    */
    
    // Dashboard Routes
    Route::get('/', [AdminDashboardController::class, 'INDEX'])->name('dashboard');
    Route::get('dashboard', [AdminDashboardController::class, 'INDEX'])->name('dashboard');
    
    
    // PRODUCT Routes
        // Route::get('/products-add', function(){
        //     return view('admin-panel/products/add-products');
        // });
        
        Route::get('/products', [ProductsController::class, 'INDEX'])->name('products');
        Route::get('/products-add', [ProductsController::class, 'CREATE'])->name('products-add');
        Route::post('/products-add', [ProductsController::class, 'STORE'])->name('add-product');
        Route::post('/products-update', [ProductsController::class, 'STORE_UPDATE'])->name('update-product');
        
        Route::get('/products-update/{productSlug}', [ProductsController::class, 'CREATE_UPDATE'])->name('products-update');
        Route::get('/product-restore/{productSlug}', [ProductsController::class, 'RESTORE_VIEW'])->name('restore-product');
        
        Route::get('/products-stock/', [ProductsController::class, 'MANAGE_STOCK']);

        // FEATURE PRODUCTS
            Route::get('/featured-products-view', [FeatureProductController::class, 'INDEX'])->name("featured-products-view");

            Route::get('/featured-products-add', [FeatureProductController::class, 'CREATE_FEATURED_PRODUCTS'])->name("feature-product-form");
            Route::post('/add-featured-product', [FeatureProductController::class, 'STORE_FEATURED_PRODUCTS'])->name("add-featured-product");

        // FEATURE PRODUCTS END
        

        // Product Images
            Route::get('/products-add-images/{productSlug?}', [ProductsController::class, 'CREATE_IMAGE'])->name('products-add-images');
            Route::post('/product-images-update', [ProductsController::class, 'STORE_IMAGE'])->name('update-product-images');
            Route::post('/product-images-remove', [ProductsController::class, 'REMOVE_PRODUCT_IMAGE'])->name('remove-product-images');
            Route::post('/product-images-banner', [ProductsController::class, 'UPDATE_BANNER_IMAGE'])->name('update-product-primary-image');
        // Product Images END

        // VARIANTS
            Route::get('/products-variants/{productSlug?}', [SubProductsController::class, 'VARIANT_INDEX'])->name('products-variants');
            Route::get('/products-add-variants/{productSlug?}', [SubProductsController::class, 'CREATE_VARIANT'])->name("products-add-variants");
            Route::post('/products-add-variants', [SubProductsController::class, 'STORE_VARIANT'])->name('add-product-variant');

            Route::get('/variants-update/{subProductSlug}', [SubProductsController::class, 'CREATE_VARIANT_UPDATE'])->name('variants-update');
            Route::post('/variants-update/', [SubProductsController::class, 'STORE_VARIANT_UPDATE'])->name('update-variant');
            Route::post('/sub-product-action', [SubProductsController::class, 'VARIANT_ACTIONS'])->name('sub-product-action');
            
            Route::post('/variant-stock-update', [SubProductsController::class, 'UPDATE_VARIANT_STOCK'])->name('update-variant-stock');

            // Variant image
                Route::get('/variants-add-images/{subProductSlug?}', [SubProductsController::class, 'CREATE_VARIANT_IMAGE'])->name('variants-add-images');
            // Variant image END
        // VARIANTS END
        
        
        // API CALLS
            //Route::get('/search-product', [ProductsController::class, 'SEARCH_PRODUCT']);     // API CALL
            Route::get('/get-product-list', [ProductsController::class, 'GET_PRODUCT_LIST']);     // API CALL
            Route::get('/get-variant-list', [SubProductsController::class, 'GET_VARIANT_LIST']);     // API CALL
            Route::get('/get-variant-stock', [SubProductsController::class, 'GET_VARIANT_STOCK']);     // API CALL
            Route::get('/get-product-images/{productID}', [ProductsController::class, 'PRODUCT_IMAGE_GALLERY']); // API CALL
        // API CALLS END


    // PRODUCT Routes END


    // CATEGORY Routes

        Route::get('/category', [CategoryController::class, 'INDEX']);
        Route::get('/category-add', [CategoryController::class, 'CREATE'])->name("add-category");
        Route::post('/category-add', [CategoryController::class, 'STORE'])->name('add-category');
        
        Route::get('/category-images/{categorySlug?}', [CategoryController::class, 'IMAGE_GALLERY_INDEX']);
        Route::get('/get-category-images/{categoryID}', [CategoryController::class, 'CATEGORY_IMAGE_GALLERY']); // API CALL
        
        Route::get('/category-images-update/{categorySlug}', [CategoryController::class, 'UPDATE_IMAGE_INDEX']);
        Route::post('/category-images-update', [CategoryController::class, 'UPDATE_IMAGE'])->name('update-category-images');
        Route::post('/category-images-remove', [CategoryController::class, 'REMOVE_CATEGORY_IMAGE'])->name('remove-category-images');
        Route::post('/category-images-banner', [CategoryController::class, 'UPDATE_BANNER_IMAGE'])->name('update-category-primary-image');

        Route::get('/category-images-add/{categorySlug?}', [CategoryController::class, 'ADD_IMAGE_INDEX']);
        Route::post('/category-images-add', [CategoryController::class, 'ADD_IMAGE'])->name('add-category-images');
        
        Route::get('/category-edit/{categorySlug}', [CategoryController::class, 'EDIT']);
        Route::post('/category-update/', [CategoryController::class, 'UPDATE'])->name('update-category');
        Route::post('/category-delete/', [CategoryController::class, 'DELETE'])->name('delete-category');

        Route::get('/get-category-list', [CategoryController::class, 'get_category_list']); //API CALL
    
    // CATEGORY Routes END


    // Banner Image
        Route::get('/get-banner-images', [BannerController::class, 'GET_BANNER_IMAGES']); 
        Route::get('/update-banner-images', [BannerController::class, 'CREATE_BANNER_IMAGES']); 
        Route::post('/update-banner-images', [BannerController::class, 'UPDATE_BANNER_IMAGES'])->name('update-banner-images');
        Route::post('/set-banner-image', [BannerController::class, 'SET_BANNER_IMAGE'])->name('set-banner-image');
        Route::post('/remove-banner-image', [BannerController::class, 'REMOVE_BANNER_IMAGE'])->name('remove-banner-image');
    // Banner Image END
        
        
    // SUB-CATEGORY Routes
        Route::get('/sub-category-images/{categorySlug?}', [SubCategoryController::class, 'IMAGE_GALLERY_INDEX']);
        Route::get('/get-sub-category-images/{subCategoryID}', [SubCategoryController::class, 'SUB_CATEGORY_IMAGE_GALLERY']); // API CALL

        Route::get('/sub-category-images-update/{subCategorySlug?}', [SubCategoryController::class, 'ADD_IMAGE_INDEX'])->name("subcat-img-up");
        // Route::post('/sub-category-images-update', [CategoryController::class, 'ADD_IMAGE'])->name('add-sub-category-images');
        Route::post('/sub-category-images-update', [SubCategoryController::class, 'UPDATE_IMAGE'])->name('update-sub-category-images');
        Route::post('/sub-category-images-remove', [SubCategoryController::class, 'REMOVE_SUB_CATEGORY_IMAGE'])->name('remove-sub-category-images');
        Route::post('/sub-category-images-banner', [SubCategoryController::class, 'UPDATE_BANNER_IMAGE'])->name('update-sub-category-primary-image');
        
        Route::get('/sub-category/{catgorySlug?}', [SubCategoryController::class, 'INDEX']);
        Route::get('/sub-category-add/', [SubCategoryController::class, 'CREATE'])->name("sub-category-add");

        // yes its CATEGORY SLUG HERE DON'T sweat it!!
        Route::get('/sub-category-add/{catgorySlug}', [SubCategoryController::class, 'CREATE']);

        Route::post('/sub-category-add/', [SubCategoryController::class, 'STORE'])->name('add-sub-category');
        Route::post('/sub-category-delete', [SubCategoryController::class, 'DELETE'])->name('delete-sub-category');
        Route::get('/sub-category-edit/{subCategorySlug}', [SubCategoryController::class, 'EDIT']);
        Route::post('/sub-category-update/', [SubCategoryController::class, 'UPDATE'])->name('update-sub-category');

        Route::get('/get-sub-category-list/{categoryID?}', [SubCategoryController::class, 'get_sub_category_list']); //API CALL
        Route::get('/get-collections', [SubCategoryController::class, 'GET_COLLECTIONS']); //API CALL

    // SUB-CATEGORY Routes END

    
    // Attribute Routes

        Route::get('/attribute', [AttributeController::class, 'INDEX']);
        
        Route::get('/attribute-add', [AttributeController::class, 'CREATE'])->name("attribute-add");
        Route::post('/attribute-add', [AttributeController::class, 'STORE'])->name('add-attribute');
        
        Route::get('/attribute-value-add', [AttributeController::class, 'CREATE_VAL']);
        Route::post('/attribute-value-add', [AttributeController::class, 'STORE_VAL'])->name('add-attribute-value');
        Route::get('/get-attribute-list', [AttributeController::class, 'get_attribute_list']);  // API CALL
        Route::get('/get-attribute-values/{attribute_id?}', [AttributeController::class, 'get_attribute_values']);  // API CALL


        Route::get('/attribute/{attributeId}/edit/', [AttributeController::class, 'edit']);
        Route::post('/attribute-update/', [AttributeController::class, 'update'])->name('update-attribute');
        Route::post('/attribute-delete/', [AttributeController::class, 'delete'])->name('delete-attribute');
        
    // Attribute Routes END

    // LOGOUT ADMIN
    Route::get('/logout', [AdminLoginController::class, 'LOGOUT'])->name('logout-admin');



    Route::fallback(function () {
        // return response()->view('errors.404', [], 404);

        $data_arr = [
            "error_message" => "We could not find the page you were looking for. Please enter a valid URL."
        ];

        return view(ADMIN_PANEL.'/404', $data_arr);
    });    

});