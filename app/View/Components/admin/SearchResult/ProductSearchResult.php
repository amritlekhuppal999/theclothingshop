<?php

namespace App\View\Components\admin\SearchResult;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductSearchResult extends Component
{
    
    private $SEARCH_RESULT_PATH = 'components.admin.search-result.ProductSearchResult';

    /**
     * Create a new component instance.
     */
    public function __construct( )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view($SEARCH_RESULT_PATH);
    }
}
