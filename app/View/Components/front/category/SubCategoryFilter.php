<?php

namespace App\View\Components\front\category;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// use App\models\Category;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryFilter extends Component
{   
    public $subCategoryList;
    
    /*** Create a new component instance.*/
    public function __construct(public $categorySlug)
    {
        $sql_query = "";
        $sql_str_binding = "";

        try {
            $category_id = Category::select('id')->where( 'category_slug', $this->categorySlug)->limit(1);
            $subCategoryData = SubCategory::where('category_id', $category_id)->where('status', 1);

            $this->subCategoryList = $subCategoryData->get();
            $sql_query = $subCategoryData->toSql();
            $sql_str_binding = $subCategoryData->getBindings();

            $log_data = [
                "subCategoryList" => $this->subCategoryList->toArray(),
                "sql_query" => $sql_query,
                "sql_str_binding" => $sql_str_binding,
            ];
        } 
        catch (\Throwable $th) {
            $this->subCategoryList = [];

            $log_data = [
                // "subCategoryList" => $subCategoryList,
                "error" => $th->getMessage(),
                "sql_query" => $sql_query,
                "sql_str_binding" => $sql_str_binding,
            ];
        }

        //\Log::info("Sub Category List Data:", $log_data);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.category.sub-category-filter');
    }
}
