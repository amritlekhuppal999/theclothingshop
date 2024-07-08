<?php

namespace App\View\Components\Front;

use Closure;
// use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Dropdown_menu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $use
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // return view('components.front.dropdown_menu')->with('yo', "bitch");
        return View::make('components.front.dropdown_menu', ['yo'=>'bitch']);
    }
}
