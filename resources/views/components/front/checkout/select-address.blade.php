

    <div class="checkout-step active" id="step-1">
        <h4 class="mb-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Select Delivery Address</h4>
        
        @php
            //var_dump($addressList);
            //echo '<h1>'.session()->get('web.UUID').'</h1>';

            //a97ac41c-8226-4909-b9ed-9ffab65f1b8b
        @endphp

        {{-- Address 1 --}}
        @if($addressList->isNotEmpty())
            @foreach($addressList->toArray() as $key => $address)
                <div 
                    class="address-card {{ ($address["primary"]) ? 'selected' : '' }}" 
                    onclick="">
                    
                    <input 
                        type="radio" 
                        name="address" 
                        value="{{ $address["id"] }}" 
                        class="form-check-input" {{ ($address["primary"]) ? 'checked' : '' }}
                    />

                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            {{-- <i class="fas fa-home text-primary" style="font-size: 1.5rem;"></i> --}}
                            {!! getAddressIcon($address["address_type"]) !!}
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ getAddressType($address["address_type"]) }}</h6>
                            <p class="mb-1 text-muted">{{ $address["name"] }}</p>
                            <p class="mb-1">{{ $address["full_address"] }}</p>
                            <p class="mb-0 text-muted">{{ $address["city"] }}, {{ $address["state"] }} {{ $address["pincode"] }}</p>
                            
                            {!! 
                                ($address["primary"]) ? 
                                    '<small class="text-success"><i class="fas fa-check-circle me-1"></i>Default Address</small>' 
                                : ''
                            !!}
                            
                        </div>
                    </div>
                </div>
            @endforeach
            
            {{-- DELETE ME --}}
            {{-- <div 
                class="address-card " 
                onclick="">
                
                <input 
                    type="radio" 
                    name="address" 
                    value="123513" 
                    class="form-check-input"
                />

                <div class="d-flex align-items-start">
                    <div class="me-3">
                        <i class="fas fa-home text-primary" style="font-size: 1.5rem;"></i>
                    </div>
                    
                    <div class="flex-grow-1">
                        <h6 class="mb-1">HOME</h6>
                        <p class="mb-1 text-muted">asdasdasd</p>
                        <p class="mb-1">asdasdasd</p>
                        <p class="mb-0 text-muted">kjbsdiuwerlfh aiuef hlawekfjhiasourfsahroufiasdf</p>
                    </div>
                </div>
            </div> --}}
        @else
            <h6 class="text-muted">You haven't saved any addresses yet.</h6>
            {{-- <h5 class="text-muted">You haven't saved any addresses yet.</h5> --}}
            {{-- <h4>You haven't saved any addresses yet.</h4> --}}
            {{-- <h3>You haven't saved any addresses yet.</h3> --}}
        @endif
        

        <a href="{{ safe_route("checkout-add-address") }}" class="add-address-btn">
            <i class="fas fa-plus me-2"></i>Add New Address
        </a>
        
        <div class="d-flex justify-content-end">
            <button class="btn btn-custom btn-lg" id="proceedBtn" disabled>
                Proceed to Payment <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </div>
    </div>