
    @php
        $theme_values = [];
        if(request()->has('theme')){
            $theme_values = explode(',', request('theme'));
        }
    @endphp

    {{-- <div class="col-md-12"></div> --}}
    <div class="card" style="">
        <div class="card-body" id="theme_option_body">
            <p class="card-text"> THEME </p>

            <div class="list-group list-group-flush scroll-container" style="max-height:300px; overflow-y:auto;">
                @foreach($themeList as $key => $theme)
                    <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                        <input 
                            class="form-check-input me-1 select_theme_option" 
                            type="checkbox" 
                            value="{{ $theme["sub_category_slug"] }}"
                            {{ ( in_array($theme["sub_category_slug"], $theme_values) ) ? "checked" : "" }}
                        />
                        {{ $theme["sub_category_name"] }}
                    </label>
                @endforeach
            </div>

        </div>
    </div>

    
    
    {{-- <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
            <input class="form-check-input me-1" type="checkbox" value="">
            Second
        </label> --}}

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

            const theme_option_inputs = document.getElementsByClassName("select_theme_option");
            const theme_option_body = document.getElementById("theme_option_body");

            let theme_value_array = [];
            const theme_parameter = 'theme';

            let trigger_my_function = MyApp.debounce(set_query_param, 1000);

            push_selected_theme();

            theme_option_body.addEventListener('click', event=>{
                let element = event.target;

                if(element.className.includes("select_theme_option")){
                    
                    if(element.checked){
                        //console.log(element.value);

                        theme_value_array.push(element.value);
                    }
                    else if(!element.checked){
                        
                        if(theme_value_array.includes(element.value)){
                            
                            const index = theme_value_array.indexOf(element.value);
                            if (index !== -1) {
                                theme_value_array.splice(index, 1);
                            }
                        }
                    }

                    // function to set url and push state
                    trigger_my_function();
                }
            });


            // pushes already selected sub categories in the array
            function push_selected_theme(){
                let theme_option_inputs = document.getElementsByClassName("select_theme_option");

                let theme_input_array = Array.from(theme_option_inputs);

                theme_input_array.map((element, index)=>{
                    if(element.checked == true){
                        theme_value_array.push(element.value);
                    }
                });
                // console.log(theme_value_array);
            }

            // set values to query parameters upon selecting
            function set_query_param(){
                let theme_value_string = '';
                theme_value_array.forEach((element)=>{
                    theme_value_string+= element+',';
                });

                if (theme_value_string.endsWith(',')) {
                    theme_value_string = theme_value_string.slice(0, -1); // Remove the last character
                }
                // console.log('theme_value_string: ', theme_value_array);
                // console.log('theme_value_string: ', theme_value_string);

                let new_url = MyApp.appendQueryString(window.location.href, theme_parameter, theme_value_string);
                // console.log('new_url: ', new_url);
                history.pushState(null, null, new_url);

                livewireRerender()
            }

            //To reload/rerender the livewire component with new values
            function livewireRerender(){
                // LIVEWIRE_PRODUCT_COMPONENT.triggerRefresh();
                // LIVEWIRE_PRODUCT_COMPONENT.call('triggerRefresh');

                let theme = new URLSearchParams(window.location.search).get('theme')
                LIVEWIRE_PRODUCT_COMPONENT.updateTheme(theme);
                // console.log(theme)
            }
        });


        
        
    </script>
@endonce