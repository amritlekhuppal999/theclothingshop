    
    @php
        $sub_category_values = [];
        if(request()->has('sc')){
            $sub_category_values = explode(',', request('sc'));
        }
    @endphp
    
    
    <div class="card" style="">
        <div class="card-body pr-1" style="">
            <p class="card-text"> SUB-CATEGORY </p>

            <div 
                class="list-group list-group-flush scroll-container" 
                style="max-height:300px; overflow-y:auto;"
                id="sub_category_filter_body">
                @foreach($subCategoryList as $key => $subCategory)
                    <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                        <input 
                            class="form-check-input me-1 sub_category_filter_options" 
                            type="checkbox" 
                            value="{{ $subCategory["sub_category_slug"] }}"
                            data-sub_cat_id="{{ $subCategory["id"] }}"
                            {{ ( in_array($subCategory["sub_category_slug"], $sub_category_values) ) ? "checked" : "" }}
                        />
                        {{ $subCategory["sub_category_name"] }}
                    </label>
                @endforeach
            </div>

        </div>
    </div>

    {{-- @push doesn't work inside Blade components due to isolated rendering. --}}
    
@once
    <script src="{{ asset("js/globals.js") }}"></script>
    
    <script>
        window.onload = ()=>{

            /*
                This does not work here...
                Explanation coming soon.
            */
            
        };

        document.addEventListener('livewire:initialized', (event)=>{
            // console.log("livewire compoennt initialized");

            const loadProductElement = document.getElementById("livewire-load-product");
            const LIVEWIRE_PRODUCT_COMPONENT = Livewire.find(loadProductElement.getAttribute('wire:id'));
            // console.log(LIVEWIRE_PRODUCT_COMPONENT);
            
        
            let sc_value_array = [];
            const sc_parameter = 'sc';
            
            let sub_cat_body = document.getElementById("sub_category_filter_body");

            push_selected_sub_cat();
            
            const delayed_call = MyApp.debounce(set_query_param, 1000);

            sub_cat_body.addEventListener('click', event=>{
                
                // let sub_cat_options = document.getElementsByClassName("sub_category_filter_options");
                let element = event.target;
                
                if(element.className.includes("sub_category_filter_options")){
                    if(element.checked){
                        //console.log(element.value);

                        sc_value_array.push(element.value);
                    }
                    else if(!element.checked){
                        
                        if(sc_value_array.includes(element.value)){
                            
                            const index = sc_value_array.indexOf(element.value);
                            if (index !== -1) {
                                sc_value_array.splice(index, 1);
                            }
                        }
                    }

                    delayed_call();
                }
            });

            
            // pushes already selected sub categories in the array
            function push_selected_sub_cat(){
                let sub_cat_options = document.getElementsByClassName("sub_category_filter_options");

                let sub_cat_array = Array.from(sub_cat_options);

                sub_cat_array.map((element, index)=>{
                    if(element.checked == true){
                        sc_value_array.push(element.value);
                    }
                });
                // console.log(sc_value_array);
            }

            
            // set values to query parameters upon selecting
            function set_query_param(){
                let sc_value_string = '';
                sc_value_array.forEach((element)=>{
                    sc_value_string+= element+',';
                });

                if (sc_value_string.endsWith(',')) {
                    sc_value_string = sc_value_string.slice(0, -1); // Remove the last character
                }
                // console.log('sc_value_string: ', sc_value_array);
                // console.log('sc_value_string: ', sc_value_string);

                let new_url = MyApp.appendQueryString(window.location.href, sc_parameter, sc_value_string);
                // console.log('new_url: ', new_url);
                history.pushState(null, null, new_url);
                
                livewireRerender();
            }

            //To reload/rerender the livewire component with new values
            function livewireRerender(){
                // LIVEWIRE_PRODUCT_COMPONENT.triggerRefresh();
                // LIVEWIRE_PRODUCT_COMPONENT.call('triggerRefresh');

                let sc = new URLSearchParams(window.location.search).get('sc')
                LIVEWIRE_PRODUCT_COMPONENT.updateSC(sc);
                // console.log(sc)
            }
        });       
        
    </script>
@endonce