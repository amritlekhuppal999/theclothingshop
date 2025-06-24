<?php

namespace App\View\Components\front\category;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\SubCategory;
use App\Models\Category;

class ThemeFilter extends Component
{
    public $themeList;
    /*** Create a new component instance.*/
    public function __construct()
    {
        $sql_query = "";
        $sql_str_binding = "";

        try {
            $themeData = SubCategory::where('category_id', Category::select('id')->where('category_name', 'Themes')->limit(1));
            // $themeData = SubCategory::where('category_id', 7);
            $this->themeList = $themeData->get();
            $sql_query = $themeData->toSql();
            $sql_str_binding = $themeData->getBindings();

            $log_data = [
                "themeList" => $this->themeList->toArray(),
                "sql_query" => $sql_query,
                "sql_str_binding" => $sql_str_binding,
            ];

            // \Log::info("Theme List Data:", $log_data);
        } 
        catch (\Throwable $th) {
            $this->themeList = [];

            $log_data = [
                // "themeList" => $themeList,
                "error" => $th->getMessage(),
                "sql_query" => $sql_query,
                "sql_str_binding" => $sql_str_binding,
            ];
            
            // \Log::info("Theme List Data:", $log_data);
        }

        

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.category.theme-filter');
    }
}
