<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryMapper extends Model
{
    use HasFactory;
    protected $table = 'product_category_mapper';

    protected $fillable = [
        'product_id',
        'sub_category_id'
    ];

    // Relations  (SEE DOCS for implementation details)
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
