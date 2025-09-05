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
        

        // we need 
        //     order items
        //         - product id, variant id using order id
            
        //     products
        //         - product name, product slug, category_id

        //     sub products
        //         - id
            
        //     category
        //         - category_id, cat name, cat slug
            
        //     attribute mapper
        //         - attr value id, variant id, 
            
        //     attribute values
        //         - value,
        
        // $orderData = Order::from('orders')->where('user_id', $this->userId);

        $orderData = Order::from('orders')
                            ->leftjoin('user_address as UADD', function($join){
                                $join->on('orders.shipping_address_id', '=', 'UADD.id');
                            })
                            ->with(['orderItems'])
                            // ->with(['orderItems' => fn($q) => $q->select('ORDER_ID', 'product_name')])

                            ->select('orders.*', 
                                     'UADD.name as recp_name', 'UADD.city', 'UADD.state', 'UADD.street_name', 'UADD.full_address'
                                    )
                            
                            ->where('orders.user_id', $this->userId);


        \Log::info('Order Data', [$orderData->get()->toArray()]);
        // \Log::info('User Id', [$this->userId]);
        
        
        // \Log::info('SQL DEBUG', [
        //     $orderData->toSql(),
        //     $orderData->getBindings()
        // ]);
        
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
