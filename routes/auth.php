<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// echo "WTF MAN";
// exit();

// LOGIN REGISTER FORGOT PASSWORD
    // Route::get('/login', function () {
    //     return view(FRONT_END.'/layouts/login');
    // });
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login-user');
    
    // Route::get('/register', function () {
    //     return view(FRONT_END.'/layouts/register');
    // });
    Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [RegisterController::class, 'register'])->name('register-user');

    Route::get('/forgot-password', function () {
        return view(FRONT_END.'/layouts/forgot-password');
    });
// LOGIN REGISTER FORGOT PASSWORD END


// LOGOUT ROUTE
    Route::get('/logout', [LoginController::class, 'logout']);
// LOGOUT ROUTE


