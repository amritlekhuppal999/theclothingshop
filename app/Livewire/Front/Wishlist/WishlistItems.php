<?php

namespace App\Livewire\Front\Wishlist;

use Livewire\Component;

use App\Models\Wishlist;

class WishlistItems extends Component
{
    
    public $item_load_limit = 4;
    public $totalRecords;
    public $toggleAction = true;

    /*
        These are query parameters, instead of using Request object or request helper method (which wont work in lazyload in livewire components), 
        we are using these properties and Livewire automatically binds these properties to their respective queryParams.

        $queryString tells Livewire which public properties to sync with the URL query parameters.
        Those public properties ($sort, etc.) actually hold the values.
        Without defining these as public properties, Livewire won’t know where to put the values and won’t sync them properly.
    */
    protected $queryString = ["sort"];
    public $sort;

    public function load_more(){
        $this->item_load_limit += 4;
    }

    // force a reRender
    public function refresh(){
        $this->toggleAction = !$this->toggleAction;
    }

    public function updateSort($newSort){
        $this->sort = $newSort;
    }
    
    public function render()
    {
        $userId = session()->has('web.UUID') ? session('web.UUID') : null;
        $wishlist = Wishlist::join('products as PRO', function($query){
                                    $query->on('PRO.id', '=', 'wishlist.product_id');
                                })
                                ->join('product_images as PI', function($query){
                                    $query->on('PRO.id', '=', 'PI.product_id')->where('PI.prime_image', 1);
                                })
                                ->select(
                                            'PRO.id as product_id', 'PRO.product_name', 'PRO.product_slug', 
                                            'wishlist.id',
                                            'PI.image_location'
                                    )
                                ->when($this->sort, function($query) {  // SORT FILTER (ORDER BY)
                                    if(isset($this->sort) && !empty($this->sort)){
                                        
                                        $sort_level = $this->sort;
                                        $sort_column = 'cart.id'; $sort_order = 'DESC'; // Default
                                        
                                        if($sort_level == 1){   // Newest First
                                            $sort_column = 'cart.id'; $sort_order = 'DESC';
                                        }
                                        else if($sort_level == 2){  // OLDEST first
                                            $sort_column = 'cart.id'; $sort_order = 'ASC';
                                        }        
                                                
                                    }
                                    
                                    return $query->orderBy($sort_column, $sort_order);
                                })
                                ->where('wishlist.user_id', $userId);
                                // ->limit($this->item_load_limit);
        
        // capture the total count first then store the collection with limit or else will get same record count for both.
        $this->totalRecords = $wishlist->get()->count();    

        $wishlist_items = $wishlist->limit($this->item_load_limit)->get();

        // \Log::info('\ntotalrecords:', [$this->totalRecords, $wishlist_items->count()]);
        
        return view('livewire.front.wishlist.wishlist-items')->with([
            "wishlist_items" => $wishlist_items
        ]);
    }
}
