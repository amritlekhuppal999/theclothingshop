<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\AttributeMapper;

class AttributeController extends Controller
{
    //
    private $attribute_route = 'admin-panel/attribute/';
    private $VIEW_NOT_FOUND = 'admin-panel/404';

    

    // VIEW RECORDS
    public function INDEX(Request $request)
    {

        $limit = ($request->has("limit")) ? $request->query("limit") : 10 ;
        $search_keyword = ($request->has("search_keyword")) ? $request->query("search_keyword") : "" ;

        $attributes = Attribute::join('attribute_values as AV', 'attributes.id', '=', 'AV.attribute_id')
                                ->select('AV.value', 'AV.label', 'name')
                                ->when($request->has("search_keyword"), function($query) use($request){
                                    $search_keyword = $request->query("search_keyword");
                                    return $query->where('name', 'like', '%'.$search_keyword.'%')
                                                ->orWhere('AV.value', 'like', '%'.$search_keyword.'%')
                                                ->orWhere('AV.label', 'like', '%'.$search_keyword.'%');
                                })
                                ->paginate($limit)->withQueryString();

        $return_data = array(
            "attributes" => $attributes,
            "search_keyword" => $search_keyword
        );
        
        return view($this->attribute_route.'attribute', $return_data );
    }

    
    // ADD ATTRIBUTE FORM
    public function CREATE()
    {
        $attr_type = $this->attribute_type_list();
        return view($this->attribute_route.'add-attribute', ["attr_type"=> $attr_type, "form_type" => "add-attribute"]);
    }

    
    // INSERT attribute 
    public function STORE(Request $request){
        // Validate the incoming data
        $request->validate([
            'attributeName' => 'required|string|max:255|unique:attributes,name'
        ]);

        try{

            // Save the data in the database
            $attribute = Attribute::create([
                'name' => $request->attributeName
            ]);

            return redirect()->back()->with('success', 'Attribute added successfully!');

            // if($attribute){
            //     // Redirect with a success message
            //     return redirect()->back()->with('success', 'Attribute added successfully!');
            // }
            // else {
            //     return back()->withErrors([ "error" => "Failed to add the attribute." ]);
            //     // return redirect()->back()->with('error', 'Failed to add the attribute.');
            // }
        }
        catch(QueryException $e){   // Database Error 
            return redirect()->back()->with('error', 'Failed to add the attribute. ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
        catch(Exception $e){   // General Error
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred: ');
        }
        

        // Redirect with a success message
        // return redirect()->back()->with('success', 'Data has been saved successfully!');
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

    
    
    // ADD ATTRIBUTE VALUE FORM
    public function CREATE_VAL(){

        $attr_list = $this->get_attribute_list();
        
        $return_data = [
            "form_type" => "add-attribute-value",
            "attribute_list" => $attr_list["attribute_list"]
        ];
        return view($this->attribute_route.'add-attribute', $return_data);
    }
    
    // Add attribute data in database
    public function STORE_VAL(Request $request){
        // Validate the incoming data
        $request->validate([
            'attribute_id' => 'required|integer',
            'attributeValue' => 'required|string|unique:attribute_values,value|max:255',
            'attributeLabel' => 'required|string|max:255'
        ]);

        try{

            // Save the data in the database
            $attribute = AttributeValue::create([
                'attribute_id' => $request->attribute_id,
                'value' => $request->attributeValue,
                'label' => $request->attributeLabel
            ]);

            return redirect()->back()->with('success', 'Attribute Value added successfully!');
        }
        catch(QueryException $e){   // Database Error 
            return redirect()->back()->with('error', 'Failed to add the Value. ' . $e->getMessage());
        }
        catch(Exception $e){   // General Error
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    
    public function get_attribute_list(){
        $attributes = Attribute::get();
        return ["attribute_list" => $attributes];
    }

    public function get_attribute_values($attribute_id=null){
        
        if($attribute_id){
            $attribute_values = AttributeValue::where('attribute_id', $attribute_id)->get();
        }
        else $attribute_values = AttributeValue::get();
        
        return ["attribute_values" => $attribute_values];
    }



    // Get size attributes (NOT IN USE)

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

    // attribute type value (NOT IN USE)
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
    
}
