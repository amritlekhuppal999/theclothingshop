<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private $products_route = 'admin-panel/products/';

    //
    public function showProductsView()
    {
        return view($this->products_route.'products');
    }

    public function showAddProducts()
    {
        return view($this->products_route.'add-products');
    }
}
