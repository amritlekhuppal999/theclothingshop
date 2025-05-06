<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRegisterController extends Controller
{
    //To return login page view
    public function REGISTER_PAGE()
    {
        return view('layouts/register');
    }
}
