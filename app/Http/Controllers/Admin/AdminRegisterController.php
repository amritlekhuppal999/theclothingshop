<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class AdminRegisterController extends Controller
{
    //To return login page view
    public function REGISTER_PAGE()
    {
        return view('layouts/register');
    }


    public function REGISTER_ADMIN(Request $request): RedirectResponse
    {
        
        try {
            $credentials = $request->validate([
                "fullName" => ["required", "string", "max:255"],
                "email" => ["required", "email", "max:255", "unique:users,email"],
                'phone_no' => ['required', 'string', 'regex:/^[0-9\-\+\(\)\s]{7,20}$/', "unique:users,phone_no"],
                // "phone_no" => ["required", "integer", "unique:users,phone_no"],
                "password" => ['required', 'min:8', 'confirmed']
            ]);
    
            $insert_data = array(
                "user_id" => (string) Str::uuid(),
                "role" => 3,
                "name" => $request->fullName,
                "email" => $request->email,
                "phone_no" => $request->phone_no,
                "password" => $request->password,
                "status" => 1,
            );
    
            // the $user variable will get the id of the record creataed.
            $user = User::create($insert_data);
    
            if($user){
                // Auth::login($user);
                Auth::guard('admin')->login($user);

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

                // maybe add some events to send email or such
                return redirect()->route('dashboard');
            }
    
            // return back()->withErrors([
            //     "error" => "Registration Failed, try again later."
            // ]);
            return redirect()->back()->withErrors(['error'=> 'Registration Failed, try again later. '])->withInput();
        } 
        catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                    'error'=> 'Unable to register, try again later. ',
                    'exception_msg' => $th->getMessage()
                ])->withInput();
        }
        catch (QueryException $e) {
            return redirect()->back()->withErrors([
                    'error'=> 'DB error. Unable to register. ',
                    'exception_msg' => $e->getMessage()
                ])->withInput();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors([
                    'error'=> 'Something went wrong. Try again later. ',
                    'exception_msg' => $e->getMessage()
                ])->withInput();
        }
        // catch (ValidationException $e) {
        //     return redirect()->back()->withErrors([
        //             'error'=> 'Validation Error, Unable to register. ',
        //             'exception_msg' => $e->getMessage()
        //         ])->withInput();
        // }
        
    }
}
