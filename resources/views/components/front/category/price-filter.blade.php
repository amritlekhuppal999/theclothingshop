    
    @php
        $price_value = 0;
        if(request()->has('price')){
            $price_value = request('price');
        }
    @endphp
    
    
    <div class="col-md-12">
        <div class="card" style="">
            <div class="card-body" id="price_filter_body">
                <p class="card-text"> PRICE </p>

                <div class="list-group list-group-flush">
                    <label class="list-group-item list-group-item-action cursor-pointer pl-4" aria-current="true" style="border-top:none;"> 
                        <input 
                            class="form-check-input me-1" 
                            name="price" type="radio" value="1" 
                            {{ ($price_value == 1) ? 'checked' : '' }}                            
                        />
                        Rs. 599 To Rs. 1073
                    </label>

                    <label class="list-group-item list-group-item-action cursor-pointer pl-4" aria-current="true" style="border-top:none;"> 
                        <input 
                            class="form-check-input me-1" 
                            name="price" type="radio" value="2" 
                            {{ ($price_value == 2) ? 'checked' : '' }}                            
                        />
                        Rs. 1074 To Rs. 1548
                    </label>

                    <label class="list-group-item list-group-item-action cursor-pointer pl-4" aria-current="true" style="border-top:none;"> 
                        <input 
                            class="form-check-input me-1" 
                            name="price" type="radio" value="3" 
                            {{ ($price_value == 3) ? 'checked' : '' }}                            
                        />
                        Rs. 1549 To Rs. 2500
                    </label>

                    <label class="list-group-item list-group-item-action cursor-pointer pl-4" aria-current="true" style="border-top:none;"> 
                        <input 
                            class="form-check-input me-1" 
                            name="price" type="radio" value="4" 
                            {{ ($price_value == 4) ? 'checked' : '' }}                            
                        />
                        Rs. 2501 and Higher
                    </label>
                </div>
            </div>
        </div>
    </div>


    @once
        <script>

            document.addEventListener('livewire:initialized', (event)=>{
                
                const loadProductElement = document.getElementById("livewire-load-product");
                const LIVEWIRE_PRODUCT_COMPONENT = Livewire.find(loadProductElement.getAttribute('wire:id'));

                let price_value = null;
                const price_parameter = 'price';

                const price_filter_body = document.getElementById("price_filter_body");

                let trigger_my_function = MyApp.debounce(set_query_param, 1000);

                push_selected_price();

                price_filter_body.addEventListener('click', event=>{
                    let element = event.target;

                    if(element.className.includes("form-check-input")){
                        if(element.checked){
                            price_value = element.value;
                        }

                        else price_value = 0;
                    }
                    
                    // function to set url and push state
                    trigger_my_function();
                });

                // pushes already selected sub categories in the array
                function push_selected_price(){
                    let price_option_inputs = document.getElementsByClassName("form-check-input");

                    let price_input_array = Array.from(price_option_inputs);

                    price_input_array.map((element, index)=>{
                        if(element.checked == true){
                            price_value = element.value;
                            return;
                        }
                    });
                    //console.log("price_value: ", price_value);
                }

                // set values to query parameters upon selecting
                function set_query_param(){
                    let price_value_string = price_value;

                    let new_url = MyApp.appendQueryString(window.location.href, price_parameter, price_value_string);
                    // console.log('new_url: ', new_url);
                    history.pushState(null, null, new_url);

                    livewireRerender()
                }

                //To reload/rerender the livewire component with new values
                function livewireRerender(){
                    // LIVEWIRE_PRODUCT_COMPONENT.triggerRefresh();
                    // LIVEWIRE_PRODUCT_COMPONENT.call('triggerRefresh');

                    let price = new URLSearchParams(window.location.search).get('price')
                    LIVEWIRE_PRODUCT_COMPONENT.updatePrice(price);
                    // console.log(theme)
                }

            });
        </script>
    @endonce