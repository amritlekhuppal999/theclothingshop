

    <button 
        class="btn btn-custom btn-lg" 
        id="rzp-button1" 
        disabled>
        Place Order <i class="fas fa-check ms-2"></i>
    </button>


@once

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{env('RAZORPAY_API')}}", // Enter the Key ID generated from the Dashboard
            "amount": "{{ round($orderSummaryData["total_price_after_discount"], 2) }}", // Amount is in currency subunits. 
            "currency": "INR",
            "name": "{{env('APP_NAME')}}", //your business name
            "description": "Test Transaction",
            "image": "https://example.com/your_logo",
            "order_id": "order_9A33XWu170gUtm", // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "callback_url": "",
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
        //debugger;
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>

@endonce