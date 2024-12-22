<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

use App\Models\Attribute;

class AttributeController extends Controller
{
    //
    private $attribute_route = 'admin-panel/attribute/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    // Get size attributes

        public function size_list(){

            return array(
                "XS" => "Extra Small",
                "S" => "Small",
                "M" => "Medium",
                "L" => "Large",
                "XL" => "Extra Large",
                "XXL" => "Double Extra Large",
                "XXXL"  => "Triple Extra Large"
            );

        }

        public function size_value($size){
            $size_arr = $this->size_list();
            return $size_arr[$size];
        }
    // Get size attributes END

    public function showAttributeView()
    {
        $attributes = Attribute::paginate(5);
        return view($this->attribute_route.'attribute', ['attributes' => $attributes]);
    }

    public function showAddAttributeForm()
    {
        return view($this->attribute_route.'add-attribute');
    }

    // Add attribute data in database
    public function store(Request $request){
        // Validate the incoming data
        $request->validate([
            'attributeValue' => 'required|string|max:255',
            'attributeLabel' => 'required|string',
            'attributeType' => 'required|integer'
        ]);

        try{

            // Save the data in the database
            $attribute = Attribute::create([
                'attribute' => $request->attributeValue,
                'label' => $request->attributeLabel,
                'type' => $request->attributeType
            ]);

            if($attribute){
                // Redirect with a success message
                return redirect()->back()->with('success', 'Attribute added successfully!');
            }
            else {
                return back()->withErrors([ "error" => "Failed to add the attribute." ]);
                // return redirect()->back()->with('error', 'Failed to add the attribute.');
            }
        }
        catch(QueryException $e){
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
        

        // Redirect with a success message
        // return redirect()->back()->with('success', 'Data has been saved successfully!');
    }


    
}
