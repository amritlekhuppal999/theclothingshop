


    <div class="card card-success card-outline">
                        
        <!-- ORDER card header -->
        <div class="card-header">
            <div class="row small">
                <div class="col-md-6 d-flex ">
                    <div class="mr-3">
                        <span class="text-muted">ORDER PLACED</span> 
                        <span class="d-block text-muted text-bold"> {{ $orderRec["order_date"] }} </span>
                    </div>

                    <!-- Total Amount -->
                    <div class="mr-3">
                        <span class="text-muted">TOTAL</span>
                        <span class="d-block text-muted text-bold">₹{{ $orderRec["order_total"] }}</span>
                    </div>

                    <div class="mr-3">
                        <span class="text-muted">SHIP TO</span>
                        <span class="d-block text-muted text-bold">{{ $orderRec["shipping_address"] }}</span>
                    </div>
                </div>
                
                <div class="col-md-6 text-right"> 
                    <span class="text-muted">Order Id #{{ $orderRec["order_id"] }}</span>
                    <div class="d-block">
                        <a href="#">View Order Details</a> |
                        <a href="#">Invoice</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ORDER card body -->
        <div class="card-body">
            <div class="row">

                <div class="col-md-12 mb-3">
                    @php
                        $text_type = "text-success";
                        $delivery_message = "Expected delivery on ".$orderRec["expected_delivery"];

                        if($orderRec["status"] == "Delivered"){
                            $text_type = "text-secondary";
                            $delivery_message = "Delivered on ".$orderRec["delivered_on"];
                        }
                        else if($orderRec["status"] == "Cancelled"){
                            $text_type = "text-danger";
                            $delivery_message = "Canceled ";
                        }
                    @endphp

                    <h5 class="card-text {{ $text_type }}">
                        {{ $delivery_message }}
                    </h5>
                </div>

                @php
                    $orderItems = $orderRec["order_items"];
                    #dump($orderItems);
                @endphp

                @foreach($orderItems as $orderItem)
                    
                    <x-front.orders.order-item :orderItem="$orderItem" />    

                @endforeach
            </div>
        </div>

        <!-- ORDER card footer -->
        <div class="card-footer">
            <button type="button" class="btn btn-sm btn-warning text-white">Track</button>
            <button type="button" class="btn btn-sm btn-default text-secondary">View or Edit Order</button>
            <button type="button" class="btn btn-sm btn-secondary">Feedback</button>
        </div>
    </div>