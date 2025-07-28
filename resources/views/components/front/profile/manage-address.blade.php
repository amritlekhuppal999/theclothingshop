
    <style>
        .address-card {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            /*cursor: pointer;*/
            transition: all 0.3s ease;
            position: relative;
        }

        /*.address-card input[type="radio"] {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }*/
    </style>

    <div class="tab-pane {{ (request("page") == "manage-address") ? "active" : "" }}" id="manage_address">
                            
        <div class="card card-secondary">
            <!-- <div class="card-header">
                <h3 class="card-title">Manage Address</h3>
            </div> -->

            <div class="card-body">
                {{-- <h4 class="card-text  mb-3"> Manage Address </h4> --}}
                <h4 class="mb-3"><i class="fas fa-map-marker-alt text-primary me-2"></i>Select Delivery Address</h4>
                
                <div class="row">
                    {{-- @php $userAddress = Collect(); @endphp --}}

                    @if($userAddress->isNotEmpty())
                        @foreach($userAddress as $address)
                            <div class="col-md-12" id="{{$address["id"]}}">
                                <div class="address-card" >
                                    {{-- <input type="radio" name="address" value="home" class="form-check-input "> --}}
                                    <div class="d-flex align-items-start">
                                        <div class="me-3">
                                            {!! getAddressIcon($address["address_type"]) !!}
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ getAddressType($address["address_type"]) }}</h6>
                                            <p class="mb-1 text-muted">{{ $address["name"] }}</p>
                                            
                                            @if(!empty($address["apartment_no"]) || !empty($address["building_no"]) || !empty($address["building_name"]))
                                                <p class="mb-1">{{ $address["apartment_no"] }} {{ $address["building_no"] }} {{ $address["building_name"] }}</p>
                                            @endif
                                            
                                            <p class="mb-1">{{ $address["full_address"] }}</p>
                                            <p class="mb-0 text-muted">{{ $address["city"] }}, {{ $address["state"] }}, {{ $address["pincode"] }}</p>
                                            
                                            {{-- @if($address["primary"])
                                                <small class="text-success"><i class="fas fa-check-circle me-1"></i>Default Address</small>
                                            @endif --}}

                                            <br> <br>

                                            <a href="#" 
                                                class="text-danger mr-3 remove-address" 
                                                data-address_id="{{ $address["id"] }}">
                                                Remove
                                            </a>
                                            

                                            {{-- @if($address["primary"] == 0) @endif --}}
                                            <label class="badge bg-green">
                                                <input 
                                                    type="radio" 
                                                    name="address" value="office" 
                                                    class="set-default-adderss"
                                                    data-address_id="{{ $address["id"] }}"
                                                    {{ ($address["primary"]) ? "checked" : "" }}
                                                />
                                                Set Deafult
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        
                        <div class="col-md-12">
                            <div class="address-card">
                                <h4>No Address added</h4>
                            </div>
                        </div>
                    @endif

                    {{-- ADDRESS 1 --}}
                    <!-- <div class="col-md-12">
                        <div class="address-card" >
                            {{-- <input type="radio" name="address" value="home" class="form-check-input "> --}}
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <i class="fas fa-home text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Home</h6>
                                    <p class="mb-1 text-muted">John Doe</p>
                                    <p class="mb-1">123 Main Street, Apartment 4B</p>
                                    <p class="mb-0 text-muted">New York, NY 10001</p>
                                    <small class="text-success"><i class="fas fa-check-circle me-1"></i>Default Address</small>

                                    <br> <br>

                                    <a href="#" class="text-danger mr-3">Remove</a>
                                    {{-- <label for="" class="badge bg-green">
                                        <input type="radio" name="address" value="office" class="">
                                        Set Deafult
                                    </label> --}}
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- Address 2 -->
                    <!-- <div class="col-md-12">
                        <div class="address-card">
                            
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <i class="fas fa-building text-info" style="font-size: 1.5rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Office</h6>
                                    <p class="mb-1 text-muted">John Doe</p>
                                    <p class="mb-1">456 Business Ave, Suite 200</p>
                                    <p class="mb-0 text-muted">New York, NY 10002</p>
                                    <small class="text-info"><i class="fas fa-clock me-1"></i>9 AM - 6 PM delivery</small>
                                    
                                    <br> <br>

                                    <a href="#" class="text-danger mr-3">Remove</a>
                                    <label for="" class="badge bg-green">
                                        <input type="radio" name="address" value="office" class="">
                                        Set Deafult
                                    </label>
                                </div>
                                
                            </div>
                        </div>
                    </div> -->

                    <!-- Address 3 -->
                    <!-- <div class="col-md-12">
                        <div class="address-card">
                            {{-- <input type="radio" name="address" value="other" class="form-check-input"> --}}
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <i class="fas fa-map-pin text-warning" style="font-size: 1.5rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Other Address</h6>
                                    <p class="mb-1 text-muted">Jane Smith</p>
                                    <p class="mb-1">789 Oak Street</p>
                                    <p class="mb-0 text-muted">Brooklyn, NY 11201</p>
                                    <small class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>Verify phone number</small>

                                    <br> <br>

                                    <a href="#" class="text-danger mr-3">Remove</a>
                                    <label for="" class="badge bg-green">
                                        <input type="radio" name="address" value="office" class="">
                                        Set Deafult
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>

            <div class="mb-2 mr-2 text-right">
                
                <a href="{{ safe_route('profile', ["page" => "add-address"]) }}" class="btn bg-purple">
                    <i class="fas fa-plus"></i>
                    Add New
                </a>
            </div>
        </div>
    
    </div>