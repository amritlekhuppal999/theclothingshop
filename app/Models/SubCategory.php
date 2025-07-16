<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_category';

    protected $fillable = [
        'sub_category_name',
        'sub_category_slug',
        'category_id',
        'featured',
        'featured_size',
        'featured_in_page',
        'status'
    ];

    // Relations  (SEE DOCS for implementation details)
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
