<?php

namespace App\View\Components\front\checkout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddressList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.checkout.address-list');
    }
}
