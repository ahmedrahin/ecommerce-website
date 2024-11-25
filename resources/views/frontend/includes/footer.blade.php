<footer class="footer-layout-img" style="background-image: url('{{ asset('frontend/images/footer/1.jpg') }}');"> 
    <section class="section-b-space footer-1">
      <div class="custom-container container">
        <div class="row"> 
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="footer-content">
              <div class="footer-logo"><a href="index.html"> <img class="img-fluid" src="{{asset('frontend/images/logo/logo-white-1.png')}}" alt="Footer Logo"/></a></div>
              <ul> 
                <li> <i class="iconsax" data-icon="location"></i>
                  <h6>{{config('app.address')}}, {{config('app.state')}}</h6>
                </li>
                <li> <i class="iconsax" data-icon="phone-calling"></i>
                  <h6>{{config('app.phone')}}</h6>
                </li>
                <li> <i class="iconsax" data-icon="mail"></i>
                  <h6><a href="mailto:{{config('app.email')}};">{{config('app.email')}}</a></h6>
                </li>
              </ul>
              <div class="social-icon">
                  <ul>
                      @if( !is_null(config('app.facebook')) )
                        <li>
                          <a href="{{config('app.facebook')}}"><i class="bi bi-facebook"></i></a>
                        </li>
                      @endif
                      @if( !is_null(config('app.whatsapp')) )
                        <li>
                          <a href="{{config('app.whatsapp')}}"><i class="bi bi-whatsapp"></i></a>
                        </li>
                      @endif
                      @if( !is_null(config('app.instra')) )
                        <li>
                          <a href="{{config('app.instra')}}"><i class="bi bi-instagram"></i></a>
                        </li>
                      @endif
                      @if( !is_null(config('app.youtube')) )
                        <li>
                          <a href="{{config('app.youtube')}}"><i class="bi bi-youtube"></i></a>
                        </li>
                      @endif
                  </ul>
              </div>
            </div>
          </div>
          <div class="col offset-xl-1">
            <div class="footer-content">
              <div> 
                <div class="footer-title d-md-block"> 
                  <h5>About Us</h5>
                  <ul class="footer-details accordion-hidden"> 
                    <li> <a class="nav" href="{{url('/')}}">Home</a></li>
                    <li> <a class="nav" href="{{route('shop')}}">Shop</a></li>
                    <li> <a class="nav" href="{{route('about')}}">About Us</a></li>
                    <li> <a class="nav" href="">Faq</a></li>
                    <li> <a class="nav" href="{{route('contact')}}">Contact</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="footer-content">
              <div>
                <div class="footer-title d-md-block">
                  <h5>New Categories</h5>
                  <ul class="footer-details accordion-hidden"> 
                    <li> <a class="nav" href="product-bundle.html">Latest Shoes</a></li>
                    <li> <a class="nav" href="variant-radio.html">Branded Jeans</a></li>
                    <li> <a class="nav" href="product.html">New Jackets</a></li>
                    <li> <a class="nav" href="variant-images.html">Colorful Hoodies</a></li>
                    <li> <a class="nav" href="variant-dropdown.html">Best Perfume</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
         
          <div class="col">
            <div class="footer-content">
              <div>
                <div class="footer-title d-md-block"> 
                  <h5>My Account</h5>
                  <ul class="footer-details accordion-hidden"> 
                    <li> <a class="nav" href="dashboard.html">My Account</a></li>
                    <li> <a class="nav" href="login.html">Login/Register</a></li>
                    <li> <a class="nav" href="cart.html">Cart</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="sub-footer"> 
      <div class="custom-container container">
        <div class="row"> 
          <div class="col-12">
            <div class="footer-end text-center">
              <h6>2024 Copyright By Themeforest Powered By Pixelstrap </h6>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </footer>

  {{-- top button --}}
  <div class="tap-top">
    <div><i class="fa-solid fa-angle-up"></i></div>
  </div>