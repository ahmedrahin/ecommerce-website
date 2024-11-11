<!-- Favicon icon-->
<link rel="icon" href="{{asset('frontend/images/favicon.png')}}" type="image/x-icon"/>
<link rel="shortcut icon" href="{{asset('frontend/images/favicon.png')}}" type="image/x-icon"/>
<!-- Google Font Outfit-->
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin=""/>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&amp;display=swap" rel="stylesheet"/>
<!-- Font Awesome-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/fontawesome.css')}}"/>
<!-- Iconsax icon-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/iconsax.css')}}"/>
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" id="rtl-link" href="{{asset('frontend/css/vendors/bootstrap.css')}}"/>

<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/toastify.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/custom.css')}}"/>
{{-- page css file --}}
@yield('page-css')