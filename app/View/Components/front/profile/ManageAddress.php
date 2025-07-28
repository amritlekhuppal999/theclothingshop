<?php

namespace App\View\Components\front\profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\User;
use App\Models\UserAddress;

class ManageAddress extends Component
{
    
    public $userAddress;
    /** * Create a new component instance. */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $this->userAddress = [];
        // if (!Auth::guard('web')->check()) {
        //     // return redirect()->back()->with('error', 'Session expired. Login to continue. ')->withInput();
        // }
        
        try {
            $userId = ( session()->has('web.UUID') ) ? session('web.UUID') : null;
            $this->userAddress = UserAddress::where('user_id', $userId)->where('status', 1)->orderBy('primary', 'DESC')->get();
            
            // $this->userAddress = UserAddress::where('user_id', $userId)->orderBy('primary', 'DESC');
            // $this->userAddress = $this->userAddress->get();
            // \Log::error('Error: ', ["error_msg" => $this->userAddress->toSql()]);
        }
        catch (\Throwable $th) {
            //throw $th;
            // \Log::error('Error: ', ["error_msg" => $th->getMessage()]);
        }

        return view('components.front.profile.manage-address');
    }
}


//select * from `user_address` where `user_id` = "a97ac41c-8226-4909-b9ed-9ffab65f1b8b" order by `primary` desc