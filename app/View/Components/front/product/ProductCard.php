<?php

namespace App\View\Components\front\product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $displayPage,
        public string $cardType,
        public string $cardSize,
        public string $cardTheme,
        public string $slug,
        public string $imageSlug,
        public string $description
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.product.product-card');
    }
}
