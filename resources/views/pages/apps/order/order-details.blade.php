<x-default-layout>

    @section('title') Order Details @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('order') }}

    @endsection
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .order-items-bx {
            max-height: 320px;
            overflow-y: scroll;
            padding-right: 15px; /* Create space for the scrollbar */
        }

        /* Hide scrollbar by default for WebKit browsers (Chrome, Safari, Edge) */
        .order-items-bx::-webkit-scrollbar {
            width: 0;  /* Hide scrollbar by default */
        }

        .order-items-bx::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 10px;
        }

        .order-items-bx::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }

        /* For Firefox */
        .order-items-bx {
            scrollbar-width: none; /* Hide scrollbar by default */
        }

        .order-items-bx:active {
            scrollbar-width: thin; /* Show a thin scrollbar when scrolling */
        }
        .delivery-time {
            font-weight: 600;
            color: #ff000087;
            font-size: 13px;
        }
        .download-btn .btn-success{
            margin-right: 3px !important;
        }
        .download-btn i {
            padding: 0;
        }
        .download-btn{
            position: absolute;
            bottom: 15px;
            right: 15px;
        }
        .download-btn a {
            padding: 6px 10px !important;
        }
    </style>

    <!--begin::Content-->
   
        <!--begin::Content container-->
        
        <!--begin::Order details page-->
        <div class="d-flex flex-column gap-7 gap-lg-10">
            <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_summary">Order Summary</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    {{-- <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_history">Order History</a>
                    </li> --}}
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Button-->
                <a href="{{route('order-management.order.index')}}" class="btn btn-icon btn-light btn-active-secondary btn-sm ms-auto me-lg-n7">
                    <i class="ki-duotone ki-left fs-2"></i>
                </a>
                <!--end::Button-->
                <!--begin::Button-->
                <a href="{{route('order-management.order.edit', $order->id)}}" class="btn btn-success btn-sm me-lg-n7">Edit Order</a>
                <!--end::Button-->
                <!--begin::Button-->
                <a href="{{route('order-management.order.create')}}" class="btn btn-primary btn-sm">Add New Order</a>
                <!--end::Button-->
            </div>
            <!--begin::Order summary-->
            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                <!--begin::Order details-->
                <div class="card card-flush py-4 flex-row-fluid order-items-bx">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Order Details (#{{$order->id}})</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-calendar fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Order Date</div>
                                        </td>
                                        <td class="fw-bold text-end">{{ \Carbon\Carbon::parse($order->order_date)->format('m/d/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-wallet fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>Payment Method</div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            {{ $order->payment_type == 'cod' ? 'Cash on delivery' : 'Online' }}
                                            @php
                                                $paymentImg = $order->payment_type == 'cod' 
                                                    ? 'assets/media/payment-methods/cod.png' 
                                                    : 'assets/media/payment-methods/visa.svg';
                                            @endphp
                                            <img src="{{asset($paymentImg)}}" class="w-40px ms-2" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-truck fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>Shipping Method</div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            @if($order->shippingMethod)
                                                @if($order->shippingMethod->base_id)
                                                    Inside {{ $order->shippingMethod->District->name }} - {{ $order->shipping_cost }} tk
                                                @else
                                                    {{ $order->shippingMethod->provider_name }} - {{ $order->shipping_cost }} tk
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-time fs-2 me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            </i>Time</div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            {{ \Carbon\Carbon::parse($order->order_date)->diffForHumans() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-two-credit-cart fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>Transaction_id</div>
                                        </td>
                                        <td class="fw-bold text-end">{{$order->transaction_id ?? '-'}}</td>
                                    </tr>
                                    @if( !is_null($order->coupon_code) )
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-discount fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>Coupon Code</div>
                                            </td>
                                            <td class="fw-bold text-end">

                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-watch fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Issue Date</div>
                                        </td>
                                        <td class="fw-bold text-end">12-09-24</td>
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Order details-->
                <!--begin::Customer details-->
                <div class="card card-flush py-4 flex-row-fluid">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Customer Details</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-profile-circle fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>Customer</div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                    <a href="">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-23.jpg" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Name-->
                                                <a href="" class="text-gray-600 text-hover-primary">{{ $order->name }}</a>
                                                <!--end::Name-->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-sms fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Email</div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            <a href="mailto:{{$order->email ?? '-'}};" class="text-gray-600 text-hover-primary">{{$order->email ?? '-'}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-phone fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Phone</div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            <a href="tel:{{$order->phone}}" class="text-gray-600 text-hover-primary">
                                                {{$order->phone}}
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Customer details-->
                <!--begin::Documents-->
                <div class="card card-flush py-4 flex-row-fluid">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Documents</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-devices fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>Invoice
                                            <span class="ms-1" data-bs-toggle="tooltip" title="View the invoice generated by this order.">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span></div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            <a href="../../demo1/dist/apps/invoices/view/invoice-3.html" class="text-gray-600 text-hover-primary">#INV-000414</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-truck fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>Shipping
                                            <span class="ms-1" data-bs-toggle="tooltip" title="View the shipping manifest generated by this order.">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span></div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">#SHP-0025410</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-discount fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Reward Points
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Reward value earned by customer when purchasing this order">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span></div>
                                        </td>
                                        <td class="fw-bold text-end">600</td>
                                    </tr>

                                    <div class="download-btn">
                                        <a href="" target="_blank" class="btn btn-success btn-sm me-lg-n7"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                                    </div>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Documents-->
            </div>
            <!--end::Order summary-->
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                    <!--begin::Orders-->
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                            <!--begin::Payment address-->
                            <div class="card card-flush py-4 flex-row-fluid position-relative">
                                <!--begin::Background-->
                                <div class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                    <i class="ki-solid ki-two-credit-cart" style="font-size: 14em"></i>
                                </div>
                                <!--end::Background-->
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Billing Address</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">Unit 1/23 Hastings Road,
                                <br />Melbourne 3000,
                                <br />Victoria,
                                <br />Australia.</div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Payment address-->
                            <!--begin::Shipping address-->
                            <div class="card card-flush py-4 flex-row-fluid position-relative">
                                <!--begin::Background-->
                                <div class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                    <i class="ki-solid ki-delivery" style="font-size: 13em"></i>
                                </div>
                                <!--end::Background-->
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Shipping Address</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">Unit 1/23 Hastings Road,
                                <br />Melbourne 3000,
                                <br />Victoria,
                                <br />Australia.</div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Shipping address-->
                        </div>
                        <!--begin::Product List-->
                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Order #14534</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-175px">Product</th>
                                                <th class="min-w-100px text-end">SKU</th>
                                                <th class="min-w-70px text-end">Qty</th>
                                                <th class="min-w-100px text-end">Unit Price</th>
                                                <th class="min-w-100px text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                                                            <span class="symbol-label" style="background-image:url(assets/media//stock/ecommerce/1.png);"></span>
                                                        </a>
                                                        <!--end::Thumbnail-->
                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="fw-bold text-gray-600 text-hover-primary">Product 1</a>
                                                            <div class="fs-7 text-muted">Delivery Date: 19/07/2023</div>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <td class="text-end">02315008</td>
                                                <td class="text-end">2</td>
                                                <td class="text-end">$120.00</td>
                                                <td class="text-end">$240.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                                                            <span class="symbol-label" style="background-image:url(assets/media//stock/ecommerce/100.png);"></span>
                                                        </a>
                                                        <!--end::Thumbnail-->
                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="fw-bold text-gray-600 text-hover-primary">Footwear</a>
                                                            <div class="fs-7 text-muted">Delivery Date: 19/07/2023</div>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <td class="text-end">02364003</td>
                                                <td class="text-end">1</td>
                                                <td class="text-end">$24.00</td>
                                                <td class="text-end">$24.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">Subtotal</td>
                                                <td class="text-end">$264.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">VAT (0%)</td>
                                                <td class="text-end">$0.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">Shipping Rate</td>
                                                <td class="text-end">$5.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="fs-3 text-dark text-end">Grand Total</td>
                                                <td class="text-dark fs-3 fw-bolder text-end">$269.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Product List-->
                    </div>
                    <!--end::Orders-->
                </div>
                <!--end::Tab pane-->
                
            </div>
            <!--end::Tab content-->
        </div>
        <!--end::Order details page-->
        
        <!--end::Content container-->
    
    <!--end::Content-->

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('.d-flex.align-items-center.gap-2.gap-lg-3').html(`
                    <span class="delivery-time"><span class="text-muted">Delivery Time - </span>01:11:50 days</span>
                `);
            })
        </script>
    @endpush
</x-default-layout>