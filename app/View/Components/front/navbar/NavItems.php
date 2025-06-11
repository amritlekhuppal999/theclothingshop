<?php

namespace App\View\Components\front\navbar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\SubCategory;         // ADDED

class NavItems extends Component
{
    public $sub_categories;
    /*** Create a new component instance.*/
    public function __construct(public $categoryId){
        
        try {
            $sub_category_data = SubCategory::select('id', 'sub_category_name', 'sub_category_slug')
                ->where('category_id', $categoryId)
                ->where('status', 1);

            $sub_category_collection = $sub_category_data->get()->toArray();

            $this->sub_categories = $sub_category_collection;
        } 
        catch (\Throwable $th) {
            $this->sub_categories = [];
        }
    }

    /*** Get the view / contents that represent the component.*/
    public function render(): View|Closure|string
    {
        return view('components.front.navbar.nav-items');
    }
}
