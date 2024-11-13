<header> 
    <div class="custom-container container header-1">
      <div class="row"> 
        <div class="col-12 p-0"> 
          <div class="mobile-fix-option"> 
            <ul> 
              <li> <a href="index.html"><i class="iconsax" data-icon="home-1"></i>Home</a></li>
              <li><a href="search.html"><i class="iconsax" data-icon="search-normal-2"></i>Search</a></li>
              <li class="shopping-cart"> <a href="cart.html"><i class="iconsax" data-icon="shopping-cart"></i>Cart</a></li>
              <li><a href="wishlist.html"><i class="iconsax" data-icon="heart"></i>My Wish</a></li>
              <li> <a href="dashboard.html"><i class="iconsax" data-icon="user-2"></i>Account</a></li>
            </ul>
          </div>
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
          <div class="main-menu"> <a class="brand-logo" href="index.html"> <img class="img-fluid for-light" src="{{asset('frontend/images/logo/logo.png')}}" alt="logo"/><img class="img-fluid for-dark" src="{{asset('frontend/images/logo/logo-white-1.png')}}" alt="logo"/></a>
            <nav id="main-nav">
              <ul class="nav-menu sm-horizontal theme-scrollbar" id="sm-horizontal">
                <li>
                  <a class="nav-link" href="#">Home</a>
                </li>
                <li> <a class="nav-link" href="{{route('shop')}}">Shop</a>
                  
                </li>
                <li> <a class="nav-link" href="contact.html">Contact </a></li>
              </ul>
            </nav>
            <div class="sub_header">
              <div class="toggle-nav" id="toggle-nav"><i class="fa-solid fa-bars-staggered sidebar-bar"></i></div>
              <ul class="justify-content-end">
                <li> 
                  <button href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="iconsax" data-icon="search-normal-2"></i></button>
                </li>
                <li> <a href="wishlist.html"><i class="iconsax" data-icon="heart"></i><span class="cart_qty_cls">2</span></a></li>
                <li class="onhover-div"><a href="#"><i class="iconsax" data-icon="user-2"></i></a>
                  <div class="onhover-show-div user"> 
                    <ul> 
                      <li> <a href="login.html">Login </a></li>
                      <li> <a href="sign-up.html">Register</a></li>
                    </ul>
                  </div>
                </li>
                <li class="onhover-div shopping-cart">
                  <a class="p-0" href="#">
                       {{-- cart btn --}}
                       <livewire:frontend.cart.btn-cart />
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</header>