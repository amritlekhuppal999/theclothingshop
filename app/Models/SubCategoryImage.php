<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryImage extends Model
{
    use HasFactory;

    protected $table = 'sub_category_images';

    protected $fillable = [
        'sub_category_id',
        'image_location',
        'prime_image',
        'status'
    ];
}
