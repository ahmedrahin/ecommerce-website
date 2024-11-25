<div class="mobile-fix-option"> 
  <ul> 
    <li> <a href="{{route('homepage')}}"><i class="iconsax" data-icon="home-1"></i>Home</a></li>
    <li><a href=""><i class="iconsax" data-icon="mail"></i>Contact</a></li>
    <li class="shopping-cart"> <a href="{{route('cart')}}"><i class="iconsax" data-icon="shopping-cart"></i>Cart</a></li>
    <li><a href="{{route('wishlist')}}"><i class="iconsax" data-icon="heart"></i>My Wish</a></li>
    @if( !Auth::check() )
      <li> <a href="{{route('user.login')}}"><i class="iconsax" data-icon="user-2"></i>Account</a></li>
    @else 
      <li> <a href="{{route('user.dashboard')}}"><i class="iconsax" data-icon="user-2"></i>Account</a></li>
    @endif
  </ul>
</div>

<header id="header"> 
    <div class="custom-container container header-1">
      <div class="row"> 
        <div class="col-12 p-0"> 
          
          <div class="offcanvas offcanvas-start" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
              <h3 class="offcanvas-title" id="staticBackdropLabel">Offcanvas</h3>
              <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div></div>I will not close if you click outside of me.
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="main-menu"> 
            <a class="brand-logo" href="{{url('/')}}"> <img class="img-fluid for-light" src="{{asset(config('app.logo'))}}" alt="logo"/></a>
            <nav id="main-nav" class="for-dekstop">
              <ul class="nav-menu sm-horizontal theme-scrollbar">
                <li> 
                  <a class="nav-link" href="{{route('shop')}}" style="font-weight: 700;">Shop <span> <i class="fa-solid fa-angle-down"></i></span></a>
                  <div class="mega-menu">
                    <livewire:frontend.shop.category-menu />
                  </div>
                </li>
               
              </ul>
            </nav>

            <nav id="main-nav" class="for-mobile">
              <ul class="nav-menu sm-horizontal theme-scrollbar" id="sm-horizontal">
                <li class="mobile-back" id="mobile-back"><span style="font-size: 14px;">Categories</span><i class="fa fa-times" aria-hidden="true"></i></li>
                  <livewire:frontend.shop.category-menu-mobile />
              </ul>
            </nav>
            
            {{-- search box --}}

            <div style="width: 50%" class="for-dekstop">
              <livewire:frontend.shop.search-box />
            </div>
            
            <div class="sub_header">
              <div class="for-mobile">
                <livewire:frontend.shop.search-box-mobile />
              </div>
              <div class="toggle-nav" id="toggle-nav"><i class="fa-solid fa-bars-staggered sidebar-bar"></i></div>
              <ul class="justify-content-end">
                
                <li> <a href="{{route('wishlist')}}"><i class="iconsax" data-icon="heart"></i>
                  <livewire:frontend.wishlist.count-wishlist />
                </a></li>

                @include('frontend.includes.auth')

                 {{-- cart btn --}}
                <livewire:frontend.cart.btn-cart />

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</header>