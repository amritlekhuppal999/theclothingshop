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
}
