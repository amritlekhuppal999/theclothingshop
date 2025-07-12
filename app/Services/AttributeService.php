<?php

namespace App\Services;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductCategoryMapper;

use App\Models\AttributeMapper;
use App\Models\AttributeValue;
use App\Models\Attributes;

class AttributeService{

    public function getAttributeList($attributeType=""){
        return AttributeValue::from('attribute_values as ATV')
                ->join('attributes as ATR', function($query)use($attributeType){
                    $query->on('ATR.id', '=', 'ATV.attribute_id')
                    ->when($attributeType !== "", function($query)use($attributeType){
                        return $query->where('ATR.name', $attributeType);
                    });
                })
                ->select('ATV.id', 'ATV.value', 'ATV.label')
                ->get()->toArray();
    }
}