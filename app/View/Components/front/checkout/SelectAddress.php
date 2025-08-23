<?php

namespace App\View\Components\front\checkout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\UserAddress;

class SelectAddress extends Component
{
    public $addressList;
    
    /** * Create a new component instance. */

    public function __construct(){
        // $this->addressList = UserAddress::get();
        
        // if (!Auth::guard('web')->check()) {
        //     return response()->json([
        //         "type" => "Failed",
        //         "message" => "Please login to continue",
        //         "errors" => "Session Expired",
        //         "code" => 401,
        //         "requested_action_performed" => false,
        //         "reload" => true
        //     ]);
        // }

        $userId = session()->has('web.UUID') ? session('web.UUID') : null;

        $this->addressList = UserAddress::where('user_id', $userId)->orderBy('primary', 'DESC')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.checkout.select-address');
    }
}
