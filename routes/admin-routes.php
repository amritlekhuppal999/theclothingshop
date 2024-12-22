<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Attribute\AttributeController;

Route::prefix('admin')->group(function () {
    
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

        Route::get('/category', [CategoryController::class, 'showCategoryView']);
        Route::get('/category-add', [CategoryController::class, 'showAddCategoryForm']);
        Route::post('/category-add', [CategoryController::class, 'showAddCategoryForm'])->name('add-category');
        Route::get('/sub-category', [CategoryController::class, 'showSubCategoryView']);
        Route::get('/sub-category/{catgorySlug}', [CategoryController::class, 'showSubCategoryView']);

    // CATEGORY Routes END

    
    // Attribute Routes

        Route::get('/attribute', [AttributeController::class, 'showAttributeView']);
        
        Route::get('/attribute-add', [AttributeController::class, 'showAddAttributeForm']);
        Route::post('/attribute-add', [AttributeController::class, 'store'])->name('add-attribute');

        Route::get('/attribute-update/{attributeId}', [AttributeController::class, 'showUpdateAttributeForm']);
        
    // Attribute Routes END






    Route::fallback(function () {
        // return response()->view('errors.404', [], 404);

        $data_arr = [
            "error_message" => "We could not find the page you were looking for. Please enter a valid URL."
        ];

        return view(ADMIN_PANEL.'/404', $data_arr);
    });    

});