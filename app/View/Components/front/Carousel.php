<?php

namespace App\View\Components\front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// use App\Models\BannerImages;

class Carousel extends Component
{
    
    public $bannerImages;
    
    /** * Create a new component instance. */
    public function __construct($bannerImages = null){
        // $this->dummy = filter_var($dummy, FILTER_VALIDATE_BOOLEAN);

        $this->bannerImages = (!$bannerImages) ? collect() : $bannerImages;
    }

    /** * Get the view / contents that represent the component. */
    public function render(): View|Closure|string
    {
        return view('components.front.carousel');
    }
}
