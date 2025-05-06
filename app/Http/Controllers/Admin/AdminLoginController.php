<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    //To return login page view
    public function LOGIN_PAGE()
    {
        return view('layouts/login');
        // return view(FRONT_END.'/layouts/login');
    }


    //Method to LOGIN the User
    public function authenticateAdmin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ['required', 'string']
        ]);

        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('admin.dashboard');
        }

        return back()->withErrors([
            "Auth" => "The provided credentials do not match our records."
        ])->onlyInput('email');
    }

    // Method to LOGOUT user
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard("admin")->logout();
        
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
 
        return redirect('/admin');
    }
}
