@extends('front.layout')
@section('content')

<div class="container" style="margin-top: 250px;">
    <div class="form-group">
        <label for="pay-amount" style="color:black;">Enter Amount Payable (₹)</label>
        <input type="number" id="pay-amount" class="form-control" 
               placeholder="Enter amount" 
               min="{{ $developer_details->perhr * 0.20 }}" 
               max="{{ $developer_details->perhr }}" required>
        <small style="color:black;">Min: ₹{{ $developer_details->perhr * 0.20 }} | Max: ₹{{ $developer_details->perhr }}</small>
    </div>

    <div class="form-group form-check my-2 d-flex align-items-center">
        <input type="checkbox" id="terms-check">
        <label class="form-check-label mb-0" for="terms-check" style="color:black;">
            I agree to the terms and conditions
        </label>
    </div>

    <button id="pay-button" class="btn btn-primary">Pay Now</button>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    document.getElementById('pay-button').onclick = function(e) {
        e.preventDefault();

        const amountInput = document.getElementById('pay-amount');
        const checkbox = document.getElementById('terms-check');
        const amount = parseFloat(amountInput.value);
        const min = parseFloat(amountInput.min);
        const max = parseFloat(amountInput.max);

        if (isNaN(amount) || amount < min || amount > max) {
            alert(`Amount must be between ₹${min.toFixed(2)} and ₹${max.toFixed(2)}.`);
            return;
        }

        if (!checkbox.checked) {
            alert('You must agree to the terms and conditions.');
            return;
        }

        const options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": amount * 100, // Convert to paise
            "currency": "INR",
            "name": "Mellow",
            "description": "Custom Amount Payment",
            "handler": function (response){
               
                fetch("{{ route('developer_payment_initiate') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        dev_id: {{ $developer_details->dev_id}},
                        amount: amount
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = data.redirect;
                    } else {
                        alert('Something went wrong!');
                    }
                });
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        const rzp = new Razorpay(options);
        rzp.open();
    }
</script>

@endsection