<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    //To return login page view
    public function showLoginForm()
    {
        return view('front-end/layouts/login');
        // return view(FRONT_END.'/layouts/login');
    }
 
    //Method to LOGIN the User
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ['required', 'string']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            "Auth" => "The provided credentials do not match our records."
        ])->onlyInput('email');
    }


    // Method to LOGOUT user
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}
