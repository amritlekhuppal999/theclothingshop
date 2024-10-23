<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RegisterController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('front-end/layouts/register');
        // return view(FRONT_END.'/layouts/login');
    }

    public function register(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "fullName" => ["required", "string", "max:255"],
            "email" => ["required", "email", "max:255", "unique:users"],
            "password" => ['required', 'min:8', 'confirmed']
        ]);

        // the $user variable will get the id of the record creataed.
        $user = User::create($credentials);

        if($user){
            Auth::login($user);
            // maybe add some events to send email or such
            return redirect()->route('home');
        }

        // 
        return back()->withErrors([
            "Failed" => "Unable to register, try again later."
        ]);
    }
}
