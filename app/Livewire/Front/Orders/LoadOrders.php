<?php

namespace App\Livewire\Front\Orders;

use Livewire\Component;

use Illuminate\Http\Request;    // Added
use Illuminate\Support\Facades\DB;  // Added

use App\Models\Product;
// use App\Models\SubProdduct;
// use App\Models\ProdductImages;
use App\Models\Order;
use App\Models\OrderItems;

// use App\Models\Category;
// use App\Models\SubCategory;

// use App\Models\ProductCategoryMapper;

class LoadOrders extends Component
{

    public $totalRecords;  // total no of records present
    public $loadAmount = 8;    // no of records to load
    public $refresh = false;
    private $userId;


    public function mount(Request $request){
        $this->userId = session()->has('web.UUID') ? session('web.UUID') : null;
        // $category_id = Category::where('category_slug', $categorySlug)->first();
        // $this->categoryId = ($category_id) ? $category_id->id : 0;
        
        //$productData = $this->getProductData();
    }


    public function getOrderData(){
        $orderData = Order::where('user_id', $this->userId);
        \Log::info('Order Data', [$orderData->get()->toArray()]);
        
        // $orderData = Order::get();
        // \Log::info('Order Data', [$orderData->toArray()]);

        return $orderData;
    }


    public function render(){

        $orderData = $this->getOrderData();

        $this->totalRecords = $orderData->count();

        $orderList = $orderData->limit($this->loadAmount)->get();

        return view('livewire.front.orders.load-orders')->with([
            'orderList' => $orderList
        ]);
    }
}
