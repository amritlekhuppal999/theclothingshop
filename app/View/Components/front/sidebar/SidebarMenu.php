<?php

namespace App\View\Components\front\sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $categories)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.sidebar.sidebar-menu');
    }
}
