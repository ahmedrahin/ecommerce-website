<x-default-layout>

    @section('title') Order Invoice @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('invoice') }}

    @endsection
    

    <div class="card">
        <!-- begin::Body-->
        <div class="card-body py-20">
            <!-- begin::Wrapper-->
            <div class="mw-lg-950px mx-auto w-100">
                <!-- begin::Header-->
                <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                    <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>
                    <!--end::Logo-->
                    <div class="text-sm-end">
                        <!--begin::Logo-->
                        <a href="#" class="d-block mw-150px ms-sm-auto">
                            <img alt="Logo" src="{{asset(config('app.logo'))}}" style="width: 100px" />
                        </a>
                        <!--end::Logo-->
                        <!--begin::Text-->
                        <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                            <div>{{config('app.name')}}, {{config('app.address')}}</div>
                            <div>{{config('app.state')}}</div>
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="pb-12">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column gap-7 gap-md-10">
                        <!--begin::Message-->
                        <div class="fw-bold fs-2">Dear {{$order->name}}
                        <span class="fs-6">({{$order->phone}})</span>,
                        <br />
                        <span class="text-muted fs-5">Here are your order details. We thank you for your purchase.</span></div>
                        <!--begin::Message-->
                        <!--begin::Separator-->
                        <div class="separator"></div>
                        <!--begin::Separator-->
                        <!--begin::Order details-->
                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Order ID</span>
                                <span class="fs-5">#{{$order->id}}</span>
                            </div>
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Order Date</span>
                                <span class="fs-5">{{ \Carbon\Carbon::parse($order->order_date)->format('d F, Y') }}</span>
                            </div>
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Time</span>
                                <span class="fs-5">{{ \Carbon\Carbon::parse($order->order_date)->diffForHumans() }}</span>
                            </div>
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Invoice ID</span>
                                <span class="fs-5">#INV-{{$order->id}}</span>
                            </div>
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Shipping method</span>
                                <span class="fs-5">
                                    @if($order->shippingMethod)
                                        @if($order->shippingMethod->base_id)
                                            Inside {{ $order->shippingMethod->District->name }} 
                                        @else
                                            {{ $order->shippingMethod->provider_name }}
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Payment method</span>
                                <span class="fs-5">
                                    {{ $order->payment_type == 'cod' ? 'Cash on delivery' : 'Online Payment' }}
                                </span>
                            </div>
                        </div>
                        <!--end::Order details-->
                        <!--begin::Billing & shipping-->
                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Shipping Address</span>
                                <span class="fs-6">
                                    {{$order->shipping_address}},
                                    {{$order->zip_code ? 'zip-code:'.$order->zip_code : '' }}
                                    <br />{{$order->district->name}}.
                                </span>
                            </div>
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Billing Address</span>
                                <span class="fs-6">
                                    
                                </span>
                            </div>
                        </div>
                        <!--end::Billing & shipping-->
                        <!--begin:Order summary-->
                        <div class="d-flex justify-content-between flex-column">
                            <!--begin::Table-->
                            <div class="table-responsive border-bottom mb-9">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                    <thead>
                                        <tr class="border-bottom fs-6 fw-bold text-muted">
                                            <th class="min-w-175px pb-2">Products</th>
                                            <th class="min-w-70px text-end pb-2">SKU</th>
                                            <th class="min-w-80px text-end pb-2">QTY</th>
                                            <th class="min-w-100px text-end pb-2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">

                                        @foreach( $order->orderItems as $item )
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{route('product-management.show',$item->product->id)}}" class="symbol symbol-50px">
                                                            <span class="symbol-label" style="background-image:url({{asset($item->product->thumb_image)}});"></span>
                                                        </a>

                                                        <div class="ms-5">
                                                            <a href="{{route('product-management.show',$item->product->id)}}" class="text-gray-800 fs-5 fw-bold">{{ $item->product->name }}</a>
                                                            {{-- show varitaion --}}
                                                            @if( $item->orderItemVariations->count() > 0 )
                                                                <div class="fs-7 text-muted">
                                                                    @foreach( $item->orderItemVariations as $itemVariant )
                                                                        {{ucfirst($itemVariant->attribute_name) . ':' . ucfirst($itemVariant->attribute_value)}}  @if (!$loop->last) - @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$item->product->sku_code}}</td>
                                                <td class="text-center">{{$item->quantity}}</td>
                                                <td class="text-center">৳{{$item->price}}</td>
                                                <td class="text-end">৳{{ number_format($item->price * $item->quantity, 2) }}</td>
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
                                            <td colspan="4" class="text-end">Subtotal</td>
                                            <td class="text-end">৳{{ number_format($subtotal, 2) }}</td>
                                        </tr>

                                        @php
                                            $grandTotal = $order->grand_total ?? 0;
                                            $discount = $order->coupon_discount ?? 0;
                                            $discountPercentage = $grandTotal > 0 ? ($discount / $grandTotal) * 100 : 0;
                                        @endphp

                                        <tr>
                                            <td colspan="4" class="text-end">Discount ({{$discountPercentage}}%)</td>
                                            <td class="text-end">
                                                ৳{{ $discount }} 
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="4" class="text-end">Shipping Rate</td>
                                            <td class="text-end">৳{{$order->shipping_cost}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="fs-3 text-dark text-end">Grand Total</td>
                                            <td class="text-dark fs-3 fw-bolder text-end">৳{{ number_format($order->grand_total,2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end:Order summary-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
                <!-- begin::Footer-->
                <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-0" style="margin-top: 0 !important">
                    <!-- begin::Actions-->
                    <div class="my-1 me-5">
                        <!-- begin::Pint-->
                        <button type="button" class="btn btn-success my-1 me-3" onclick="window.print();">Print Invoice</button>
                        <!-- end::Pint-->
                        <!-- begin::Download-->
                        {{-- <button type="button" class="btn btn-light-success my-1">Download</button> --}}
                        <!-- end::Download-->
                    </div>
                    <!-- end::Actions-->
                   
                </div>
                <!-- end::Footer-->
            </div>
            <!-- end::Wrapper-->
        </div>
        <!-- end::Body-->
    </div>


    @push('scripts')
        
    @endpush
</x-default-layout>