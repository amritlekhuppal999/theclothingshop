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

    public function attributeValues(){
        // return $this->belongsTo(AttributeValue::class, '$this->foreign_key', 'local_key');
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id')->select('id', 'value', 'label', 'attribute_id');
    }

    
}
