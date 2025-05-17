<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Session\TokenMismatchException;

class LoginController extends Controller
{
    
    //To return login page view
    public function showLoginForm()
    {
        return view('layouts/login');
        // return view(FRONT_END.'/layouts/login');
    }
 
    //Method to LOGIN the User
    public function authenticate(Request $request): RedirectResponse
    {
        
        try {
            $credentials = $request->validate([
                "email" => ["required", "email"],
                "password" => ['required', 'string']
            ]);
    
            // Facilitate a special account type if an admin decides to login as customer
    
            if(Auth::guard("web")->attempt($credentials)){
                $request->session()->regenerate();
                
                $user = Auth::guard('web')->user();
                session([
                    'web.name' => $user->name,
                    'web.email' => $user->email,
                    'web.phone_no' => $user->phone_no,
                    'web.role' => $user->role,
                    'web.UUID' => $user->user_id,
                    'web.login_time' => now()->toDateTimeString(),
                ]);
    
                // Access them like this: `session('role');`
    
                return redirect()->intended('home');
            }
    
            return back()->withErrors(["error" => "The provided credentials do not match our records."])->onlyInput('email');
            
        } 
        catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                    'error'=> 'Unable to login, try again later. ',
                    'exception_msg' => $th->getMessage()
                ])->withInput(['email' => $request->email]);
        }
        catch (QueryException $e) {
            return redirect()->back()->withErrors([
                    'error'=> 'DB error. Unable to login. ',
                    'exception_msg' => $e->getMessage()
                ])->withInput(['email' => $request->email]);
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors([
                    'error'=> 'Something went wrong. Try again later. ',
                    'exception_msg' => $e->getMessage()
                ])->withInput(['email' => $request->email]);
        }
        // catch (TokenMismatchException $e){
        //     return redirect()->back()->withErrors([
        //             'error'=> 'Your session expired due to inactivity. Please try again. ',
        //             'exception_msg' => $e->getMessage()
        //         ])->withInput('email');
        // }
    }


    // Method to LOGOUT user
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
 
        return redirect('/');
    }
}
