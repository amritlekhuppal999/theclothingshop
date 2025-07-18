<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_slug',
        'target_group',
        'category_id',
        //'sub_category_id',
        'base_price',
        'discount_percentage',
        'short_description',
        'long_description',
        'status'
    ];


    public function variants() {
        return $this->hasMany(SubProduct::class, 'product_id')->select('id', 'product_id', 'variant_name', 'stock');
    }
    
    public function primaryImage() {
        return $this->hasOne(ProductImage::class, 'product_id')->where('prime_image', 1);
    }

    public function PCM(){  // category mapper
        return $this->hasMany(ProductCategoryMapper::class, 'product_id');
    }

    

}
