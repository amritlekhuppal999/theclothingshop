<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    use HasFactory;

    protected $table = 'sub_products';

    protected $fillable = [
        'product_id',
        'variant_name',
        'variant_slug',
        'stock',
        'sku',
        'price',
        'status'
    ];


    // Relations  (SEE DOCS for implementation details)
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productAttributes(){  // attribute mapper
        return $this->hasMany(AttributeMapper::class, 'variant_id')->select('id', 'variant_id', 'attribute_value_id');
    }

}


/** Example of hasOneThrough using a Mechanic Model
        class Mechanic extends Model
        {
            public function carOwner(): HasOneThrough
            {
                return $this->hasOneThrough(
                    Owner::class,   // Final Model
                    Car::class,     // Intermediate Model
                    'mechanic_id', // Foreign key on the cars table...
                    'car_id', // Foreign key on the owners table...
                    'id', // Local key on the mechanics table...
                    'id' // Local key on the cars table...
                );
            }
        }
*/
