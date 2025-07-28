<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// echo "WTF MAN";
// exit();

// Route::middleware(['set_session'])->group(function (){});

// LOGIN REGISTER FORGOT PASSWORD
    // Route::get('/login', function () {
    //     return view(FRONT_END.'/layouts/login');
    // });
    
    Route::get('/login', [LoginController::class, 'CREATE'])->name('login');
    Route::post('/login', [LoginController::class, 'AUTHENTICATE'])->name('login-user');
    
    // Route::get('/register', function () {
    //     return view(FRONT_END.'/layouts/register');
    // });
    Route::get('/register', [RegisterController::class, 'CREATE'])->name('resgister');
    Route::post('/register', [RegisterController::class, 'REGISTER'])->name('register-user');

    Route::get('/forgot-password', function () {
        return view(FRONT_END.'/layouts/forgot-password');
    });
// LOGIN REGISTER FORGOT PASSWORD END


// LOGOUT ROUTE
    Route::get('/logout', [LoginController::class, 'logout']);
// LOGOUT ROUTE



