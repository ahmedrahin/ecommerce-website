<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
            data-kt-menu="true" data-kt-menu-expand="false">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <i class="ki-duotone ki-home-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <span class="menu-title">Dashboard</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->

            <!--begin:Menu item-->
            <div class="menu-item pt-1">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">User Directory</span>
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->

            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('admin-management.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <i class="ki-duotone ki-user-tick">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <span class="menu-title">Admin Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('admin-management.admin-list.*') ? 'active' : '' }}"
                            href="{{ route('admin-management.admin-list.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Admin List</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('admin-management.roles.*') ? 'active' : '' }}"
                            href="{{ route('admin-management.roles.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Roles</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('admin-management.permissions.*') ? 'active' : '' }}"
                            href="{{ route('admin-management.permissions.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Permissions</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>

            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('user-management.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <i class="ki-duotone ki-profile-user">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    <span class="menu-title">User Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('user-management.users.index') ? 'active' : '' }}"
                            href="{{route('user-management.users.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">User List</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link "
                            href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">User messages</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>


            <!--begin:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">PRODUCT CATALOGUE</span>
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->

            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('product-catalogue.brand.index') ? 'active' : '' }}"
                    href="{{ route('product-catalogue.brand.index') }}">
                    <i class="ki-duotone ki-medal-star">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    <span class="menu-title">Brand</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->

            <!-- categories -->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('product-catalogue.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <i class="ki-duotone ki-category">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    <span class="menu-title">Categories</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('product-catalogue.category.index') ? 'active' : '' }}"
                            href="{{ route('product-catalogue.category.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Category</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('product-catalogue.subcategory.index') ? 'active' : '' }}"
                            href="{{ route('product-catalogue.subcategory.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Subcategory</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    {{-- <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('product-catalogue.subsubcategory.index') ? 'active' : '' }}"
                            href="{{ route('product-catalogue.subsubcategory.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Subsubcategory</span>
                        </a>
                        <!--end:Menu link-->
                    </div> --}}
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>

            <!--begin:Menu item product-menu-items -->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('product-management.*', 'product-variant.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <i class="ki-duotone ki-gift">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    <span class="menu-title">Product Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('product-management.index*') ? 'active' : '' }}"
                            href="{{ route('product-management.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All Products</span>
                        </a>
                        <!--end:Menu link-->
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('product-management.create*') ? 'active' : '' }}"
                            href="{{ route('product-management.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add New Product</span>
                        </a>
                        <!--end:Menu link-->
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('product-variant.index*') ? 'active' : '' }}"
                            href="{{ route('product-variant.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Product Variant</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                </div>
                <!--end:Menu sub-->
            </div>

            {{-- order catelogue start --}}

            <!--begin:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Order CATALOGUE</span>
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->

            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('order-management.order*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <i class="ki-duotone ki-handcart"></i>
                    <span class="menu-title">Order Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('order-management.order.index*') ? 'active' : '' }}" href="{{route('order-management.order.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All Orders</span>
                        </a>
                        <!--end:Menu link-->
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('order-management.order.create*') ? 'active' : '' }}" href="{{route('order-management.order.create')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add New Order</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                </div>
                <!--end:Menu sub-->
            </div>

            <!--begin:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Marketing CATALOGUE</span>
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->

            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('coupon*') ? 'active' : '' }}" href="{{route('coupon.index')}}">
                    <i class="ki-duotone ki-discount">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <span class="menu-title">Coupon</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->

            <!--begin:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Shipping Management</span>
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->

            <!--begin:Menu item product-menu-items -->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('shipping.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <i class="ki-duotone ki-geolocation-home">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <span class="menu-title">City/State</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('shipping.district') ? 'active' : '' }}"
                            href="{{ route('shipping.district') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">District</span>
                        </a>
                        <!--end:Menu link-->
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('shipping.state') ? 'active' : '' }}"
                            href="{{ route('shipping.state') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">State/Area</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                </div>
                <!--end:Menu sub-->
            </div>

            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('shipping.shipping_method') ? 'active' : '' }}"
                    href="{{ route('shipping.shipping_method') }}">
                    <i class="ki-duotone ki-truck">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                    <span class="menu-title">Shipping Method</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->

            <!--settings:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Platform Settings</span>
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->



            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('setting.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <i class="ki-duotone ki-setting-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <span class="menu-title">Settings</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('setting.manage') ? 'active' : '' }}"
                            href="{{ route('setting.manage') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Genarel Settings</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                </div>

                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('setting.website') ? 'active' : '' }}"
                            href="{{ route('setting.website') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Website Settings</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                </div>
                <!--end:Menu sub-->
            </div>


        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
