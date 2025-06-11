<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedProducts extends Model
{
    use HasFactory;

    protected $table = 'featured_collection';

    protected $fillable = [
        'product_id',
        'collection_id',
        'display_page'
    ];
}
