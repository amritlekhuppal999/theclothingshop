    
    @php
        $price_value = 0;
        if(request()->has('price')){
            $price_value = request('price');
        }
    @endphp
    
    
    <div class="col-md-12">
        <div class="card" style="">
            <div class="card-body">
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