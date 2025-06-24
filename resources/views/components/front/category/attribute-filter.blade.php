
    <style>
        
        .checkbox-item input[type="checkbox"] {
            appearance: none;
            width: 24px;
            height: 24px;
            border: 2px solid #ddd;
            border-radius: 6px;
            margin-right: 15px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        

        /*
        .checkbox-item input[type="checkbox"]:checked {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-color: #667eea;
        }

        .checkbox-item input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .checkbox-item input[type="checkbox"]:hover {
            border-color: #667eea;
            transform: scale(1.1);
        }

        .checkbox-item label {
            margin-top:8px;
            color: #555;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
            flex: 1;
            font-size: 1.1em;
        }

        .checkbox-item:has(input:checked) {
            background: rgba(102, 126, 234, 0.1);
            border-color: rgba(102, 126, 234, 0.3);
        }

        .checkbox-item:has(input:checked) label {
            color: #333;
            font-weight: 600;
        }
        */
    </style>

    @php
        $size_data = [];
        $color_data = [];

        if(request()->has('size')){
            $size_data = explode(',', request('size'));
        }

        if(request()->has('color')){
            $color_data = explode(',', request('color'));
        }
    @endphp


    @foreach($attributeValueData as $key => $attributeData)
        
        <div class="col-md-12">
            <div class="card" style="">
                <div class="card-body pr-0">
                    <p class="card-text"> {{ $attributeData["attribute_type"] }} </p>
                        <div class="" style="max-height:150px; overflow-y:auto;">
                            @foreach($attributeData["attribute_value_array"] as $key => $attr_value)
                                <label class="btn btn-outline-secondary cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        name="{{ $attributeData["attribute_type"] }}[]" 
                                        value="{{ $attr_value["id"] }}"
                                        {{ ( strtolower($attributeData["attribute_type"]) == "size" && in_array(strtolower($attr_value["value"]), $size_data) ) ? "checked" : "" }}
                                        {{ ( strtolower($attributeData["attribute_type"]) == "color" && in_array(strtolower($attr_value["value"]), $color_data) ) ? "checked" : "" }}
                                    /> 
                                    {{ $attr_value["value"] }} 
                                </label>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
        
    @endforeach


    {{-- <div class="checkbox-item">
        <input type="checkbox" id="option1">
        <label for="option1">Email Notifications</label>
    </div> --}}