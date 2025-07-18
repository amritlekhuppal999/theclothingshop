@php
    $cartSummary = $cartSummary[0];
    $total_price_before_discount = round($cartSummary["total_price_before_discount"], 2);
    $total_discount_amount = round($cartSummary["total_discount_amount"], 2);
    $total_price_after_discount = round($cartSummary["total_price_after_discount"], 2);
@endphp

{{-- <pre>
    @php
        var_dump($cartSummary);
    @endphp
</pre> --}}


    <div class="cart-sidebar">
        <div class="cart-summary">
            {{-- <h2 class="cart-title">CART</h2> --}}
            
            <div class="coupon-section">
                <input type="text" class="form-control" placeholder="Apply Coupon (Coming soon)">
            </div>
            
            <div class="voucher-section">
                <input type="text" class="form-control" placeholder="Gift Voucher (Coming soon)">
            </div>
            
            <div class="gift-wrap-section">
                <div class="form-check">
                    <input class="form-check-input gift-wrap-checkbox" type="checkbox" id="giftWrap" checked>
                    <label class="form-check-label gift-wrap-label" for="giftWrap">
                        Gift Wrap
                    </label>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Billing Details</h5>
                
                <div class="summary-row">
                    <span>Cart Total</span>
                    <span>₹ {{ $total_price_before_discount }}</span>
                </div>
                
                <div class="summary-row">
                    {{-- <span>Discount</span> --}}
                    <span>Saved</span>
                    <span class="discount-amount">- ₹ {{ $total_discount_amount }}</span>
                </div>
                
                {{-- <div class="summary-row">
                    <span>GST</span>
                    <span class="gst-amount">₹ 611.54</span>
                </div> --}}
                
                <div class="summary-row">
                    <span>Shipping Charges</span>
                    <span>₹ 0</span>
                </div>
                
                <div class="summary-row total">
                    <span>Total Amount</span>
                    <span>₹ {{ $total_price_after_discount }} </span>
                </div>
            </div>
            
            <button class="btn-checkout">Checkout</button>
        </div>
    </div>