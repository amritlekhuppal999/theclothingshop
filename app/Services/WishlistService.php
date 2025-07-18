<?php

namespace App\Services;


use App\Models\Wishlist;
use App\Models\Product;
use App\Models\User;


class WishlistService{


    public function isAddedToWishlist($product_id){ //can be id or slug
        $userId = session()->has('web.UUID') ? session('web.UUID') : null;
        $wishlist = Wishlist::where('product_id', $product_id)->where('user_id', $userId)->get();

        return ($wishlist->isNotEmpty()) ? true : false;
    }
}