<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;    //to have the current HTTP request automatically injected into your route callback

use App\Http\Controllers\FrontEnd\home\HomeController;
use App\Http\Controllers\FrontEnd\product\ProductPageController;
use App\Http\Controllers\FrontEnd\cart\CartController;
use App\Http\Controllers\FrontEnd\wishlist\WishlistController;

use App\Http\Controllers\FrontEnd\profile\ProfileController;

use App\Mail\WelcomeMail;
// use Illuminate\Support\Facades\Artisan;  // TO Run migrations without shell via route (DID NOT WORK)

// Route::get('/', function () {
//     return view('welcome');
// });

define('FRONT_END', "front-end");

define('ADMIN_PANEL', "admin-panel");

define('ADMIN_LTE', "XAdminLTE");




// FRONT-END END

    // Route::get('/', function () {
    //     return view(FRONT_END.'/home');
    // });
    // Route::get('home', function (Request $request) {
    //     // return view(FRONT_END.'/home');
    //     return View::make(FRONT_END.'/home');
    // });
    // Route::view('home', FRONT_END.'/home')->name('home');
    
    // HOME
        Route::get('/', [HomeController::class, 'CREATE']);
        Route::get('home', [HomeController::class, 'CREATE'])->name('home');

        // CAROUSEL
            Route::get('get-banner-carousel', [HomeController::class, 'GET_BANNER_CAROUSEL'])->name('get-banner-carousel');
        // CAROUSEL END

        // GET FEATURED CATEGORIES
            Route::get('get-featured-category', [HomeController::class, 'GET_FEATURED_CATEGORIES'])->name('get-featured-category');
            Route::get('get-remaining-featured-category', [HomeController::class, 'GET_REMAINING_FEATURED_CATEGORIES']);
        // GET FEATURED CATEGORIES END

        // GET FEATURED CATEGORIES
            Route::get('get-featured-products', [HomeController::class, 'GET_FEATURED_PRODUCTS']);
        // GET FEATURED CATEGORIES END

    // HOME END

    // CATEGORY
        // Route::get('/category', function (Request $request) {
        //     return view(FRONT_END.'/category');
        // });
        Route::get('/category/{category_slug}', function (string $category_slug) {
            return view(FRONT_END.'/category', ['category_slug' => $category_slug]);
        })->name("category");
    // CATEGORY END

    // PRODUCT
        // Route::get('/product/{product_slug}', function (string $product_slug) {
        //     return view(FRONT_END.'/product', ['product_slug' => $product_slug]);
        // })->name('product');

        Route::get('/product/{product_slug}', [ProductPageController::class, 'INDEX'])->name('product');
        
        // Route::get('get-color-attribute', [ProductPageController::class, 'get_variant_attribute']); //API
        Route::get('/get-color-attribute', [ProductPageController::class, 'get_variant_attribute'])->name('get-color-attribute'); //API
    // PRODUCT END

    
    // AUTH MIDDLEWARE
        Route::middleware(['auth'])->group(function(){
            // PROFILE
                Route::get('/profile', [ProfileController::class, 'INDEX'])->name('profile');
                
                Route::get('/profile2', function () {
                    return view(FRONT_END.'/profile.profile-copy');
                });
            // PROFILE END

            // ACCOUNT
                // Route::get('/account/{profile}', function () {
                //     return view(FRONT_END.'/account');
                // });
            // ACCOUNT END

            // WISHLIST
                Route::get('/wishlist', function () {
                    return view(FRONT_END.'/Wishlist');
                });

                
            // WISHLIST END
        });
    // AUTH MIDDLEWARE END
    
    // PROFILE
        Route::post('/add-address', [ProfileController::class, 'STORE_ADDRESS'])->name("add-address");
        Route::post('/edit-profile', [ProfileController::class, 'EDIT_PROFILE'])->name("edit-profile");
        Route::get('/toggle-default-address', [ProfileController::class, 'TOGGLE_DEFAULT_ADDRESS'])->name("toggle-default-address");
        Route::get('/remove-saved-address', [ProfileController::class, 'REMOVE_SAVED_ADDRESS'])->name("remove-saved-address");
        Route::post('/generate-email-verification-code', [ProfileController::class, 'GENERATE_EMAIL_VERIFICATION_CODE'])->name("generate-email-verification-code");
    // PROFILE END

    // ORDERS
        Route::get('/orders', function () {
            return view(FRONT_END.'/orders');
        });
    // ORDERS END

    // CART
        Route::middleware(['auth'])->group(function(){
            Route::get('/cart', [CartController::class, 'INDEX']);
        });

        Route::post('/add-to-cart', [CartController::class, 'STORE'])->name('add-to-cart');
        Route::get('/remove-cart-item', [CartController::class, 'DELETE'])->name('remove-cart-item');
        Route::get('/cart-update-item-qty', [CartController::class, 'UPDATE'])->name('cart-update-item-qty');
    // CART END

    // Wishlist (without middleware)
        Route::get('/add-to-wishlist', [WishlistController::class, 'STORE'])->name('add-to-wishlist');
        Route::get('/remove-from-wishlist', [WishlistController::class, 'DELETE'])->name('remove-from-wishlist');
    // Wishlist (without auth middleware) END



    // CHECKOUT
        Route::get('/checkout', function () {
            return view(FRONT_END.'/checkout');
        });
    // CHECKOUT END

    // SEND TEST MAIL
        Route::get('/send-welcome-mail', function () {
            Mail::to('amritlekhuppal999@gmail.com')->send(new WelcomeMail());
        });
    // SEND TEST MAIL END

    
    // FRONT-END   END

    // SESSION TEST
    Route::get('/session-test', function () {
        session(['test_key' => 'hello']);

        if(env('APP_ENV') == "local"){
            // return [
            //   'id' => session()->getId(),
            //   'value' => session('test_key'),
            //   'csrf_token' => csrf_token()
            // ];
            return session()->all();
        }

        return "sry bro, you can't see...";
    });


    // TO Run migrations without shell via route (DID NOT WORK)
    // Route::get('/run-migrations', function () {
    //     Artisan::call('config:clear');
    //     Artisan::call('cache:clear');
    //     Artisan::call('config:cache');
    //     Artisan::call('migrate', ['--force' => true]);
    //     return nl2br(Artisan::output());
    // });
    
    
    require __DIR__.'/user-auth.php';
    require __DIR__.'/admin-auth.php';
    require __DIR__.'/admin-routes.php';
    
    


Route::fallback(function () {
    // return response()->view('errors.404', [], 404);

    $data_arr = [
        "error_message" => "We could not find the page you were looking for. Please enter a valid URL."
    ];

    return view(FRONT_END.'/404', $data_arr);
}); 