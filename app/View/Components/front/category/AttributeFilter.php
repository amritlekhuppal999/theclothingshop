<?php

namespace App\View\Components\front\category;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeFilter extends Component
{
    public $attributeValueData;
    /*** Create a new component instance.*/
    public function __construct()
    {
        $attributeData = Attribute::get();
        $attr_arr = $attributeData->toArray();
        $this->attributeValueData = [];
        foreach ($attr_arr as $key => $value) {
            $attr_value_array = AttributeValue::where('attribute_id', $value["id"])->get()->toArray();

            if(count($attr_value_array)){
                $this->attributeValueData[$value["id"]] = array(
                    "attribute_type" => $value["name"],
                    "attribute_value_array" => $attr_value_array
                );

            }
        }

        $log_data = [
            "attributeValueData" => $this->attributeValueData,
            // "sql_query" => $sql_query,
            // "sql_str_binding" => $sql_str_binding,
        ];

        // \Log::info("Attribute Filter Data:", $log_data);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.category.attribute-filter');
    }
}
