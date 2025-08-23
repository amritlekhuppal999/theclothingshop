    
@extends('layouts.pages') 

@section('content-css')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .checkout-container {
            max-width: 800px;
            /*margin: 2rem auto; */
            margin: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .checkout-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            /*margin-top: 1rem;*/
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            opacity: 0.5;
            transition: all 0.3s ease;
        }
        
        .step.active {
            opacity: 1;
            transform: scale(1.1);
        }
        
        .step.completed {
            opacity: 1;
        }
        
        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .step.active .step-circle,
        .step.completed .step-circle {
            background: white;
            color: #667eea;
        }
        
        .checkout-content {
            padding: 2rem;
        }
        
        .checkout-step {
            display: none;
            animation: fadeIn 0.5s ease-in;
        }
        
        .checkout-step.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .address-card {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .address-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
        }
        
        .address-card.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }
        
        .address-card input[type="radio"] {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
        
        .payment-option {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .payment-option:hover {
            border-color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.1);
        }
        
        .payment-option.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }
        
        .payment-icon {
            font-size: 2rem;
            margin-right: 1rem;
            width: 60px;
            text-align: center;
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        .order-summary {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .summary-total {
            border-top: 2px solid #dee2e6;
            padding-top: 1rem;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .add-address-btn {
            display:block;
            text-align: center;
            
            border: 2px dashed #667eea;
            background: rgba(102, 126, 234, 0.05);
            color: #667eea;
            border-radius: 15px;
            padding: 1.5rem;
            width: 100%;
            /*margin-top: 1rem;*/
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .add-address-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: scale(1.02);
        }
    </style>
    
@endsection



@section('content')

    

    {{-- @php
        var_dump($orderSummaryData);
    @endphp --}}

    {{-- @dd(session()->get('web'))  --}}

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            {{-- breadcrumb --}}
            <x-front.breadcrumb>
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </x-front.breadcrumb>

            
            <div class="checkout-container">
                
                <div class="checkout-header">
                    {{-- <h2><i class="fas fa-shopping-cart me-2"></i>Checkout</h2> --}}
                    <div class="step-indicator">
                        <div class="step active" data-step="1">
                            <div class="step-circle">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <small>Address</small>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-circle">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <small>Payment</small>
                        </div>
                    </div>
                </div>
                
                <div class="checkout-content">
                    <!-- Step 1: Address Selection -->
                    <x-front.checkout.select-address />
                    
                    <!-- Step 2: Payment Selection -->
                    <x-front.checkout.payment-method :orderSummaryData="$orderSummaryData" />
                </div>
            </div>

           
        </div>
    </div>
@endsection
{{-- $total_discount_amount = round($orderSummaryData["total_price_after_discount"], 2); --}}



@push('scripts') 

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', event=>{
            const firstAddress = document.querySelector('.address-card');
            //selectAddress(firstAddress);
            
            let ADDRESS_SECTION = document.getElementById('step-1');
            let SELECT_PAYMENT_SECTION = document.getElementById('step-2');
            
            let PLACE_ORDER_BTN = document.getElementById('place-order');



            ADDRESS_SECTION.addEventListener('click', event=>{
                
                let element = event.target;

                // select address
                if(element.className.includes("address-card")){
                    selectAddress(element);
                }

                // proceede to payment section
                if(element.id == "proceedBtn"){
                    proceedToPayment();
                }
            });


            SELECT_PAYMENT_SECTION.addEventListener('click', event=>{
                
                let element = event.target;
                
                // select payment type
                if(element.className.includes("payment-option")){
                    selectPayment(element);
                }

                // proceede to payment section
                if(element.id == "back-to-address"){
                    backToAddress();
                }
            });

            PLACE_ORDER_BTN.addEventListener('click', event=>{
                createOrder(PLACE_ORDER_BTN);
            });

            // create razorpay payment order
            async function createOrder (PLACE_ORDER_BTN){

                btn_backup = PLACE_ORDER_BTN.innerHTML;
                PLACE_ORDER_BTN.innerHTML = `processing... ${MyApp.LOADER_SMALL}`;
                PLACE_ORDER_BTN.disabled = true;
                //return false;

                let address_input = document.querySelectorAll('[name="address"]');
                address_input = Array.from(address_input).filter(element => element.checked === true);
                address_id = address_input[0].value;

                
                let totalAmt = document.getElementById("total-amount").innerText;

                const request_data = {
                    address_id: address_id,
                    amount: totalAmt,
                };
                const params = new URLSearchParams(request_data);
                
                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };
        
                let url = 'create-order?'+params;
                
                //console.log(url);
                //return false;
        
                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    console.log(response_data);

                    if(response_data.code === 200){
                        let payment_order_data = response_data.order;
                        PLACE_ORDER_BTN.remove();
                        makePayment(payment_order_data);
                    }

                    else {
                        toastr.danger(response_data.message);
                        PLACE_ORDER_BTN.innerHTML = btn_backup;
                        PLACE_ORDER_BTN.disabled = false;
                    }

                    //return response_data;
                }
                catch(error){   // Handles Network Errors
                    console.error('Error:', error);
                    PLACE_ORDER_BTN.innerHTML = btn_backup;
                    PLACE_ORDER_BTN.disabled = false;
                }
            }

            //launch the razorpay payment UI and method
            function makePayment(payment_order_data){

                var options = {
                    "key": "{{env('RAZORPAY_API')}}", // Enter the Key ID generated from the Dashboard
                    "amount": payment_order_data.amount, // Amount is in currency subunits. 
                    "currency": payment_order_data.currency,
                    "name": "{{env('APP_NAME')}}", //your business name
                    "description": "Test Transaction",
                    "image": "{{env('APP_NAME')}}",
                    "order_id": payment_order_data.id, 
                    "callback_url": "{{ safe_route('payment-callback') }}",
                    //"callback_url": "",
                    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                        "name": "{{ session()->get('web.name') }}", //your customer's name
                        "email": "{{ session()->get('web.email') }}",
                        "contact": "{{ session()->get('web.phone_no') }}" //Provide the customer's phone number for better conversion rates 
                    },
                    "notes": {
                        "address": "Razorpay Corporate Office"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                //console.log(options); 
                var rzp1 = new Razorpay(options);
                rzp1.open();
            }
            
            // display payment section
            function proceedToPayment() {
                // Hide step 1, show step 2
                document.getElementById('step-1').classList.remove('active');
                document.getElementById('step-2').classList.add('active');
                
                // Update step indicators
                document.querySelector('[data-step="1"]').classList.add('completed');
                document.querySelector('[data-step="1"]').classList.remove('active');
                document.querySelector('[data-step="2"]').classList.add('active');
                
                // Change completed step icon to checkmark
                document.querySelector('[data-step="1"] .step-circle').innerHTML = '<i class="fas fa-check"></i>';
            }

            // select payment type
            function selectPayment(option) {
                
                // Remove selected class from all options
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                // Add selected class to clicked option
                option.classList.add('selected');
                // Check the radio button
                option.querySelector('input[type="radio"]').checked = true;
                // Enable place order button
                document.getElementById('place-order').disabled = false;
            }

            // select address 
            function selectAddress(card) {
                console.log("function call");
                // Remove selected class from all cards
                document.querySelectorAll('.address-card').forEach(c => c.classList.remove('selected'));
                // Add selected class to clicked card
                card.classList.add('selected');
                // Check the radio button
                card.querySelector('input[type="radio"]').checked = true;
                // Enable proceed button
                document.getElementById('proceedBtn').disabled = false;
            }
            
            // go back to address selection section            
            function backToAddress() {
                // Hide step 2, show step 1
                document.getElementById('step-2').classList.remove('active');
                document.getElementById('step-1').classList.add('active');
                
                // Update step indicators
                document.querySelector('[data-step="2"]').classList.remove('active');
                document.querySelector('[data-step="1"]').classList.add('active');
                document.querySelector('[data-step="1"]').classList.remove('completed');
                
                // Change step 1 icon back to map marker
                document.querySelector('[data-step="1"] .step-circle').innerHTML = '<i class="fas fa-map-marker-alt"></i>';
            }
            
            // old place order function
            function placeOrderX() {
                // Show success animation
                const btn = document.getElementById('place-order');
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                btn.disabled = true;
                
                setTimeout(() => {
                    alert('Order placed successfully! 🎉\n\nOrder ID: #12345\nEstimated delivery: 2-3 business days');
                    btn.innerHTML = '<i class="fas fa-check me-2"></i>Order Placed!';
                    btn.classList.add('btn-success');
                    btn.classList.remove('btn-custom');
                }, 2000);
            }
        });



        
    </script>

    
    
@endpush

{{-- @once @endonce --}}