<html>
<head>
    <style>
        table {
            width: 100%;
            margin-top: 30px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <center>
        <img src="{{ asset('public/front/assets/images/Logo-01.png') }}" alt="" width="100" height="80"/>
    </center>

    <table style='border:1px solid #ccc;'>
        <thead>
            <tr>
                <th style="text-align:left;">Customer Details <hr></th>
                <th style="text-align:left;">Shipping info <hr></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width:50%">
                    @foreach ($shows as $inv)
                        <span>Name: </span>{{ $inv->fname }}<br><br>
                        <span>Contact No.: </span>+91 {{ $inv->phone }}<br><br>
                        <span>Email Id: </span>{{ $inv->email }}<br><br>
                        <span>Code: </span>{{ $inv->code }}<br><br>
                    @endforeach
                </td>
                <td>
                    @foreach ($shows as $inv)
                        <span>City: </span>{{ $inv->city }}<br><br>
                        <span>Address: </span>{{ $inv->address_one }}<br><br>
                        <span>Company name: </span>{{ $inv->company_name }}<br><br>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

    <table style="border:1px solid #ccc;">
        <thead>
            <tr><th style="text-align:left;">Payment Details <hr></th></tr>
        </thead>
        <tbody>
            <tr>
                <td style="width:50%">
                    @foreach ($shows as $inv)
                        <span>Order No.: </span>{{ $inv->order_id }}<br><br>
                        <span>Payment status: </span>{{ $inv->payment_status }}<br><br>
                        <span>Order Date: </span>{{ $inv->date }}<br><br>
                    @endforeach
                    @foreach ($details as $dd)
                        <span>Transaction ID: </span>{{ $dd->razorpay_payment_id }}<br><br>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

    @php
        $image = $show->first()->image ?? '';
    @endphp

    @if (empty($image))
        <table>
            <thead style="border:1px solid #ccc">
                <tr>
                    <th>S No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($show as $d)
                    <tr>
                        <td style="border:1px solid #ccc; padding:0px 10px 10px 60px;">{{ $i }}</td>
                        <td style="border:1px solid #ccc; padding:0px 10px 10px 60px;">{{ $d->name }}</td>
                        <td style="border:1px solid #ccc; padding:0px 10px 10px 60px;">
                            INR {{ $d->price }} <br> (Tax: {{ $d->tax }} %)
                        </td>
                    </tr>
                    @php $price = $d->tprice; $i++; @endphp
                @endforeach
                <tr><th colspan="6" style="text-align:right">Total Price: INR {{ $price ?? 0 }}</th></tr>
            </tbody>
        </table>
    @else
        <table>
            <thead style="border:1px solid #ccc">
                <tr>
                    <th>S No</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($show as $d)
                    <tr>
                        <td style="border:1px solid #ccc; padding:0px 10px 10px 35px;">{{ $i }}</td>
                        <td style="border:1px solid #ccc; padding:0px 10px 10px 35px;">{{ $d->name }}</td>
                        <td style="border:1px solid #ccc; padding:0px 10px 10px 35px;">
                            <img src="{{ asset('public/upload/product/' . $d->image) }}" width="100" height="100" alt="Product Image">
                        </td>
                        <td style="border:1px solid #ccc; padding:0px 10px 10px 35px;">
                            INR {{ $d->price }} <br> (Tax: {{ $d->tax }} %)
                        </td>
                    </tr>
                    @php $price = $d->tprice; $i++; @endphp
                @endforeach
                <tr><th colspan="6" style="text-align:right">Total Price: INR {{ $price ?? 0 }}</th></tr>
            </tbody>
        </table>
    @endif

    <div class="text">
        <p>
            NOTE: Your payment for your online Elements placed and has been approved order reference number.
            To get further payment support for your purchase, please sign up using your email address at Mellow Elements.
        </p>
    </div>
</body>
</html>
