@extends('frontend.layout.app')
    
@section('page-title')
    Checkout Successful | {{config('app.name')}}
@endsection

@section('page-css')
    <style>
        .btn-coupon span{
          color: white;
          font-size: 15px;
        }
        .cart-btn{
            display: none;
        }
    </style>
@endsection

    
@section('body-content')

    <section class="section-b-space py-0 mb-5">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 px-0"> 
            <div class="order-box-1"><img src="{{asset('frontend/images/gif/success.gif')}}" alt="">
                <h4>Thank you, We've received your order.</h4>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section>
        <div class="custom-container container order-success">
        <div class="row gy-4">
            <div class="col-xl-8"> 
            <div class="order-items sticky"> 
                <h4>Order Information </h4>
            
                <div class="order-table"> 
                <div class="table-responsive theme-scrollbar">  
                    <table class="table">
                    <thead>
                        <tr> 
                        <th>Product </th>
                        <th>Price </th>
                        <th>Quantity</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <tbody> 

                        @foreach( $order->orderItems as $item )
                            <tr> 
                            <td> 
                                <div class="cart-box">
                                    <a href="{{route('product-details',$item->product->slug)}}">
                                        <img src="{{asset($item->product->thumb_image)}}" >
                                    </a>
                                <div>
                                    <a href="{{route('product-details',$item->product->slug)}}"> 
                                        <h5>{{$item->product->name}}</h5>
                                    </a>

                                    {{-- show varitaion --}}
                                    @if( $item->orderItemVariations->count() > 0 )
                                        <p class="mb-0">
                                            @foreach( $item->orderItemVariations as $itemVariant )
                                                {{ucfirst($itemVariant->attribute_name) . ':' . ucfirst($itemVariant->attribute_value)}}  @if (!$loop->last) - @endif
                                            @endforeach
                                        </p>
                                    @endif
                                </div>
                                </div>
                            </td>
                            <td>৳{{$item->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>৳{{$item->price * $item->quantity}}.00</td>
                            </tr>
                        @endforeach

                        @php
                            $subtotal = 0;
                        @endphp

                        @foreach($order->orderItems as $item)
                            @php
                                $subtotal += $item->price * $item->quantity;
                            @endphp
                        @endforeach

                        <tr> 
                        <td> </td>
                        <td></td>
                        <td class="total fw-bold">Total : </td>
                        <td class="total fw-bold">৳{{ number_format($subtotal, 2) }}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-4">
            <div class="summery-box">
                <div class="sidebar-title">
                <div class="loader-line"></div>
                <h4>Order Details </h4>
                </div>
                <div class="summery-content"> 
                <ul> 
                    <li> 
                        <p class="fw-semibold">Product total ({{$order->orderItems->sum('quantity')}})Psc</p>
                        <h6>৳{{ number_format($subtotal, 2) }}</h6>
                    </li>
                    
                </ul>
                <ul> 
                    <li> 
                        <p>shipping Costs</p><span>৳{{$order->shipping_cost}}</span>
                    </li>
                    <li> 
                        <p>Discount</p><span>৳{{$order->coupon_discount}}</span>
                    </li>
                </ul>
                <div class="d-flex align-items-center justify-content-between">
                    <h6>Total (USD)</h6>
                    <h5>${{ number_format($order->grand_total,2)}}</h5>
                </div>
                
                </div>
            </div>
            <div class="summery-footer"> 
                <div class="sidebar-title">
                <div class="loader-line"></div>
                <h4>Shipping Address</h4>
                </div>
                <ul> 
                <li> 
                    <h6>{{$order->shipping_address}},</h6>
                    <h6>{{$order->district->name}}</h6>
                </li>
                {{-- <li> 
                    <h6>Expected Date Of Delivery: <span>Track Order</span></h6>
                </li> --}}
                <li> 
                    <h5>{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</h5>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </div>
        {{-- <button>Download Invoice</button> --}}
  </section>
 
@endsection 
    
@section('page-script')
  
 {{-- messages --}}
 @if (session('success'))
    <script>
        Toastify({
                text: "{{ session('success') }}",
                duration: 3000
            }).showToast();
    </script>
@endif

@endsection