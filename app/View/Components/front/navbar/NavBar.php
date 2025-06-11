<?php

namespace App\View\Components\front\navbar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Category;         // ADDED

class NavBar extends Component
{
    public $categories;
    /*** Create a new component instance.*/
    public function __construct()
    {
        try {
            
            $category_data = Category::select('id', 'category_name', 'category_slug')->where('status', 1);
    
            $category_collection = $category_data->get()->toArray();
    
            $this->categories = $category_collection;
        } 
        catch (\Throwable $th) {
            $this->categories = [];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.navbar.nav-bar');
    }
}
