<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeMapper extends Model
{
    use HasFactory;

    protected $table = 'attribute_mappers';

    protected $fillable = [
        'attribute_value_id',
        'variant_id'
    ];
}
