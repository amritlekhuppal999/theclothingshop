<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'product_id',
        'variant_id',
        'price',
        'quantity',
        'user_id',
    ];

    // Relations  (SEE DOCS for implementation details)
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variants() {
        return $this->belongsTo(SubProduct::class, 'variant_id')->select('id', 'product_id', 'variant_name');
    }

    public function PCM(){
        return $this->hasMany(ProductCategoryMapper::class, 'product_id', 'product_id');
        // return $this->hasMany(ProductCategoryMapper::class, 'product_id in cart', 'product_id in mapper table');
    }

    public function PAM(){
        return $this->hasMany(ProductAttributeMapper::class, 'product_id', 'product_id');
        // return $this->hasMany(ProductCategoryMapper::class, 'product_id in cart', 'product_id in mapper table');
    }
}
