<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Products\ProductsController;

Route::prefix('admin')->group(function () {
    
    // Dashboard Routes
    Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('dashboard');
    
    
    // Products Routes
    Route::get('/products', [ProductsController::class, 'showProductsView'])->name('products');
    Route::get('/products-add', [ProductsController::class, 'showAddProducts'])->name('add-products');

});