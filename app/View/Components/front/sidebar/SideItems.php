<?php

namespace App\View\Components\front\sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideItems extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $categoryId, public $categorySlug)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.sidebar.side-items');
    }
}
