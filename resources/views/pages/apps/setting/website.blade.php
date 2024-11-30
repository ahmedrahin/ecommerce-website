<x-default-layout>

    @section('title')
        Website Setting
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('webitesetting') }}
    @endsection

    <style>
        .nav-line-tabs .nav-item .nav-link {
            margin: 0 1.3rem !important;
            font-size: 17px !important;
        }
    </style>


    <div id="kt_account_settings_profile_details" class="collapse show">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container">
                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold ">

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5 active"
                                    data-bs-toggle="tab" href="#kt_ecommerce_settings_home">
                                    <i class="ki-duotone ki-home-3 fs-2 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Home Page</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5"
                                    data-bs-toggle="tab" href="#kt_ecommerce_settings_products">
                                    <i class="ki-duotone ki-package fs-2 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>Products</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5"
                                    data-bs-toggle="tab" href="#kt_ecommerce_settings_customers">
                                    <i class="ki-duotone ki-people fs-2 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>Customers</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5"
                                    data-bs-toggle="tab" href="#kt_ecommerce_settings_product_details">
                                    <i class="ki-duotone ki-book fs-2 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path2"></span>
                                        <span class="path2"></span>
                                    </i>Product Details</a>
                            </li>

                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="kt_ecommerce_settings_home" role="tabpanel">
                                
                            </div>

                            <div class="tab-pane fade" id="kt_ecommerce_settings_products" role="tabpanel">
                                <livewire:settings.productsetting/>
                            </div>

                            <div class="tab-pane fade mt-15" id="kt_ecommerce_settings_customers" role="tabpanel">
                                <livewire:settings.customersetting/>
                            </div>

                            <div class="tab-pane fade mt-15" id="kt_ecommerce_settings_product_details" role="tabpanel">
                                <livewire:settings.productdetails/>
                            </div>

                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
    </div>

</x-default-layout>
