
    <div class="col-md-12 col-lg-9">
        
        
    
        @if($orderList->isNotEmpty())
            
            @php $orderArr = $orderList->toArray(); @endphp


            @foreach($orderArr as $orders)
                
                <div class="card card-success card-outline">

                                    
                    <!-- ORDER card header -->
                    <div class="card-header">
                        <div class="row small">
                            <div class="col-md-5 d-flex ">
                                <div class="mr-3">
                                    <span class="text-muted small">ORDER PLACED</span> 
                                    <span class="d-block small text-muted text-bold"> {{ date('jS M Y', strtotime($orders["placed_at"])) }} </span>
                                    
                                </div>

                                <!-- Total Amount -->
                                <div class="mr-3">
                                    <span class="text-muted small">TOTAL</span>
                                    <span class="d-block small text-muted text-bold ">₹{{ $orders["grand_total"] }}</span>
                                </div>

                                <div class="mr-3">
                                    <span class="text-muted small">SHIP TO</span>
                                    <span 
                                        class="d-block text-muted text-bold cursor-pointer small"
                                        data-bs-toggle="popover" data-bs-title="{{ $orders["recp_name"] }}" 
                                        {{-- data-bs-trigger="focus" --}}
                                        data-bs-content="{{ $orders["full_address"] }}">
                                        {{ $orders["recp_name"] }}
                                    </span>
                                </div>
                                {{-- <button type="button" class="btn btn-sm btn-danger" >Click to toggle popover</button> --}}
                            </div>
                            
                            <div class="col-md-7 text-right "> 
                                <span class="text-muted small">
                                    Order Id 
                                    <a href="#" class=" small"> #{{ $orders["order_id"] }}</a>
                                </span>
                                
                                <div class="d-block">
                                    <a href="#" class="text-danger small">View Order Details</a> |
                                    <a href="#" class="text-danger small">Invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER card body -->
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                

                                <h5 class="card-text {{-- $text_type --}}">
                                    <span class="text-success">
                                        Expected Delivery: {{ date('jS M Y ', strtotime($orders["placed_at"] . ' +7 days')) }}
                                    </span>
                                </h5>
                            </div>

                            {{-- @foreach($orderItems as $orderItem)
                                
                                <x-front.orders.order-item :orderItem="$orderItem" />    

                            @endforeach --}}
                            
                            <x-front.orders.order-item :orderItem="$orders['order_items']" />    
                        </div>
                    </div>

                    <!-- ORDER card footer -->
                    <div class="card-footer">
                        {{-- Timeline --}}
                        <button type="button" class="btn btn-sm btn-warning text-white">Track</button> 
                        <button type="button" class="btn btn-sm btn-default text-secondary">View or Edit Order</button>
                        <button type="button" class="btn btn-sm btn-secondary">Feedback</button>
                    </div>
                </div>
                
            @endforeach
            
        @else
            <h1>No orders placed yet.</h1>
        @endif
    

        {{-- DELETE THIS VALUE DUMP --}}
        <div class="card p-2">
            <p class="d-inline-flex gap-1">
                <a 
                    class="btn btn-primary" 
                    data-bs-toggle="collapse" 
                    href="#collapseExample" 
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                    EXPAND VALUE DUMP
                </a>
                {{-- <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Button with data-bs-target
                </button> --}}
            </p>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body">
                    @php
                        echo "<pre>";
                        var_dump($orderList->toArray());
                        echo "</pre>";
                    @endphp
                </div>
            </div>
        </div>
    </div>
