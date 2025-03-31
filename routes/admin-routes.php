<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\Attribute\AttributeController;

Route::prefix('admin')->group(function () {


    /*
        NOTE !!!

        Route::get('/category-image/{categorySlug?}', [CategoryController::class, 'IMAGE_GALLERY']);

        Here "?" in the route parameter tells laravel that the parameter is optional
    
    */
    
    // Dashboard Routes
    Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('dashboard');
    
    
    // PRODUCT Routes
        // Route::get('/products-add', function(){
        //     return view('admin-panel/products/add-products');
        // });
        
        Route::get('/products', [ProductsController::class, 'INDEX'])->name('products');
        Route::get('/products-add', [ProductsController::class, 'CREATE']);
        Route::post('/products-add', [ProductsController::class, 'STORE'])->name('add-product');

        // Route::get('/products-add/{subCategorySlug}', [ProductsController::class, 'addProductForm']);
        Route::get('/get-product-images/{productID}', [ProductsController::class, 'PRODUCT_IMAGE_GALLERY']); // API CALL
        
        Route::get('/products-add-images/{productSlug?}', [ProductsController::class, 'CREATE_IMAGE']);
        Route::post('/product-images-update', [ProductsController::class, 'STORE_IMAGE'])->name('update-product-images');
        Route::post('/product-images-remove', [ProductsController::class, 'REMOVE_PRODUCT_IMAGE'])->name('remove-product-images');
        Route::post('/product-images-banner', [ProductsController::class, 'UPDATE_BANNER_IMAGE'])->name('update-product-primary-image');

        Route::get('/products-add-variants/{productSlug?}', [ProductsController::class, 'CREATE_VARIANT']);
        Route::post('/products-add-variants', [ProductsController::class, 'STORE_VARIANT'])->name('add-product-variant');
        
        Route::get('/get-product-list', [ProductsController::class, 'GET_PRODUCT_LIST']);     // API CALL


    // PRODUCT Routes END


    // CATEGORY Routes

        Route::get('/category', [CategoryController::class, 'INDEX']);
        Route::get('/category-add', [CategoryController::class, 'CREATE']);
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
        
        
    // SUB-CATEGORY Routes
        Route::get('/sub-category-images/{categorySlug?}', [SubCategoryController::class, 'IMAGE_GALLERY_INDEX']);
        Route::get('/get-sub-category-images/{subCategoryID}', [SubCategoryController::class, 'SUB_CATEGORY_IMAGE_GALLERY']); // API CALL

        Route::get('/sub-category-images-update/{subCategorySlug?}', [SubCategoryController::class, 'ADD_IMAGE_INDEX']);
        // Route::post('/sub-category-images-update', [CategoryController::class, 'ADD_IMAGE'])->name('add-sub-category-images');
        Route::post('/sub-category-images-update', [SubCategoryController::class, 'UPDATE_IMAGE'])->name('update-sub-category-images');
        Route::post('/sub-category-images-remove', [SubCategoryController::class, 'REMOVE_SUB_CATEGORY_IMAGE'])->name('remove-sub-category-images');
        Route::post('/sub-category-images-banner', [SubCategoryController::class, 'UPDATE_BANNER_IMAGE'])->name('update-sub-category-primary-image');
        
        Route::get('/sub-category/{catgorySlug?}', [SubCategoryController::class, 'INDEX']);
        Route::get('/sub-category-add/', [SubCategoryController::class, 'CREATE']);

        // yes its CATEGORY SLUG HERE DON'T sweat it!!
        Route::get('/sub-category-add/{catgorySlug}', [SubCategoryController::class, 'CREATE']);

        Route::post('/sub-category-add/', [SubCategoryController::class, 'STORE'])->name('add-sub-category');
        Route::post('/sub-category-delete', [SubCategoryController::class, 'DELETE'])->name('delete-sub-category');
        Route::get('/sub-category-edit/{subCategorySlug}', [SubCategoryController::class, 'EDIT']);
        Route::post('/sub-category-update/', [SubCategoryController::class, 'UPDATE'])->name('update-sub-category');

        Route::get('/get-sub-category-list/{categoryID?}', [SubCategoryController::class, 'get_sub_category_list']); //API CALL

    // SUB-CATEGORY Routes END

    
    // Attribute Routes

        Route::get('/attribute', [AttributeController::class, 'INDEX']);
        
        Route::get('/attribute-add', [AttributeController::class, 'CREATE']);
        Route::post('/attribute-add', [AttributeController::class, 'STORE'])->name('add-attribute');
        
        Route::get('/attribute-value-add', [AttributeController::class, 'CREATE_VAL']);
        Route::post('/attribute-value-add', [AttributeController::class, 'STORE_VAL'])->name('add-attribute-value');
        Route::get('/get-attribute-list', [AttributeController::class, 'get_attribute_list']);  // API CALL
        Route::get('/get-attribute-values/{attribute_id?}', [AttributeController::class, 'get_attribute_values']);  // API CALL


        Route::get('/attribute/{attributeId}/edit/', [AttributeController::class, 'edit']);
        Route::post('/attribute-update/', [AttributeController::class, 'update'])->name('update-attribute');
        Route::post('/attribute-delete/', [AttributeController::class, 'delete'])->name('delete-attribute');
        
    // Attribute Routes END






    Route::fallback(function () {
        // return response()->view('errors.404', [], 404);

        $data_arr = [
            "error_message" => "We could not find the page you were looking for. Please enter a valid URL."
        ];

        return view(ADMIN_PANEL.'/404', $data_arr);
    });    

});