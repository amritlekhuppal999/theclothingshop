<?php

namespace App\View\Components\front\home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedProducts extends Component
{
    public $product_array;
    public $error_msg;
    public $sql;

    /*** Create a new component instance.*/
    public function __construct($product_array = null, $error_msg = null, $sql = null){
        $this->product_array = ($product_array != null) ? $product_array : [];
        $this->error_msg = ($error_msg) ? $error_msg : "";
        $this->sql = ($sql) ? $sql : "";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.home.featured-products');
    }
}
