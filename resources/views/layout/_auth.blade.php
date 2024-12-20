@extends('layout.master')

@section('content')

<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root" style="background-image: url({{ image('misc/auth-bg.png') }})">
    <!--begin::Wrapper-->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10" style="background: white; border-radius: 7px;">
                    <!--begin::Page-->
                    {{ $slot }}
                    <!--end::Page-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->

            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap px-5">
                <!--begin::Links-->
                <div class="d-flex fw-semibold text-primary fs-base">
                    <a href="#" class="px-5" target="_blank" style="color: white;">Terms</a>

                    <a href="#" class="px-5" target="_blank" style="color: white;">Plans</a>

                    <a href="#" class="px-5" target="_blank" style="color: white;">Contact Us</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::App-->

@endsection