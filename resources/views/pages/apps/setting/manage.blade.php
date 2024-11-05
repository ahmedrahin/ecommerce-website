<x-default-layout>

    @section('title')
        Genarel Setting
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('setting') }}
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
                                    data-bs-toggle="tab" href="#kt_ecommerce_settings_store">
                                    <i class="ki-duotone ki-shop fs-2 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>Store</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5"
                                    data-bs-toggle="tab" href="#kt_ecommerce_settings_follow">
                                    <i class="ki-duotone ki-user fs-2 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Follow On</a>
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

                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="kt_ecommerce_settings_store" role="tabpanel">
                                <livewire:settings.genarel-settings></livewire:settings.genarel-settings>
                            </div>

                            <div class="tab-pane fade " id="kt_ecommerce_settings_follow" role="tabpanel">
                                <livewire:settings.follow-on></livewire:settings.follow-on>
                            </div>

                            <div class="tab-pane fade" id="kt_ecommerce_settings_products" role="tabpanel">
                                <!--begin::Form-->
                                <form id="kt_ecommerce_settings_general_products" class="form" action="#">
                                    <div class="card-body border-top p-9 py-4 pt-8"></div>
                                    <!--begin::Heading-->
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>Cateogries Settings</h2>
                                        </div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Category Product Count</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Show the number of products inside the subcategories in the storefront header category menu. Be warned, this will cause an extreme performance hit for stores with a lot of subcategories!">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="category_product_count" id="category_product_count_yes"
                                                        checked="checked" />
                                                    <label class="form-check-label"
                                                        for="category_product_count_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="category_product_count" id="category_product_count_no" />
                                                    <label class="form-check-label"
                                                        for="category_product_count_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-16">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span class="required">Default Items Per Page</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Determines how many items are shown per page.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="products_items_per_page" value="10" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Heading-->
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>Reviews Settings</h2>
                                        </div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Allow Reviews</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enable/disable review entries for registered customers.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="allow_reviews" id="allow_reviews_yes"
                                                        checked="checked" />
                                                    <label class="form-check-label"
                                                        for="allow_reviews_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="allow_reviews" id="allow_reviews_no" />
                                                    <label class="form-check-label" for="allow_reviews_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-16">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Allow Guest Reviews</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enable/disable review entries for public guest customers">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="allow_guest_reviews" id="allow_guest_reviews_yes" />
                                                    <label class="form-check-label"
                                                        for="allow_guest_reviews_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="allow_guest_reviews" id="allow_guest_reviews_no"
                                                        checked="checked" />
                                                    <label class="form-check-label"
                                                        for="allow_guest_reviews_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->


                                    <!--begin::Heading-->
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>Tax Settings</h2>
                                        </div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Display Prices with Tax</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="product_tax" id="product_tax_yes" checked="checked" />
                                                    <label class="form-check-label" for="product_tax_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="product_tax" id="product_tax_no" />
                                                    <label class="form-check-label" for="product_tax_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span class="required">Default Tax Rate</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Determines the tax percentage (%) applied to orders">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="products_tax_rate" value="15%" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Action buttons-->
                                    <div class="row py-5">
                                        <div class="col-md-9 offset-md-3">
                                            <div class="d-flex">
                                                <!--begin::Button-->
                                                <button type="reset" data-kt-ecommerce-settings-type="cancel"
                                                    class="btn btn-light me-3">Cancel</button>
                                                <!--end::Button-->
                                                <!--begin::Button-->
                                                <button type="submit" data-kt-ecommerce-settings-type="submit"
                                                    class="btn btn-primary">
                                                    <span class="indicator-label">Save</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                <!--end::Button-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Action buttons-->
                                </form>
                                <!--end::Form-->
                            </div>

                            <div class="tab-pane fade mt-15" id="kt_ecommerce_settings_customers" role="tabpanel">
                                <!--begin::Form-->
                                <form id="kt_ecommerce_settings_general_customers" class="form" action="#">
                                    <!--begin::Heading-->
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>Customers Settings</h2>
                                        </div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Customers Online</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enable/disable tracking customers online status.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_online" id="customers_online_yes"
                                                        checked="checked" />
                                                    <label class="form-check-label"
                                                        for="customers_online_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_online" id="customers_online_no" />
                                                    <label class="form-check-label"
                                                        for="customers_online_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Customers Activity</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enable/disable tracking customers activity.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_activity" id="customers_activity_yes"
                                                        checked="checked" />
                                                    <label class="form-check-label"
                                                        for="customers_activity_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_activity" id="customers_activity_no" />
                                                    <label class="form-check-label"
                                                        for="customers_activity_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Customer Searches</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enable/disable logging customers search keywords.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_searches" id="customers_searches_yes"
                                                        checked="checked" />
                                                    <label class="form-check-label"
                                                        for="customers_searches_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_searches" id="customers_searches_no" />
                                                    <label class="form-check-label"
                                                        for="customers_searches_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Allow Guest Checkout</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enable/disable guest customers to checkout.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_guest_checkout"
                                                        id="customers_guest_checkout_yes" />
                                                    <label class="form-check-label"
                                                        for="customers_guest_checkout_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_guest_checkout"
                                                        id="customers_guest_checkout_no" checked="checked" />
                                                    <label class="form-check-label"
                                                        for="customers_guest_checkout_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Login Display Prices</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Only show prices when customers log in.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex mt-3">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_login_prices"
                                                        id="customers_login_prices_yes" />
                                                    <label class="form-check-label"
                                                        for="customers_login_prices_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name="customers_login_prices" id="customers_login_prices_no"
                                                        checked="checked" />
                                                    <label class="form-check-label"
                                                        for="customers_login_prices_no">No</label>
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span class="required">Max Login Attempts</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Set the max number of login attempts before the customer account is locked for 1 hour.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-9">
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="customer_login_attempts" value="" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Action buttons-->
                                    <div class="row py-5">
                                        <div class="col-md-9 offset-md-3">
                                            <div class="d-flex">
                                                <!--begin::Button-->
                                                <button type="reset" data-kt-ecommerce-settings-type="cancel"
                                                    class="btn btn-light me-3">Cancel</button>
                                                <!--end::Button-->
                                                <!--begin::Button-->
                                                <button type="submit" data-kt-ecommerce-settings-type="submit"
                                                    class="btn btn-primary">
                                                    <span class="indicator-label">Save</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                <!--end::Button-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Action buttons-->
                                </form>
                                <!--end::Form-->
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
