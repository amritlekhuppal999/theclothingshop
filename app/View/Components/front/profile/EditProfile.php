<?php

namespace App\View\Components\front\profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditProfile extends Component
{
    // public $userData;
    public function __construct(public $userData)
    {
        //
        //$this->userData = $userData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.profile.edit-profile');
    }
}
