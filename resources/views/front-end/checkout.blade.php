    
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
            border: 2px dashed #667eea;
            background: rgba(102, 126, 234, 0.05);
            color: #667eea;
            border-radius: 15px;
            padding: 1.5rem;
            width: 100%;
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

    {{-- select address
        have a default or option to add new

    payment method

        Saved Cards
        Wallet (optional)
        Other
            Chose Credit / Debit Card
            NetBanking
            UPI
            COD / POD
        RAZORPAY

    Delivery Info

    Thankyou / Sorry Page     --}}
    
    

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
                    <div class="checkout-step active" id="step-1">
                        <h4 class="mb-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Select Delivery Address</h4>
                        
                        <div class="address-card" onclick="selectAddress(this)">
                            <input type="radio" name="address" value="home" class="form-check-input">
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
                                </div>
                            </div>
                        </div>
                        
                        <div class="address-card" onclick="selectAddress(this)">
                            <input type="radio" name="address" value="office" class="form-check-input">
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
                                </div>
                            </div>
                        </div>
                        
                        <div class="address-card" onclick="selectAddress(this)">
                            <input type="radio" name="address" value="other" class="form-check-input">
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
                                </div>
                            </div>
                        </div>
                        
                        <button class="add-address-btn" onclick="addNewAddress()">
                            <i class="fas fa-plus me-2"></i>Add New Address
                        </button>
                        
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-custom btn-lg" onclick="proceedToPayment()" id="proceedBtn" disabled>
                                Proceed to Payment <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Payment Selection -->
                    <div class="checkout-step" id="step-2">
                        <h4 class="mb-4"><i class="fas fa-credit-card text-primary me-2"></i>Select Payment Method</h4>
                        
                        <div class="payment-option" onclick="selectPayment(this)">
                            <input type="radio" name="payment" value="card" class="form-check-input me-3">
                            <div class="payment-icon">
                                <i class="fas fa-credit-card text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Credit/Debit Card</h6>
                                <small class="text-muted">Visa, Mastercard, American Express</small>
                            </div>
                        </div>
                        
                        <div class="payment-option" onclick="selectPayment(this)">
                            <input type="radio" name="payment" value="paypal" class="form-check-input me-3">
                            <div class="payment-icon">
                                <i class="fab fa-paypal text-info"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">PayPal</h6>
                                <small class="text-muted">Pay with your PayPal account</small>
                            </div>
                        </div>
                        
                        <div class="payment-option" onclick="selectPayment(this)">
                            <input type="radio" name="payment" value="upi" class="form-check-input me-3">
                            <div class="payment-icon">
                                <i class="fas fa-mobile-alt text-success"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">UPI</h6>
                                <small class="text-muted">Google Pay, PhonePe, Paytm</small>
                            </div>
                        </div>
                        
                        <div class="payment-option" onclick="selectPayment(this)">
                            <input type="radio" name="payment" value="cod" class="form-check-input me-3">
                            <div class="payment-icon">
                                <i class="fas fa-money-bill-wave text-warning"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Cash on Delivery</h6>
                                <small class="text-muted">Pay when you receive your order</small>
                            </div>
                        </div>
                        
                        <div class="order-summary">
                            <h6 class="mb-3"><i class="fas fa-receipt me-2"></i>Order Summary</h6>
                            <div class="summary-item">
                                <span>Subtotal (3 items)</span>
                                <span>$89.97</span>
                            </div>
                            <div class="summary-item">
                                <span>Shipping</span>
                                <span class="text-success">Free</span>
                            </div>
                            <div class="summary-item">
                                <span>Tax</span>
                                <span>$7.20</span>
                            </div>
                            <div class="summary-item summary-total">
                                <span>Total</span>
                                <span class="text-primary">$97.17</span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn btn-outline-secondary btn-lg" onclick="backToAddress()">
                                <i class="fas fa-arrow-left me-2"></i>Back to Address
                            </button>
                            <button class="btn btn-custom btn-lg" onclick="placeOrder()" id="placeOrderBtn" disabled>
                                Place Order <i class="fas fa-check ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
@endsection




@push('scripts') 

    <script>
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

        function selectPayment(option) {
            // Remove selected class from all options
            document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
            // Add selected class to clicked option
            option.classList.add('selected');
            // Check the radio button
            option.querySelector('input[type="radio"]').checked = true;
            // Enable place order button
            document.getElementById('placeOrderBtn').disabled = false;
        }

        function selectAddress(card) {
            // Remove selected class from all cards
            document.querySelectorAll('.address-card').forEach(c => c.classList.remove('selected'));
            // Add selected class to clicked card
            card.classList.add('selected');
            // Check the radio button
            card.querySelector('input[type="radio"]').checked = true;
            // Enable proceed button
            document.getElementById('proceedBtn').disabled = false;
        }
        
        
        
        
        
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
        
        function addNewAddress() {
            alert('Add New Address functionality would open a modal or redirect to address form');
        }
        
        function placeOrder() {
            // Show success animation
            const btn = document.getElementById('placeOrderBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            btn.disabled = true;
            
            setTimeout(() => {
                alert('Order placed successfully! 🎉\n\nOrder ID: #12345\nEstimated delivery: 2-3 business days');
                btn.innerHTML = '<i class="fas fa-check me-2"></i>Order Placed!';
                btn.classList.add('btn-success');
                btn.classList.remove('btn-custom');
            }, 2000);
        }

        document.addEventListener('DOMContentLoaded', event=>{
            const firstAddress = document.querySelector('.address-card');
            selectAddress(firstAddress);
            
            

        });
    </script>
@endpush

{{-- @once @endonce --}}