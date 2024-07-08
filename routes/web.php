<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\View;

// Route::get('/', function () {
//     return view('welcome');
// });

define('FRONT_END', "front-end");

define('ADMIN_LTE', "XAdminLTE");


Route::get('/', function () {
    return view(FRONT_END.'/home');
});
// Route::get('home', function () {
//     // return view(FRONT_END.'/home');
//     return View::make(FRONT_END.'/home');
// });
Route::view('home', FRONT_END.'/home');


