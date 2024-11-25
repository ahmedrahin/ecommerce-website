@extends('frontend.layout.app')
    
@section('page-title')
    Home | {{config('app.name')}}
@endsection
  

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/swiper-slider/swiper-bundle.min.css')}}"/>

@endsection

@section('body-content')
   
<section class="pt-0 home-section-3">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-2 d-none d-xl-block">
          <ul> 
            <li> <a href="collection-left-sidebar.html">Women’s Clothing</a></li>
            <li> <a href="collection-left-sidebar.html">Men’s Clothing</a></li>
            <li> <a href="collection-left-sidebar.html">Kids Clothing</a></li>
            <li> <a href="collection-left-sidebar.html">Watch</a></li>
            <li> <a href="collection-left-sidebar.html">Sports Accessories</a></li>
            <li> <a href="collection-left-sidebar.html">Sunglass</a></li>
            <li> <a href="collection-left-sidebar.html">Bags</a></li>
            <li> <a href="collection-left-sidebar.html">Sneakers</a></li>
            <li> <a href="collection-left-sidebar.html">Jewellery</a></li>
            <li> <a href="collection-left-sidebar.html">Hair Accessories</a></li>
            <li> <a href="collection-left-sidebar.html">Other</a></li>
          </ul>
        </div>
        <div class="col pe-0">  
          <div class="home-banner p-right">                            
            <img class="img-fluid" src="{{asset('frontend/images/home/slider/1.jpg')}}" alt=""/>
            <div class="contain-banner"> 
              <div> 
                <h4>Hot Offer <span>START TODAY</span></h4>
                <h1>Explore Your True Creative Fashion.</h1>
                <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. </p>
                <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="collection-left-sidebar.html">Show Now
                    <svg>
                      <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                    </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="collection-left-sidebar.html">Show Now
                    <svg>
                      <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                    </svg></a></div>
              </div>
            </div>
          </div>
          <ul class="social-icon"> 
            <li> <a href="#">
                <h6>Follow Us</h6></a></li>
            <li> <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li> <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="section-t-space">
    <div class="custom-container container service">
      <ul>
        <li>
          <div class="service-block"><img src="{{asset('frontend/images/home/1.svg')}}" alt=""/>
            <div>    
              <h6>Shipping all over county</h6>
              <p>Apply to all orders over $800</p>
            </div>
          </div>
        </li>
        <li>
          <div class="service-block"><img src="{{asset('frontend/images/home/2.svg')}}" alt=""/>
            <div>    
              <h6>Return & Exchanges</h6>
              <p>Complete warranty</p>
            </div>
          </div>
        </li>
        <li>
          <div class="service-block"><img src="{{asset('frontend/images/home/3.svg')}}" alt=""/>
            <div>    
              <h6>Technical Support</h6>
              <p>Service support 24/7</p>
            </div>
          </div>
        </li>
        <li>
          <div class="service-block border-0"><img src="{{asset('frontend/images/home/4.svg')}}" alt=""/>
            <div>    
              <h6>Daily Gift Vouchers</h6>
              <p>Shopping now is more fun</p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <section class="section-t-space">
    <div class="custom-container container">
      <div class="row"> 
        <div class="col-xxl-5 col-lg-8 offer-box-1">
          <div class="row gy-4 ratio_45">
            <div class="col-12">
              <div class="collection-banner p-left">                                
                <img class="bg-img" src="{{asset('frontend/images/home/banner-7.jpg')}}" alt=""/>
                <div class="contain-banner"> 
                  <div> 
                    <h4>Up to 60% OFF</h4>
                    <h3>New Brand Men’s Bag</h3>
                    <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="collection-left-sidebar.html">Shop Collection
                        <svg>
                          <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                        </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="collection-left-sidebar.html">Shop Collection
                        <svg>
                          <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                        </svg></a></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="collection-banner p-right"><img class="bg-img" src="{{asset('frontend/images/home/banner-8.jpg')}}" alt=""/>
                <div class="contain-banner"> 
                  <div> 
                    <h4>Up to 60% OFF</h4>
                    <h3>Women’s Stylish Top</h3>
                    <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="collection-left-sidebar.html">Shop Collection
                        <svg>
                          <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                        </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="collection-left-sidebar.html">Shop Collection
                        <svg>
                          <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                        </svg></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-4 d-none d-lg-block"> 
          <div class="special-offer-slider"> 
            <h4>Special Offer</h4>
            <div class="swiper special-offer-slide">
              <div class="swiper-wrapper trending-products">
                <div class="swiper-slide product-box-3">
                  <div class="img-wrapper">
                    <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                    <div class="product-image ratio_apos"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/5.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/6.jpg" alt="product"/></a></div>
                    <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                  </div>
                  <div class="product-detail">
                    <ul class="rating">      
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star-half-stroke"></i></li>
                      <li><i class="fa-regular fa-star"></i></li>
                      <li>4.3</li>
                    </ul><a href="product.html"> 
                      <h6>Greciilooks Women's Stylish Top</h6></a>
                    <p>$100.00  
                      <del>$140.00</del><span>-20%</span>
                    </p>
                  </div>
                </div>
                <div class="swiper-slide product-box-3">
                  <div class="img-wrapper">
                    <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                    <div class="product-image ratio_apos"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/8.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/12.jpg" alt="product"/></a></div>
                    <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                    <div class="countdown">
                      <ul class="clockdiv2">
                        <li> 
                          <div class="timer">
                            <div class="days"></div>
                          </div><span class="title">Days</span>
                        </li>
                        <li class="dot"> <span>:</span></li>
                        <li> 
                          <div class="timer">
                            <div class="hours"></div>
                          </div><span class="title">Hours</span>
                        </li>
                        <li class="dot"> <span>:</span></li>
                        <li> 
                          <div class="timer">
                            <div class="minutes"></div>
                          </div><span class="title">Min</span>
                        </li>
                        <li class="dot"> <span>:</span></li>
                        <li> 
                          <div class="timer">
                            <div class="seconds"></div>
                          </div><span class="title">Sec</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="product-detail">
                    <ul class="rating">      
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-regular fa-star"></i></li>
                      <li>4.3</li>
                    </ul><a href="product.html"> 
                      <h6>Wide Linen-Blend Trousers</h6></a>
                    <p>$100.00  
                      <del>$18.00 </del>
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
          </div>
        </div>
        <div class="col-4 d-none d-xxl-block"> 
          <div class="offer-banner-3 ratio1_3"> <a href="#"> <img class="bg-img" src="{{asset('frontend/images/home/banner-9.jpg')}}" alt=""/>
              <div> <img src="../assets/images/banner/2.png" alt=""/>
                <h6>SALE UP TO 70%</h6>
              </div></a></div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-t-space">
    <div class="custom-container container">
      <div class="row special-products align-items-center">
        <div class="col-md-4 col-12">
          <div class="title-1">
            <p>Trendy collection<span></span></p>
            <h3>Special Products</h3>
          </div>
        </div>
        <div class="col-md-8 col-12">
          <div class="theme-tab-3">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#new-product" role="tab" aria-controls="new-product" aria-selected="true">
                  <h6>New Products</h6></a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#featured-product" role="tab" aria-controls="featured-product" aria-selected="false"> 
                  <h6>Featured Products</h6></a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#best-seller" role="tab" aria-controls="best-seller" aria-selected="false"> 
                  <h6>Best Seller</h6></a></li>
            </ul>
          </div>
        </div>
        <div class="col-12"> 
          <div class="tab-content">
            <div class="tab-pane fade show active" id="new-product" role="tabpanel" tabindex="0"> 
              <div class="row ratio1_3 gy-4 gx-3 gx-sm-4">
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/1.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/11.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                      <div class="countdown">
                        <ul class="clockdiv9">
                          <li> 
                            <div class="timer">
                              <div class="days"></div>
                            </div><span class="title">Days</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="hours"></div>
                            </div><span class="title">Hours</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="minutes"></div>
                            </div><span class="title">Min</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="seconds"></div>
                            </div><span class="title">Sec</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Greciilooks Women's Stylish Top</h6></a>
                      <p>$100.00  
                        <del>$140.00</del><span>-20%</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/2.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/19.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Wide Linen-Blend Trousers</h6></a>
                      <p>$100.00  
                        <del>$18.00 </del>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/3.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/18.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Long Sleeve Rounded T-Shirt</h6></a>
                      <p>$12.30  
                        <del>$140.00</del><span>-20%</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/10.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/21.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                      <div class="countdown">
                        <ul class="clockdiv3">
                          <li> 
                            <div class="timer">
                              <div class="days"></div>
                            </div><span class="title">Days</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="hours"></div>
                            </div><span class="title">Hours</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="minutes"></div>
                            </div><span class="title">Min</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="seconds"></div>
                            </div><span class="title">Sec</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Blue lined White T-Shirt</h6></a>
                      <p>$190.00  
                        <del>$210.00</del>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="featured-product" role="tabpanel" tabindex="0">
              <div class="row ratio1_3 gy-4">
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/4.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/16.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                      <div class="countdown">
                        <ul class="clockdiv4">
                          <li> 
                            <div class="timer">
                              <div class="days"></div>
                            </div><span class="title">Days</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="hours"></div>
                            </div><span class="title">Hours</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="minutes"></div>
                            </div><span class="title">Min</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="seconds"></div>
                            </div><span class="title">Sec</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Greciilooks Women's Stylish Top</h6></a>
                      <p>$100.00  
                        <del>$140.00</del><span>-20%</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/11.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/15.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Wide Linen-Blend Trousers</h6></a>
                      <p>$100.00  
                        <del>$18.00 </del>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/9.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/14.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Long Sleeve Rounded T-Shirt</h6></a>
                      <p>$12.30  
                        <del>$140.00</del><span>-20%</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/10.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/13.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                      <div class="countdown">
                        <ul class="clockdiv5">
                          <li> 
                            <div class="timer">
                              <div class="days"></div>
                            </div><span class="title">Days</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="hours"></div>
                            </div><span class="title">Hours</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="minutes"></div>
                            </div><span class="title">Min</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="seconds"></div>
                            </div><span class="title">Sec</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Blue lined White T-Shirt</h6></a>
                      <p>$190.00  
                        <del>$210.00</del>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="best-seller" role="tabpanel" tabindex="0"> 
              <div class="row ratio1_3 gy-4">
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/16.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/2.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                      <div class="countdown">
                        <ul class="clockdiv6">
                          <li> 
                            <div class="timer">
                              <div class="days"></div>
                            </div><span class="title">Days</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="hours"></div>
                            </div><span class="title">Hours</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="minutes"></div>
                            </div><span class="title">Min</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="seconds"></div>
                            </div><span class="title">Sec</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Greciilooks Women's Stylish Top</h6></a>
                      <p>$100.00  
                        <del>$140.00</del><span>-20%</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/17.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/1.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star">  </i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Wide Linen-Blend Trousers</h6></a>
                      <p>$100.00  
                        <del>$18.00 </del>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/18.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/20.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Long Sleeve Rounded T-Shirt</h6></a>
                      <p>$12.30  
                        <del>$140.00</del><span>-20%</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="product-box-3">
                    <div class="img-wrapper">
                      <div class="label-block"><span class="lable-1">NEW</span><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a></div>
                      <div class="product-image"><a class="pro-first" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/19.jpg" alt="product"/></a><a class="pro-sec" href="product.html"> <img class="bg-img" src="../assets/images/product/product-3/3.jpg" alt="product"/></a></div>
                      <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card"> </i></a><a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a></div>
                      <div class="countdown">
                        <ul class="clockdiv7">
                          <li> 
                            <div class="timer">
                              <div class="days"></div>
                            </div><span class="title">Days</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="hours"></div>
                            </div><span class="title">Hours</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="minutes"></div>
                            </div><span class="title">Min</span>
                          </li>
                          <li class="dot"> <span>:</span></li>
                          <li> 
                            <div class="timer">
                              <div class="seconds"></div>
                            </div><span class="title">Sec</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="product-detail">
                      <ul class="rating">      
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                        <li>4.3</li>
                      </ul><a href="product.html"> 
                        <h6>Blue lined White T-Shirt</h6></a>
                      <p>$190.00  
                        <del>$210.00</del>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-t-space"> 
    <div class="custom-container container">
      <div class="style-banner">
        <div class="row gy-4 align-items-end"> 
          <div class="col-sm-6 col-12 ratio_square-4"><a href="collection-left-sidebar.html"> <img class="bg-img" src="../assets/images/banner/banner-4.png" alt=""/></a></div>
          <div class="col-sm-6 col-12 ratio3_2">
            <div class="style-content">
              <h6>Wear Your Style</h6>
              <h2>Top Brands Best 4+ Star Rated</h2>
              <h4>On Fashion Online Shopping</h4>
              <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="collection-left-sidebar.html">Shop Collection
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                  </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="collection-left-sidebar.html">Shop Collection
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                  </svg></a></div>
            </div><a href="collection-left-sidebar.html"> <img class="bg-img" src="../assets/images/banner/banner-5.jpg" alt=""/></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-t-space">
    <div class="custom-container container flash-box">
      <div class="row gy-3"> 
        <div class="col-12">
          <div class="d-sm-flex d-block justify-content-between align-items-center">
            <div class="title-1">
              <p>Brand collection<span></span></p>
              <h3>Flash Sale Product</h3>
            </div>
            <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="collection-left-sidebar.html">See All Product
                <svg>
                  <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="collection-left-sidebar.html">See All Product
                <svg>
                  <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                </svg></a></div>
          </div>
        </div>
        <div class="col-xxl-3 col-lg-6 col-12 order-xxl-1 order-2"> 
          <div class="row gy-4"> 
            <div class="col-lg-12 col-md-6 col-12"> 
              <div class="flash-content"><img class="img-fluid" src="../assets/images/banner/6.jpg" alt=""/>
                <div> 
                  <ul> 
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>4.3</li>
                  </ul><a href="product.html">
                    <h6>Greciilooks Women's Stylish Top </h6></a>
                  <h6>$100.00</h6>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-6 col-12"> 
              <div class="flash-content"><img class="img-fluid" src="../assets/images/banner/7.jpg" alt=""/>
                <div> 
                  <ul> 
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>4.3</li>
                  </ul><a href="product.html">
                    <h6>Greciilooks Women's Stylish Top </h6></a>
                  <h6>$100.00
                    <del>$140.00</del>
                  </h6>
                </div>
                <div class="flash-lable"> <span>-20%</span></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-6 col-lg-6 col-12 order-xxl-2 order-1">
          <div class="flash-images ratio50_2"><a href="collection-left-sidebar.html"><img class="bg-img" src="../assets/images/banner/banner-10.jpg" alt=""/></a>
            <div class="banner-2"> 
              <h3>40% - 80%Off</h3>
              <h5>Men's Special Offer</h5>
              <div class="countdown">
                <ul class="clockdiv8">
                  <li> 
                    <div class="timer">
                      <div class="days"></div>
                    </div><span class="title">Days</span>
                  </li>
                  <li class="dot"> <span> </span><span></span></li>
                  <li> 
                    <div class="timer">
                      <div class="hours"></div>
                    </div><span class="title">Hours</span>
                  </li>
                  <li class="dot"> <span> </span><span></span></li>
                  <li> 
                    <div class="timer">
                      <div class="minutes"></div>
                    </div><span class="title">Min</span>
                  </li>
                  <li class="dot"> <span> </span><span></span></li>
                  <li> 
                    <div class="timer">
                      <div class="seconds"></div>
                    </div><span class="title">Sec</span>
                  </li>
                </ul>
              </div>
              <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="collection-left-sidebar.html">Shop Collection
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                  </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="collection-left-sidebar.html">Shop Collection
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                  </svg></a></div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-12 order-xxl-3 order-3">
          <div class="row gy-4">
            <div class="col-xxl-12 col-md-6 col-12"> 
              <div class="flash-content"><img class="img-fluid" src="../assets/images/banner/8.jpg" alt=""/>
                <div> 
                  <ul> 
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>4.3</li>
                  </ul><a href="product.html">
                    <h6>Greciilooks Women's Stylish Top </h6></a>
                  <h6>$100.00
                    <del>$140.00</del>
                  </h6>
                </div>
                <div class="flash-lable"> <span>-30%</span></div>
              </div>
            </div>
            <div class="col-xxl-12 col-md-6 col-12"> 
              <div class="flash-content"><img class="img-fluid" src="../assets/images/banner/9.jpg" alt=""/>
                <div> 
                  <ul> 
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#star"></use>
                      </svg>
                    </li>
                    <li>4.3</li>
                  </ul><a href="product.html">
                    <h6>Greciilooks Women's Stylish Top </h6></a>
                  <h6>$100.00</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-t-space">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-sm-3 col-6">
          <div class="brand-logo-txt">
            <div>    
              <h3>Top Brands </h3>
              <h4>Up to 40% off</h4>
              <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="index.html">Shop Now
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                  </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="index.html">Shop Now
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                  </svg></a></div>
            </div>
          </div>
        </div>
        <div class="col-sm-9 col-6 p-0">
          <div class="swiper slide-2">
            <div class="swiper-wrapper">
              <div class="swiper-slide logo-block"><a href="collection-left-sidebar.html"> <img src="../assets/images/logos/1.png" alt="logo"/></a></div>
              <div class="swiper-slide logo-block"><a href="collection-left-sidebar.html"> <img src="../assets/images/logos/2.png" alt="logo"/></a></div>
              <div class="swiper-slide logo-block"><a href="collection-left-sidebar.html"> <img src="../assets/images/logos/3.png" alt="logo"/></a></div>
              <div class="swiper-slide logo-block"><a href="collection-left-sidebar.html"> <img src="../assets/images/logos/4.png" alt="logo"/></a></div>
              <div class="swiper-slide logo-block"><a href="collection-left-sidebar.html"> <img src="../assets/images/logos/5.png" alt="logo"/></a></div>
              <div class="swiper-slide logo-block"><a href="collection-left-sidebar.html"> <img src="../assets/images/logos/6.png" alt="logo"/></a></div>
              <div class="swiper-slide logo-block"><a href="collection-left-sidebar.html"> <img src="../assets/images/logos/7.png" alt="logo"/></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-t-space ratio3_3">
    <div class="container-fluid subscribe-banner">
      <div class="row align-items-center">
        <div class="col-xl-8 col-md-7 col-12 px-0"> <a href="index.html"><img class="bg-img" src="../assets/images/banner/banner-6.png" alt=""/></a></div>
        <div class="col-xl-4 col-5">
          <div class="subscribe-content">
            <h6>GET 20% OFF</h6>
            <h4>Subscribe to Our Newsletter!</h4>
            <p>Join the insider list - you’ll be the first to know about new arrivals, insider - only discounts and receive $15 off your first order.</p>
            <input type="text" name="text" placeholder="Your email address..."/>
            <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="index.html">Subscribe Now
                <svg>
                  <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="index.html">Subscribe Now
                <svg>
                  <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                </svg></a></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-b-space">
    <div class="custom-container container">
      <div class="row">
        <div class="col">
          <div class="title-1">
            <p>Follow Us On Insta<span></span></p>
            <h3>Our Instagram Post</h3>
          </div>
        </div>
      </div>
      <div class="swiper insta-slide-3">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="instagram-box-1"> 
              <div class="instagram-box">
                <div class="instashop-effect"><img src="../assets/images/instagram/6.jpg" alt=""/>
                  <div class="insta-txt">
                    <div>
                      <svg class="insta-icon">
                        <use href="../assets/svg/icon-sprite.svg#instagram"></use>
                      </svg>
                      <p>Instashop</p>
                      <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="instagram-box-1"> 
              <div class="instagram-box">
                <div class="instashop-effect"><img src="../assets/images/instagram/7.jpg" alt=""/>
                  <div class="insta-txt">
                    <div>
                      <svg class="insta-icon">
                        <use href="../assets/svg/icon-sprite.svg#instagram"></use>
                      </svg>
                      <p>Instashop</p>
                      <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="instagram-box-1"> 
              <div class="instagram-box">
                <div class="instashop-effect"><img src="../assets/images/instagram/8.jpg" alt=""/>
                  <div class="insta-txt">
                    <div>
                      <svg class="insta-icon">
                        <use href="../assets/svg/icon-sprite.svg#instagram"></use>
                      </svg>
                      <p>Instashop</p>
                      <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="instagram-box-1"> 
              <div class="instagram-box">
                <div class="instashop-effect"><img src="../assets/images/instagram/9.jpg" alt=""/>
                  <div class="insta-txt">
                    <div>
                      <svg class="insta-icon">
                        <use href="../assets/svg/icon-sprite.svg#instagram"></use>
                      </svg>
                      <p>Instashop</p>
                      <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="instagram-box-1"> 
              <div class="instagram-box">
                <div class="instashop-effect"><img src="../assets/images/instagram/10.jpg" alt=""/>
                  <div class="insta-txt">
                    <div>
                      <svg class="insta-icon">
                        <use href="../assets/svg/icon-sprite.svg#instagram"></use>
                      </svg>
                      <p>Instashop</p>
                      <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="instagram-box-1"> 
              <div class="instagram-box">
                <div class="instashop-effect"><img src="../assets/images/instagram/7.jpg" alt=""/>
                  <div class="insta-txt">
                    <div>
                      <svg class="insta-icon">
                        <use href="../assets/svg/icon-sprite.svg#instagram"></use>
                      </svg>
                      <p>Instashop</p>
                      <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="product.html">Discover
                          <svg>
                            <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                          </svg></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
    
@section('page-script')
    <script src="{{asset('frontend/js/swiper-slider/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/swiper-slider/swiper-custom.js')}}"></script>
@endsection

    
    
    
    
   
 