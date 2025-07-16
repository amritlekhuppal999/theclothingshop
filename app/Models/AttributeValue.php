<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $table = 'attribute_values';

    protected $fillable = [
        'attribute_id',
        'value',
        'label'
    ];

    public function attribute(){
        // return $this->belongsTo(Attribute::class, '$this->foreign_key', 'local_key');
        return $this->belongsTo(Attribute::class, 'attribute_id')->select('id', 'name');
    }
}
