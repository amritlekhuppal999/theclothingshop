<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Session\TokenMismatchException;


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
        
        try {
            $credentials = $request->validate([
                "email" => ["required", "email"],
                "password" => ['required', 'string'],
            ]);
    
            // Make sure only admin type can login
    
            if(Auth::guard('admin')->attempt($credentials)){
                $request->session()->regenerate();
    
                $user = Auth::guard('admin')->user();
                session([
                    'admin.name' => $user->name,
                    'admin.email' => $user->email,
                    'admin.phone_no' => $user->phone_no,
                    'admin.role' => $user->role,
                    'admin.UUID' => $user->user_id,
                    'admin.login_time' => now()->toDateTimeString(),
                ]);
    
                // Access them like this: `session('role');`
    
                return redirect()->intended('dashboard');
            }
    
            return redirect()->back()
                    ->withErrors(['error'=> 'The provided credentials do not match our records. '])
                    ->withInput(['email' => $request->email]);

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
        // catch (ValidationException $e) {
        //     return redirect()->back()->withErrors(['error'=> 'Validation Error, Try again later. '.$e->getMessage()])->withInput();
        // }
        // catch (TokenMismatchException $e){
        //     return redirect()->back()->withErrors([
        //             'error'=> 'Your session expired due to inactivity. Please try again. ',
        //             'exception_msg' => $e->getMessage()
        //         ])->withInput('email');
        // }
    }

    // Method to LOGOUT user
    public function LOGOUT(Request $request): RedirectResponse
    {
        Auth::guard("admin")->logout();
        
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
 
        return redirect('/admin');
    }
}
