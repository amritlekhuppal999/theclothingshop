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

    // attribute type value 
        // return attribute type
        function attribute_type_value($attr){
            $attr_array = $this->attribute_type_list();
            return $attr_array[$attr];
        }
        // return attribute type array
        function attribute_type_list(){
            return array(
                "1" => "Size",
                "2" => "Color",
                "3" => "Theme"
            );
        }
    // attribute type value END

    
    // VIEW RECORDS
    public function showAttributeView()
    {
        $attributes = Attribute::paginate(5);
        // var_dump($attributes->items);
        // var_dump($attributes);
        foreach ($attributes as $attribute) {
            $attribute->type = $this->attribute_type_value($attribute->type);
        }
        return view($this->attribute_route.'attribute', ['attributes' => $attributes]);
    }

    
    // ADD ATTRIBUTE FORM
    public function showAddAttributeForm()
    {
        $attr_type = $this->attribute_type_list();
        return view($this->attribute_route.'add-attribute', ["attr_type"=> $attr_type]);
    }

    // EDIT ATTRIBUTE FORM
    public function edit($attributeId)
    {
        $attribute = Attribute::where('id', $attributeId)->select("id", "attribute", "label", "type")->get();
        $attribute = $attribute[0];
        $attr_type = $this->attribute_type_list();
        return view($this->attribute_route.'update-attribute', ["attributeId" => $attributeId, "attribute" => $attribute, "attr_type"=> $attr_type] );
    }

    // Update attribute
    public function update(Request $request){
        // Validate the incoming data
        $request->validate([
            'attributeValue' => 'required|string|max:255',
            'attributeLabel' => 'required|string',
            'attributeType' => 'required|integer'
        ]);

        try{
             // Find the existing attribute by its ID
            $attribute = Attribute::findOrFail($request->attributeId);

            // Save the data in the database
            $attribute ->update([
                'attribute' => $request->attributeValue,
                'label' => $request->attributeLabel,
                'type' => $request->attributeType
            ]);

            // Redirect with a success message
            return redirect()->back()->with('success', 'Attribute updated successfully!');
        }
        catch (ModelNotFoundException $e) {
            // Handle the case where the attribute doesn't exist
            return redirect()->back()->withErrors(['error' => 'Attribute not found.']);
        }
        catch(QueryException $e){
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
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


    // DELETE attribute
    public function delete(Request $request){
        // Validate the incoming data
        
        try{
             // Find the existing attribute by its ID
            $attribute = Attribute::findOrFail($request->attributeId);

            // Save the data in the database
            $attribute ->update([
                'status' => 0
            ]);

            // Redirect with a success message
            return [
                "type" => "Success",
                "message" => "Attribute deleted successfully.",
                "deleted" => true,
                "reload" => true
            ];
        }
        catch (ModelNotFoundException $e) {
            // Handle the case where the attribute doesn't exist
            // return redirect()->back()->withErrors(['error' => 'Attribute not found.']);
            return [
                "type" => "Failed",
                "message" => "Attribute not found.",
                "deleted" => false,
                "reload" => false
            ];
        }
        catch(QueryException $e){
            // return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            return [
                "type" => "Failed",
                "message" => "An error occurred: " . $e->getMessage(),
                "deleted" => false,
                "reload" => false
            ];
        }
    }
}
