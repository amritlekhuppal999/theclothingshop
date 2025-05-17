<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImages extends Model
{
    use HasFactory;

    protected $table = 'banner_images';

    protected $fillable = [
        'image_location',
        'active_in_banner',
        'status'
    ];
}
