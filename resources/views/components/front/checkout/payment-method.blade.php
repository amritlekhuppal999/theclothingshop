    
    @php
        //var_dump($orderSummaryData);
        $total_discount_amount = round($orderSummaryData["total_price_after_discount"], 2);
    @endphp
    
    <div class="checkout-step" id="step-2">
        {{-- <h4 class="mb-4"><i class="fas fa-credit-card text-primary me-2"></i>Select Payment Method</h4> --}}
        
        
        {{-- <div class="payment-option" >
            <input type="radio" name="payment" value="card" class="form-check-input me-3">
            <div class="payment-icon">
                <i class="fas fa-credit-card text-primary"></i>
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-1">Credit/Debit Card</h6>
                <small class="text-muted">Visa, Mastercard, American Express</small>
            </div>
        </div>
        
        <div class="payment-option" >
            <input type="radio" name="payment" value="paypal" class="form-check-input me-3">
            <div class="payment-icon">
                <i class="fab fa-paypal text-info"></i>
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-1">PayPal</h6>
                <small class="text-muted">Pay with your PayPal account</small>
            </div>
        </div>
        
        <div class="payment-option" >
            <input type="radio" name="payment" value="upi" class="form-check-input me-3">
            <div class="payment-icon">
                <i class="fas fa-mobile-alt text-success"></i>
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-1">UPI</h6>
                <small class="text-muted">Google Pay, PhonePe, Paytm</small>
            </div>
        </div> --}}
        
        {{-- <div class="payment-option" >
            <input type="radio" name="payment" value="cod" class="form-check-input me-3">
            <div class="payment-icon">
                <i class="fas fa-money-bill-wave text-warning"></i>
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-1">Cash on Delivery</h6>
                <small class="text-muted">Pay when you receive your order</small>
            </div>
        </div> --}}
        
        
        {{-- ORDER SUMMARY --}}
        <h4 class="mb-4"><i class="fas fa-receipt text-primary me-2"></i>Order Summary</h4>
        <div class="order-summary">
            {{-- <h6 class="mb-3"><i class="fas fa-receipt me-2"></i>Order Summary</h6> --}}
            <div class="summary-item">
                <span>Subtotal (3 items)</span>
                <span class="" >
                    {{ $total_discount_amount }}
                </span>
            </div>
            <div class="summary-item">
                <span>Shipping</span>
                <span class="text-success">Free</span>
            </div>
            {{-- <div class="summary-item">
                <span>Tax</span>
                <span>$7.20</span>
            </div> --}}
            <div class="summary-item summary-total">
                <span>Total</span>
                <span class="text-primary" id="total-amount">
                    {{ $total_discount_amount }}
                </span>
            </div>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-outline-secondary btn-lg" 
                {{-- onclick="backToAddress()" --}}
                id="back-to-address">
                <i class="fas fa-arrow-left me-2"></i>Back to Address
            </button>
            
            
            <button 
                class="btn btn-custom btn-lg" 
                {{-- id="rzp-button1"  --}}
                id="place-order" >
                Place Order <i class="fas fa-check ms-2"></i>
            </button>
            
            {{-- RAJORPAY PAYMENT GATEWAY BTN --}}
            {{-- <x-front.razorpay.make-payment :orderSummaryData="$orderSummaryData" /> --}}
        </div>
    </div>