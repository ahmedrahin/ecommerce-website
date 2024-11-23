
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>

    <!-- ========== logo css ========== -->
    <link rel="icon" href="{{asset(config('app.favicon'))}}">

    <!-- ========== fonts css ========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Outfit", sans-serif;
        }
    </style>
        
</head>

<body style="margin: 20px auto;width: 650px; overflow-x: auto; ">

    <table align="center" border="0" cellpadding="0" cellspacing="0" style="background-color:rgba(204, 162, 112, 0.05); position: relative;  background-image: url(./img/bg.png); background-size: cover; background-repeat: no-repeat;  width: 100%; padding: 30px; box-shadow: 0 0 13px rgba(0, 0, 0, 0.055);">
        <tbody >
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr style="width: 100%;">
                            <td>
                                <a href="{{url('/')}}" style=" text-align: left;">
                                    <img src="{{asset(config('app.logo'))}}" style="width: 100px; height:40px;  object-fit: contain;"
                                        alt="logo">
                                </a>
                            </td>
                        </tr>
                        <tr style="position: absolute; top: 0; right: 30px; text-align: center; padding: 10px; background-color: #cca170;">
                            <td style="display: block;text-transform: uppercase; font-size: 20px; color: #fff;">
                                <h4 style="margin: 0%; line-height: 1;">invoice</h4>
                                <h6
                                    style="margin: 0%; line-height: 1; padding-top: 3px; font-size: 14px; font-weight: 500; color: #fff;">
                                    #inv-{{$order->id}}</h6>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; margin-top: 20px; background-color: #cca270; padding: 6px;">
                        <tr>
                            <td style="width: 50%;">
                                <h4 style="margin: 0 0 10px; line-height: 1.3; color: #fff; text-transform: uppercase;">invoice to :</h4>
                                <h5
                                    style="margin: 0%; line-height: 1.3; letter-spacing: 0.3px; color: #fff; font-size: 15px; font-weight: 500;">
                                    {{$order->shipping_address}},</h5>
                                <h5
                                    style="margin: 0%; line-height: 1.3; letter-spacing: 0.3px; color: #fff;
                                    font-size: 15px; font-weight: 500;">
                                    {{$order->district->name}}</h5>
                                
                            </td>
                            @php
                                $formattedDate = \Carbon\Carbon::parse($order->order_date)->format('d/m/Y');
                            @endphp
                            <td style="width: 50%; padding:15px 20px;">
                                <h6 style="margin: 0%; font-size: 17px; text-transform: capitalize; color: #fff; line-height: 1.4;">date :
                                    <span style=" line-height: 1.4; font-size: 15px; font-weight: 500; color: #fff;">
                                    {{$formattedDate}}</span>
                                </h6>
                                <h6 style="margin: 0; font-size: 17px; text-transform: capitalize; color: #fff; ">
                                    name : <span style="line-height: 1.4; font-size: 15px; font-weight: 500; color: #fff; text-transform: uppercase;">{{$order->name}}</span>
                                </h6>
                                <h6 style="margin: 0; font-size: 17px; text-transform: capitalize; color: #fff; ">
                                    Phone : <span style="line-height: 1.4; font-size: 15px; font-weight: 500; color: #fff; text-transform: uppercase;">{{$order->phone}}</span>
                                </h6>
                                @if( $order->email )
                                    <h6 style="margin: 0; font-size: 17px; text-transform: capitalize; color: #fff;  line-height: 1.4;">
                                        email : <span style="line-height: 1; font-size: 15px; font-weight: 500; color: #fff;">{{ $order->email}}</span>
                                    </h6>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellpadding="10" cellspacing="0"
                        style="margin: 40px 0 0px; vertical-align:middle;">
                        <thead>
                            <tr>
                                <th
                                    style="text-transform: uppercase; color: #cca270; font-weight: 700; line-height: 1; font-size: 17px; border-bottom: 2px solid #cca270; padding: 14px 0;">
                                    no</th>
                                <th
                                    style="text-transform: uppercase; color: #cca270; font-weight: 700; line-height: 1; font-size: 17px; border-bottom: 2px solid #cca270; padding: 14px 0;">
                                    product name </th>
                                <th
                                    style="text-transform: uppercase; color: #cca270; font-weight: 700; line-height: 1; font-size: 17px; border-bottom: 2px solid #cca270; padding: 14px 0;">
                                    price</th>
                                <th
                                    style="text-transform: uppercase; color: #cca270; font-weight: 700; line-height: 1; font-size: 17px; border-bottom: 2px solid #cca270; padding: 14px 0;">
                                    QTY</th>
                                <th
                                    style="text-transform: uppercase; color: #cca270; font-weight: 700; line-height: 1; font-size: 17px; border-bottom: 2px solid #cca270; padding: 14px 0;">
                                    total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $order->orderItems as $id => $item )
                                <tr>
                                    <td style="text-align: center; font-weight: 600;">{{$id+1}}</td>
                                    <td style="text-align: center;">
                                        <h5 style="margin: 0; line-height: 1.3; font-size: 17px; text-transform: capitalize;">
                                            <a href="{{route('product-details',$item->product->slug)}}" style="text-decoration: none; color:black;">
                                                {{ $item->product->name }}
                                            </a>
                                        </h5>
                                        
                                    </td>
                                    <td style="text-align: center; font-weight: 500; font-size: 14px;">৳{{$item->price}}</td>
                                    <td style="text-align: center; font-weight: 500; font-size: 14px;">{{$item->quantity}}</td>
                                    <td style="text-align: center; font-weight: 500; font-size: 14px;">৳{{$item->price * $item->quantity}}.00</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table width="100%">
                        <tr style="display: flex; justify-content: space-between; gap: 80px;">
                            <td width="50%">

                            </td>
                            <td width="50%">
                                <table width="100%" cellpadding="10">
                                    <tr style="display: flex; justify-content: space-between; text-align: end;">
                                        @php
                                            $subtotal = 0;
                                        @endphp

                                        @foreach($order->orderItems as $item)
                                            @php
                                                $subtotal += $item->price * $item->quantity;
                                            @endphp
                                        @endforeach

                                        @php
                                            $grandTotal = $order->grand_total ?? 0;
                                            $discount = $order->coupon_discount ?? 0;
                                            $discountPercentage = $subtotal > 0 ? ($discount / $subtotal) * 100 : 0;
                                        @endphp
                                        <td>
                                            <h5 style="margin: 0%; font-size: 16px; line-height: 1.5; color: #6e6d6d;">Sub Total :</h5>
                                            <h5
                                                style="margin: 0%; font-size: 16px; line-height: 1.5; color: #6e6d6d; text-transform: capitalize;">
                                                Shipping cost :</h5>
                                            <h5
                                                style="margin: 0%; font-size: 16px; line-height: 1.5; color: #6e6d6d; text-transform: capitalize;">
                                                discount {{round($discountPercentage)}}% :
                                            </h5>
                                        </td>
                                        <td>
                                            <h5 style="margin: 0%; font-size: 17px; text-align: start; line-height: 1.5;">
                                                ৳{{$subtotal}}.00
                                            </h5>
                                            <h5 style="margin: 0%; font-size: 17px; text-align: start; line-height: 1.5;">
                                                ৳{{$order->shipping_cost}}
                                            </h5>
                                            <h5 style="margin: 0%; font-size: 17px; text-align: start; line-height: 1.5;">
                                                ৳{{$discount}}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr
                                        style="display: flex; justify-content: space-between; background-color: #cca270; text-align: end; margin-top: 10px;">
                                        <td>
                                            <h5
                                                style="margin: 0%; font-size: 18px; line-height: 1; text-transform: capitalize; color: #fff;">
                                                grand total:
                                            </h5>
                                        </td>
                                        <td>
                                            <h5 style="margin: 0%; font-size: 19px; text-align: start; line-height: 1; color: #fff;">
                                                ৳{{ number_format($order->grand_total,2)}}
                                            </h5>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" style="margin-top: 20px;">
                        <tr style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                            <td style="width: 50%;">
                                <img src="img/signature.svg" width="100px" style="object-fit: contain;" alt="">
                                <button onclick="window.print()" style="padding: 10px 20px; background-color: #cca270; color: white; border: none; cursor: pointer;">
                                    Print Invoice
                                </button>
                                
                            </td>
                            <td>
                                
                                <table width="100%">
                                    <tr style="display: flex;  justify-content: space-between; gap: 10px;">
                                        <td
                                            style="display: flex; align-items: center; gap: 5px; font-weight: 400; color: #6e6d6d;">
                                            <img src="img/phone.svg" width="16px" alt="">{{config('app.phone')}}
                                        </td>
                                        <td
                                            style="display: flex; align-items: center; gap: 5px; font-weight: 400; color: #6e6d6d;">
                                            <img src="img/mail.svg" width="16px" alt="">{{config('app.email')}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>