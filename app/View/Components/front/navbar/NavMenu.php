<?php

namespace App\View\Components\front\navbar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

//use App\Models\Category;         // ADDED

class NavMenu extends Component
{
    /*** Create a new component instance.*/
    public function __construct(public $categories)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.navbar.nav-menu');
    }
}
