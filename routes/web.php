<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;    //to have the current HTTP request automatically injected into your route callback

// Route::get('/', function () {
//     return view('welcome');
// });

define('FRONT_END', "front-end");

define('ADMIN_LTE', "XAdminLTE");




// FRONT-END END

    // HOME
    Route::get('/', function () {
        return view(FRONT_END.'/home');
    });
    // Route::get('home', function (Request $request) {
    //     // return view(FRONT_END.'/home');
    //     return View::make(FRONT_END.'/home');
    // });
    Route::view('home', FRONT_END.'/home')->name('home');

    // CATEGORY
    Route::get('/category', function (Request $request) {
        return view(FRONT_END.'/category');
    });
    Route::get('/category/{category_slug}', function (string $category_slug) {
        return view(FRONT_END.'/category', ['category_slug' => $category_slug]);
    });

    // PRODUCT
    Route::get('/product/{product_slug}', function (string $product_slug) {
        return view(FRONT_END.'/product', ['product_slug' => $product_slug]);
    });

    Route::middleware(['auth'])->group(function(){
        // PROFILE
        Route::get('/profile', function () {
            return view(FRONT_END.'/profile');
        });
        Route::get('/account/{profile}', function () {
            return view(FRONT_END.'/account');
        });

        // WISHLIST
        Route::get('/wishlist', function () {
            return view(FRONT_END.'/Wishlist');
        });
    });

    // ORDERS
    Route::get('/orders', function () {
        return view(FRONT_END.'/orders');
    });

    // CART
    Route::get('/cart', function () {
        return view(FRONT_END.'/cart');
    });

    // CHECKOUT
    Route::get('/checkout', function () {
        return view(FRONT_END.'/checkout');
    });

// FRONT-END   END


require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';
require __DIR__.'/admin-routes.php';

