<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function CREATE()
    {
        if (!Auth::guard('web')->check()){
            return view('layouts/register');
        }

        return redirect('home');
    }

    public function REGISTER(Request $request): RedirectResponse
    {
        
        try {
            $credentials = $request->validate([
                "fullName" => ["required", "string", "max:255"],
                "email" => ["required", "email", "max:255", "unique:users"],
                "password" => ['required', 'min:8', 'confirmed']
            ]);
    
            $insert_data = array(
                "user_id" => (string) Str::uuid(),
                "role" => 1,
                "name" => $request->fullName,
                "email" => $request->email,
                "phone_no" => $request->phone_no,
                "password" => $request->password,
                "status" => 1,
            );
    
            // the $user variable will get the id of the record creataed.
            $user = User::create($insert_data);
    
            if($user){
                Auth::guard("web")->login($user);

                $user = Auth::guard("web")->user();
                session([
                    'web.name' => $user->name,
                    'web.email' => $user->email,
                    'web.phone_no' => $user->phone_no,
                    'web.role' => $user->role,
                    'web.UUID' => $user->user_id,
                    'web.login_time' => now()->toDateTimeString(),
                ]);

                // Access them like this: `session('role');`

                // maybe add some events to send email or such
                return redirect()->route('home');
            }
    
            // return back()->withErrors([
            //     "Failed" => "Unable to register, try again later."
            // ]);

            return redirect()->back()->withErrors(['error'=> 'Unable to register, try again later. '])->withInput();    
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
