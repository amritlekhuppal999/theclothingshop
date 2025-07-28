<?php

namespace App\Http\Controllers\FrontEnd\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserAddress;     

use App\Mail\EmailVerificationCode;     // Added

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;      // Added
use Illuminate\Support\Facades\Validator;   // Added
use Illuminate\Support\Facades\Mail;       // Added

use Illuminate\Database\Eloquent\ModelNotFoundException;

// Specific to email transport failure (SMTP issues, etc.)
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


class ProfileController extends Controller{

    private $profile_route = 'front-end.profile';
    private $VIEW_NOT_FOUND = '404';

    public function INDEX(){

        $session_data = session()->get('web');

        try {
            $UserData = User::where('user_id', $session_data["UUID"])->firstOrFail();
            $UserData = $UserData->toArray();
        } 
        catch (\Throwable $th) {
            
            // \Log::error("\nError Msg: ", $th->getMEssag());

            $UserData = [];
        }


        // \Log::info('session data', [
        //     // session()->get('web'),
        //     $session_data["name"]
        // ]);

        return view($this->profile_route.'.profile', ["UserData" => $UserData]);
    }

    
    public function STORE_ADDRESS(Request $request){
        
        if (!Auth::guard('web')->check()) {
            return redirect()->back()->with('error', 'Session expired. Login to continue. ')->withInput();
        }

        // validate
        $vald = $request->validate([
            'userName' => 'required|string|max:255',

            // 'apartmentNo' => 'string|max:255',
            // 'buildingNo' => 'string|max:255',
            // 'buildingName' => 'string|max:255',
            // 'streetName' => 'string|max:255',

            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|integer',
            'phone' => 'required|integer|min:1',    
            'fullAddress' => 'required|string|max:100000',

            // 'addressCategory' => 'integer',
            // 'addressType' => 'integer',
        ]);


        try {
            $userId = ( session()->has('web.UUID') ) ? session('web.UUID') : null;
            User::where('user_id', $userId)->firstOrFail();

            // \Log::info("\n Data: ", ["request" => $request->all()]);

            $address_arr = [
                "user_id" => $userId,
                "name" => $request->userName,
                "apartment_no" => $request->apartmentNo,
                "building_no" => $request->buildingNo,
                "building_name" => $request->buildingName,
                "street_name" => $request->streetName,
                "city" => $request->city,
                "state" => $request->state,
                "pincode" => $request->pincode,
                "phone" => $request->phone,
                "full_address" => $request->fullAddress,
                "address_category" => ($request->addressCategory !== null) ? $request->addressCategory : 0,
                "address_type" => ($request->addressType !== null) ? $request->addressType : 0,
            ];

            UserAddress::create($address_arr);

            return redirect()->back()->with('success', 'Address added');
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found.')->withInput();
        }
        catch (\Throwable $th) {
            // \Log::error("\n Error: ", ["request" => $th->getMessage()]);
            return redirect()->back()->with('error', 'Unable to add address')->withInput();
        }
    }

    public function TOGGLE_DEFAULT_ADDRESS(Request $request){
        
        if (!Auth::guard('web')->check()) {
            // return redirect()->back()->with('error', 'Session expired. Login to continue. ')->withInput();
            return redirect()->back()->with('error', 'Session expired. Login to continue. ');
        }


        try {
            $userId = ( session()->has('web.UUID') ) ? session('web.UUID') : null;
            UserAddress::where('user_id', $userId)->update(['primary' => 0]);
            
            $addressId = $request->addressId;
            $userAddress = UserAddress::findOrFail($addressId);
            $userAddress->primary = !$userAddress->primary;
            $userAddress->save();

            // \Log::info("\n Data: ", ["primary" => $userAddress->primary, "primaryNOT" => !$userAddress->primary]);

            return response()->json([
                "type" => "Success",
                "message" => "Default Address Changed.",
                "errors" => "",
                "code" => 200,
                "requested_action_performed" => false,
                "reload" => true
            ]);
        } 
        catch (ModelNotFoundException $e) {
            // \Log::error("\n Error: ", ["model_error" => $e->getMessage()]);
            return response()->json([
                "type" => "Failed",
                //"message" => "An unexpected error occurred. Try again in sometime.",
                "message" => "Invalid Address.",
                "errors" => $e->getMessage(),
                "code" => 404,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
        catch (\Throwable $th) {
            // \Log::error("\n Error: ", ["throwable" => $th->getMessage()]);
            return response()->json([
                "type" => "Failed",
                //"message" => "An unexpected error occurred. Try again in sometime.",
                "message" => "Not your fault, we messed up. Try again in sometime.",
                "errors" => $e->getMessage(),
                "code" => 500,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
    }

    public function REMOVE_SAVED_ADDRESS(Request $request){
        
        if (!Auth::guard('web')->check()) {
            // return redirect()->back()->with('error', 'Session expired. Login to continue. ')->withInput();
            \Log::error("\n Error: ", ["LoginExpired"]);
            return response()->json([
                "type" => "Failed",
                "message" => "Please login to continue",
                "errors" => "Session Expired",
                "code" => 401,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }

        try {
            $addressId = $request->addressId;
            $userAddress = UserAddress::findOrFail($addressId);
            $userAddress->status = 0;
            $userAddress->save();
            // $userAddress->delete();

            \Log::info("\n Data: ", ["request made"] );

            return response()->json([
                "type" => "Success",
                "message" => "Default Address Changed.",
                "errors" => "",
                "code" => 200,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        } 
        catch (ModelNotFoundException $e) {
            \Log::error("\n Error: ", ["model_error" => $e->getMessage()]);
            // return response()->json([
            //     "type" => "Failed",
            //     "message" => "Invalid Address.",
            //     "errors" => "",
            //     "code" => 404,
            //     "requested_action_performed" => false,
            //     "reload" => false
            // ]);
        }
        catch (\Throwable $th) {
            \Log::error("\n Error: ", ["throwable" => $th->getMessage()]);
            // return response()->json([
            //     "type" => "Failed",
            //     "message" => "Not your fault, we messed up. Try again in sometime.",
            //     "errors" => "",
            //     "code" => 500,
            //     "requested_action_performed" => false,
            //     "reload" => false
            // ]);
        }
    }

    public function EDIT_PROFILE(Request $request){
        
        if (!Auth::guard('web')->check()) {
            return redirect()->back()->with('error', 'Session expired. Login to continue. ')->withInput();
        }

        // validate
        $vald = $request->validate([
            'fullName' => 'required|string|max:255',
        ]);


        try {
            $userId = ( session()->has('web.UUID') ) ? session('web.UUID') : null;
            $userData = User::where('user_id', $userId)->firstOrFail();

            // \Log::info("\n Data: ", ["request" => $request->all()]);

            $userData->update([ "name" => $request->fullName ]);

            return redirect()->back()->with('success', 'Profile updated.');
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found!')->withInput();
        }
        catch (\Throwable $th) {
            // \Log::error("\n Error: ", ["request" => $th->getMessage()]);
            return redirect()->back()->with('error', 'Unable to update user profile')->withInput();
        }
    }



    public function GENERATE_EMAIL_VERIFICATION_CODE(Request $request){

        // \Log::info('\nRequest Data:', [$request->newEmailId]);

        $validator = Validator::make($request->all(), [
            'newEmailId' => 'required|email'
        ]);

        if($validator->fails()){
            // \Log::info('\nValidation Error:', [$validator->errors()->all()]);
            // This makes it more structured
            return response()->json([
                "type" => "Failed",
                "message" => "Invalid Email format",
                "errors" => $validator->errors()->all(),
                "code" => 422,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }

        try {
            $userId = ( session()->has('web.UUID') ) ? session('web.UUID') : null;
            $user = User::where('user_id', $userId)->firstOrFail();
            
            $verificationCode = generateSixDigitCode();
            // $verificationCode = '123456';

            $mailingData = [
                'name' => $user["name"],
                'verificationCode' => $verificationCode
            ];

            // Invoke Mailable to send structured mail
            Mail::to($request->newEmailId)->send(new EmailVerificationCode($mailingData));

            return response()->json([
                "type" => "Success",
                "message" => "Verification code sent to <b>".$request->newEmailId.'</b>',
                "errors" => "",
                "code" => 200,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        } 
        
        // Model for specific id not found
        catch (\ModelNotFoundException $model) {
            \Log::info('Model Error:', [$model->getMessage()]);
            
            return response()->json([
                "type" => "Failed",
                "message" => "Invalid Email format",
                // "errors" => $model->getMessage(),
                "code" => 404,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
        
        // Specific to email transport failure (SMTP issues, etc.)
        catch (TransportExceptionInterface $mail) {    
            
            \Log::error('Mail transport failed: ' . $mail->getMessage());
            
            return response()->json([
                "type" => "Failed",
                "message" => "Something went wrong. Email could not be sent.",
                // "errors" => $mail->getMessage(),
                "code" => 500,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
        
        // General exception handler
        catch (\Throwable $th) {
            \Log::info('Error:', [$th->getMessage()]);
            return response()->json([
                "type" => "Failed",
                "message" => "Not your fault, we messed up. Try again later.",
                // "errors" => $th->getMessage(),
                "code" => 500,
                "requested_action_performed" => false,
                "reload" => false
            ]);
        }
    }
}