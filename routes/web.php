<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;    //to have the current HTTP request automatically injected into your route callback

// Route::get('/', function () {
//     return view('welcome');
// });

define('FRONT_END', "front-end");

define('ADMIN_LTE', "XAdminLTE");


Route::get('/', function () {
    return view(FRONT_END.'/home');
});
// Route::get('home', function (Request $request) {
//     // return view(FRONT_END.'/home');
//     return View::make(FRONT_END.'/home');
// });
Route::view('home', FRONT_END.'/home');

Route::get('/category', function (Request $request) {
    return view(FRONT_END.'/category');
});
Route::get('/category/{category_slug}', function (string $category_slug) {
    return view(FRONT_END.'/category', ['category_slug' => $category_slug]);
});

Route::get('/product/{product_slug}', function (string $product_slug) {
    return view(FRONT_END.'/product', ['product_slug' => $product_slug]);
});

Route::get('/profile', function () {
    return view(FRONT_END.'/profile');
});
Route::get('/account/{profile}', function () {
    return view(FRONT_END.'/account');
});
Route::get('/orders', function () {
    return view(FRONT_END.'/orders');
});

Route::get('/wishlist', function () {
    return view(FRONT_END.'/Wishlist');
});
Route::get('/cart', function () {
    return view(FRONT_END.'/cart');
});
Route::get('/checkout', function () {
    return view(FRONT_END.'/checkout');
});


