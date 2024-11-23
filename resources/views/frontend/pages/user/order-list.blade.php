<div class="dashboard-right-box">
    <div class="order">
    <div class="sidebar-title">
        <div class="loader-line"></div>
        <h4>My Orders History</h4>
    </div>
    <div class="row gy-4"> 
       
        @foreach( $user->orders as $order )
            <div class="col-12">
                <div class="order-box">
                    <div class="order-container"> 
                    <div class="order-icon"><i class="iconsax" data-icon="box"></i>
                        @if( $order->delivery_status == 'Complete' )
                        <div class="couplet"><i class="fa-solid fa-check"></i></div>
                        @elseif($order->delivery_status == 'Cancelled')
                        <div class="couplet" style="background: #ff0000ba;"><i class="fa-solid fa-xmark"></i></div>
                        @else
                        <div class="couplet"><i class="fa-solid fa-xmark"></i></div>
                        @endif
                    </div>
                    <div class="order-detail"> 
                        <h5>{{$order->delivery_status}}</h5>
                        @php
                            $formattedDate = \Carbon\Carbon::parse($order->order_date)->format('D, j M Y');
                        @endphp
                        <p>on {{$formattedDate}}</p>
                    </div>
                    </div>
                    <div class="product-order-detail"> 
                    <div class="product-box">
                        <div class="order-wrap">
                        <h5 style="font-size: 18px;">Order Id: #{{$order->id}}</h5>
                        <ul> 
                            <li> 
                            <p>Total : </p><span> ৳{{$order->grand_total}}</span>
                            </li>
                            <li> 
                            <p>Total Quantity : </p><span> {{$order->orderItems->sum('quantity')}}</span>
                            </li>
                            <li> 
                            <p>Payment Type : </p><span>
                                @if( $order->payment_type == 'cod' )
                                    Cash on delivery
                                @else
                                    Online Payment
                                @endif
                            </span>
                            </li>
                            <li> 
                                <p>Transaction_id : </p><span>{{$order->transaction_id}}</span>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </div>
                    <div class="return-box">
                    <div class="review-box">
                        <div></div>
                        <div class="invoice-box">
                            <a href="{{route('order.invoice', $order->id)}}" target="_blank">Invoice</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    </div>
</div>