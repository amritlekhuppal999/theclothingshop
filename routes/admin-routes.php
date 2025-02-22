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
        Route::get('/products', [ProductsController::class, 'showProductsView'])->name('products');
        
        
        // Route::get('/products-add', function(){
        //     return view('admin-panel/products/add-products');
        // });
        Route::get('/products-add', [ProductsController::class, 'selectCategoryView']);
        Route::post('/products-add', [ProductsController::class, 'addProduct'])->name('add-product');

        Route::get('/products-add/{subCategorySlug}', [ProductsController::class, 'addProductForm']);
        
        Route::get('/products-add-images', [ProductsController::class, 'addProductImageForm']);
        Route::get('/products-add-images/{productSlug}', [ProductsController::class, 'addProductImageForm']);

        Route::get('/products-add-variants', [ProductsController::class, 'addProductVariantForm']);
        Route::get('/products-add-variants/{productSlug}', [ProductsController::class, 'addProductVariantForm']);


    // PRODUCT Routes END


    // CATEGORY Routes

        Route::get('/category', [CategoryController::class, 'INDEX']);
        Route::get('/category-add', [CategoryController::class, 'CREATE']);
        Route::post('/category-add', [CategoryController::class, 'STORE'])->name('add-category');
        
        Route::get('/category-images/{categorySlug?}', [CategoryController::class, 'IMAGE_GALLERY']);
        Route::get('/category-images-add/{categorySlug?}', [CategoryController::class, 'IMAGE_GALLERY']);
        
        Route::post('/category-images-add', [CategoryController::class, 'ADD_IMAGE'])->name('add-category-images');
        
        Route::get('/category-edit/{categorySlug}', [CategoryController::class, 'EDIT']);
        Route::post('/category-update/', [CategoryController::class, 'UPDATE'])->name('update-category');
        Route::post('/category-delete/', [CategoryController::class, 'DELETE'])->name('delete-category');

        Route::get('/get-category-list', [CategoryController::class, 'get_category_list']);
        
        Route::get('/sub-category/{catgorySlug?}', [SubCategoryController::class, 'INDEX']);
        Route::get('/sub-category-add/', [SubCategoryController::class, 'CREATE']);

        // yes its CATEGORY SLUG HERE DON'T sweat it!!
        Route::get('/sub-category-add/{catgorySlug}', [SubCategoryController::class, 'CREATE']);

        Route::post('/sub-category-add/', [SubCategoryController::class, 'STORE'])->name('add-sub-category');
        Route::post('/sub-category-delete', [SubCategoryController::class, 'DELETE'])->name('delete-sub-category');
        Route::get('/sub-category-edit/{subCategorySlug}', [SubCategoryController::class, 'EDIT']);
        Route::post('/sub-category-update/', [SubCategoryController::class, 'UPDATE'])->name('update-sub-category');

    // CATEGORY Routes END

    
    // Attribute Routes

        Route::get('/attribute', [AttributeController::class, 'showAttributeView']);
        
        Route::get('/attribute-add', [AttributeController::class, 'showAddAttributeForm']);
        Route::post('/attribute-add', [AttributeController::class, 'storeCategory'])->name('add-attribute');

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