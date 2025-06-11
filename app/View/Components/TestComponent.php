<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Category;         // ADDED

class TestComponent extends Component
{
    public $categories;
    public $sql;
    public $bindings;
    public $error;
    /*** Create a new component instance.*/
    public function __construct()
    {
        try {
            // $category_data = Category::select('id', 'category_name', 'category_slug')->where('status', 1);
            //$category_data = Category::all();

            $category_data = Category::from('category as CAT')
                                ->leftjoin('sub_category as SCAT', function($join){
                                    $join->on('CAT.id', '=', 'SCAT.category_id')->where('SCAT.status', 1);
                                })
                                ->select(
                                    'CAT.id as CATID', 'CAT.category_name', 'CAT.category_slug', 
                                    'SCAT.id as SID', 'SCAT.sub_category_name', 'SCAT.sub_category_slug'
                                )
                                ->where('CAT.status', 1);

            

            $sql_str = $category_data->toSql();
            $sql_str_binding = $category_data->getBindings();
            $category_collection = $category_data->get();
            $category_array = $category_collection->toArray();

            // $return_data = array(
            //     "categories" => $category_array,
            //     "sql" => $sql_str,
            //     "sql_binding_str" => $sql_str_binding,
            //     "error" => ""
            // );
            
            $this->categories = $category_collection;
            $this->sql = $sql_str;
            $this->bindings = $sql_str_binding;
            $this->error = "";
        } 
        catch (\Throwable $th) {
            //throw $th;
            // $return_data = array(
            //     "categories" => [],
            //     "sql" => $sql_str,
            //     "sql_binding_str" => $sql_str_binding,
            //     "error" => "Something went wrong.. ".$th->getMessage()
            // );
            $this->categories = ["empty"];
            $this->sql = $sql_str;
            $this->bindings = $sql_str_binding;
            $this->error = $th->getMessage();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // $this->message = "asdas Value";
        return view('components.test-component');
    }
}
