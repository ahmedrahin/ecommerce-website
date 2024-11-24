
<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.includes.header')
    @include('frontend.includes.css')
    @livewireStyles
</head>

<body class="skeleton_body">
    {{-- cart btn --}}
    <livewire:frontend.cart.btnshopping />
    <!-- menu item -->
    @include('frontend.includes.menu')

    <!-- body content -->
    @yield('body-content')
 
    @include('frontend.includes.footer')
    @yield('footer-content')
    @include('frontend.includes.cart-sidebar')
    @include('frontend.includes.script')

    @livewireScripts
</body>

</html>