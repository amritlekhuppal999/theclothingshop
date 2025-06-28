
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

            //var_dump($size_data);
        }

        if(request()->has('color')){
            $color_data = explode(',', request('color'));
        }
    @endphp

    <div id="attribute_filter_body">
        @foreach($attributeValueData as $key => $attributeData)
            @php
                $input_class = ''; 
                $section_class = '';
                

                if( strtolower($attributeData["attribute_type"]) == "size" ){
                    $input_class = "size_filter_options";
                    $section_class = "size_filter_body";
                }

                else if( strtolower($attributeData["attribute_type"]) == "color" ){
                    $input_class = "color_filter_options";
                    $section_class = "color_filter_body";
                }
            @endphp
            <div class="col-md-12">
                <div class="card" style="">
                    <div class="card-body pr-0">
                        <p class="card-text"> {{ $attributeData["attribute_type"] }} </p>
                            <div 
                                class="{{ $section_class }}"
                                id=""
                                style="max-height:150px; overflow-y:auto;">
                                @foreach($attributeData["attribute_value_array"] as $key => $attr_value)
                                    <label class="btn btn-outline-secondary cursor-pointer">
                                        <input 
                                            class="{{ $input_class }}"
                                            type="checkbox" 
                                            name="{{ $attributeData["attribute_type"] }}[]" 
                                            value="{{ $attr_value["value"] }}"
                                            {{ ( strtolower($attributeData["attribute_type"]) == "size" && in_array($attr_value["value"], $size_data) ) ? "checked" : "" }}
                                            {{ ( strtolower($attributeData["attribute_type"]) == "color" && in_array($attr_value["value"], $color_data ) ) ? "checked" : "" }}
                                        /> 
                                        {{ $attr_value["value"] }} 
                                    </label>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>



    {{-- <div class="checkbox-item">
        <input type="checkbox" id="option1">
        <label for="option1">Email Notifications</label>
    </div> --}}


    @once

        <script src="{{ asset("js/globals.js") }}"></script>
        
        <script>
            document.addEventListener('livewire:initialized', (event)=>{
                // console.log("livewire compoennt initialized");

                const loadProductElement = document.getElementById("livewire-load-product");
                const LIVEWIRE_PRODUCT_COMPONENT = Livewire.find(loadProductElement.getAttribute('wire:id'));
                // console.log(LIVEWIRE_PRODUCT_COMPONENT);

                const attribute_filter_body = document.getElementById("attribute_filter_body");

                let size_value_array = [];
                const size_parameter = 'size';

                let color_value_array = [];
                const color_parameter = 'color';

                let trigger_size_function = MyApp.debounce(setSize_queryParam, 1000);
                let trigger_color_function = MyApp.debounce(setColor_queryParam, 1000);

                push_selected_size();

                attribute_filter_body.addEventListener('click', event=>{
                    let element = event.target;

                    // SIZE
                    if(element.className.includes("size_filter_options")){
                        
                        if(element.checked){
                            //console.log(element.value);

                            size_value_array.push(element.value);
                        }
                        else if(!element.checked){
                            
                            if(size_value_array.includes(element.value)){
                                
                                const index = size_value_array.indexOf(element.value);
                                if (index !== -1) {
                                    size_value_array.splice(index, 1);
                                }
                            }
                        }

                        // function to set url and push state
                        trigger_size_function();
                    }

                    // COLOR
                    else if(element.className.includes("color_filter_options")){
                        
                        if(element.checked){
                            // console.log(element.value);

                            color_value_array.push(element.value);
                        }
                        else if(!element.checked){
                            
                            if(color_value_array.includes(element.value)){
                                
                                const index = color_value_array.indexOf(element.value);
                                if (index !== -1) {
                                    color_value_array.splice(index, 1);
                                }
                            }
                        }

                        // function to set url and push state
                        trigger_color_function();
                    }
                    
                });


                // SIZE
                    // pushes already selected size in the array
                    function push_selected_size(){
                        // SIZE
                        const size_filter_input = document.getElementsByClassName("size_filter_options");
                        let size_input_array = Array.from(size_filter_input);

                        size_input_array.map((element, index)=>{
                            if(element.checked == true){
                                size_value_array.push(element.value);
                            }
                        });
                        //console.log(size_value_array);
                    }
                    
                    // set values to query parameters upon selecting
                    function setSize_queryParam(){
                        // SIZE
                        let size_value_string = '';
                        size_value_array.forEach((element)=>{
                            size_value_string+= element+',';
                        });

                        if (size_value_string.endsWith(',')) {
                            size_value_string = size_value_string.slice(0, -1); // Remove the last character
                        }

                        let new_url = MyApp.appendQueryString(window.location.href, size_parameter, size_value_string);
                        history.pushState(null, null, new_url);

                        livewireSizeRerender()
                    }

                    //To reload/rerender the livewire component with new values
                    function livewireSizeRerender(){
                        // LIVEWIRE_PRODUCT_COMPONENT.triggerRefresh();
                        // LIVEWIRE_PRODUCT_COMPONENT.call('triggerRefresh');

                        let size = new URLSearchParams(window.location.search).get('size')
                        LIVEWIRE_PRODUCT_COMPONENT.updateSize(size);

                        console.log('attributes are currently in transition, will be live after updates');
                    }
                // SIZE END

                
                // COLOR
                    // set values to query parameters upon selecting
                    function setColor_queryParam(){
                        let color_value_string = '';
                        color_value_array.forEach((element)=>{
                            color_value_string+= element+',';
                        });

                        if (color_value_string.endsWith(',')) {
                            color_value_string = color_value_string.slice(0, -1); // Remove the last character
                        }
                        let new_url_2 = MyApp.appendQueryString(window.location.href, color_parameter, color_value_string);

                        history.pushState(null, null, new_url_2);

                        livewireColorRerender()
                    }

                    // pushes already selected color in the array
                    function push_selected_color(){
                        const color_filter_input = document.getElementsByClassName("color_filter_options");
                        let color_input_array = Array.from(color_filter_input);

                        color_input_array.map((element, index)=>{
                            if(element.checked == true){
                                color_value_array.push(element.value);
                            }
                        });
                    }

                    function livewireColorRerender(){
                        let color = new URLSearchParams(window.location.search).get('color')
                        LIVEWIRE_PRODUCT_COMPONENT.updateColor(color);

                        console.log('attributes are currently in transition, will be live after updates');
                    }
                // COLOR END
            });
        </script>
    @endonce