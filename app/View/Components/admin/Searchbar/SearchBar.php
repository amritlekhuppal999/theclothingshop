<?php

namespace App\View\Components\admin\Searchbar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBar extends Component
{
    /**
     * Create a new component instance.
     */

    private $SEARCH_BAR_PATH = 'components.admin.searchbar.search-bar';

    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view($this->SEARCH_BAR_PATH);
    }
}
