<?php

namespace App\View\Components\front\home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedRemainingCategory extends Component
{
    public Collection $sub_category;
    public $error_msg;
    public $sql;
    public $product_array;
    
    /** * Create a new component instance. */
    public function __construct(Collection $sub_category = null, $error_msg= null, $sql=null, $product_array=null)
    {
        $this->sub_category = ($sub_category) ? $sub_category : collect();
        $this->error_msg = ($error_msg) ? $error_msg : "";
        $this->sql = ($sql) ? $sql : "";
        $this->product_array = ($product_array) ? $product_array : [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.home.featured-remaining-category');
    }
}
