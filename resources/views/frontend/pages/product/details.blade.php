@extends('frontend.layout.app')
    
@section('page-title')
    {{$product->name}} | {{config('app.name')}}
@endsection

@section('page-css')
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/swiper-slider/swiper-bundle.min.css')}}"/>

  <style>
    #Description-tab-pane li{
      display: block !important;
    }

    .submited-review ul li{
        display: block;
    }
    .submited-review .rating li{
        display: inline-block !important;
    }
    .submited-review h4 {
        font-size: 15px;
    }
    .submited-review i {font-size: 10px;}
    .submited-review {
        background: #F8F8F8;
        padding: 20px;
        margin-top: 25px;
        position: relative;
    }
    .selectrating {
        border: none;
        display: inline-flex;
        flex-direction: row-reverse; /* Reverse the order of the stars */
    }

    .selectrating > input {
        display: none;
    }

    .selectrating > label:before {
      margin: 3px;
      font-size: 16px;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }

    .selectrating > label {
        color: #ddd;
        cursor: pointer;
    }

    /* Highlight stars on hover and selection */
    .selectrating > input:checked ~ label,
    .selectrating > label:hover,
    .selectrating > label:hover ~ label {
        color: #FFD700;
    }
    .delete-review{
      background: none;
      border: none;
      padding: 0;
      position: absolute;
      right: 15px;
      top: 12px;
    }
    .delete-review i {
      color: #ff4f4f;
      font-size: 15px
    }
  </style>
@endsection

    
@section('body-content')

  <section class="section-b-space pt-0 product-thumbnail-page"> 
    <div class="custom-container container">
      <div class="row gy-4">
        <div class="col-lg-6"> 
          <div class="row sticky">
            <div class="col-sm-2 col-3">
              <div class="swiper product-slider product-slider-img"> 
                <div class="swiper-wrapper"> 
                  <div class="swiper-slide"><img src="{{asset($product->thumb_image)}}" alt=""></div>

                  {{-- product gellary image --}}
                  @foreach($product->galleryImages ?? [] as $gellary)
                    <div class="swiper-slide"><img src="{{asset($gellary->image)}}" alt=""></div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="col-sm-10 col-9">
              <div class="swiper product-slider-thumb product-slider-img-1">
                <div class="swiper-wrapper ratio_square-2">
                  <div class="swiper-slide"> <img class="bg-img" src="{{asset($product->thumb_image)}}" alt=""></div>
                   {{-- product gellary image --}}
                   @foreach($product->galleryImages ?? [] as $gellary)
                      <div class="swiper-slide"><img class="bg-img" src="{{asset($gellary->image)}}" alt=""></div>
                   @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="product-detail-box"> 
            <div class="product-option"> 

              {{-- sell details --}}
              <div class="sell-details d-flex gap-2">
                <div class="move-fast-box d-flex align-items-center gap-2">
                  <i class="fa fa-cart-plus" style="color: #ff6b6b;"></i>
                  <p>Total Orders: {{$product->orderItems->count()}}</p>
                </div>
  
                <div class="move-fast-box d-flex align-items-center gap-2">
                  <i class="fa fa-heart" style="color: #ff6b6b;"></i>
                  <p>Active Wishlist: {{$product->wishlist->count()}}</p>
                </div>
              </div>

              <h3>{{$product->name}}</h3>
              <p>
                {{$product->offer_price}}৳
                @if( $product->discount_option == 2 || $product->discount_option == 3 )
                  @php
                      $discountPercentage = round((($product->discount_amount) / $product->base_price) * 100);
                  @endphp
                  <del>{{$product->base_price}}৳</del><span class="offer-btn">{{$discountPercentage}}% off</span>
                @endif
              </p>

              {{-- rating --}}    
              <livewire:frontend.product.review-count :productId="$product->id" />

             <div class="short-description mb-3">
                @if( !is_null( $product->short_description) && ( $product->short_description != '<p><br></p>') )
                  {!! $product->short_description !!}
                @endif
             </div>

              {{-- chart and delivery information --}}
              <livewire:frontend.product.size-chart-qustion />

              {{-- add to cart and product varation --}}
              <livewire:frontend.cart.add-cart :productId="$product->id" />
              
              <div class="buy-box border-top pt-3">
                <ul> 
                   {{-- add wishlist --}}
                  <livewire:frontend.wishlist.towishlist :productId="$product->id"></livewire>
                  <li> 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#social-box" title="Quick View" tabindex="0">
                      <i class="fa-solid fa-share-nodes me-2"></i>Share
                    </a>
                  </li>
                </ul>
              </div>

              {{-- add wishlist --}}
              <livewire:frontend.wishlist.add-wishlist></livewire>
              
              {{-- others infromation dz-info --}}
              @include('frontend.pages.product.dz-info')

              {{-- <div class="sale-box"> 
                <div class="d-flex align-items-center gap-2"><img src="../assets/images/gif/timer.gif" alt="">
                  <p>Limited Time Left! Hurry, Sale Ending!</p>
                </div>
                <div class="countdown">
                  <ul class="clockdiv1">
                    <li> 
                      <div class="timer">
                        <div class="days"></div>
                      </div><span class="title">Days</span>
                    </li>
                    <li>:</li>
                    <li> 
                      <div class="timer">
                        <div class="hours"></div>
                      </div><span class="title">Hours</span>
                    </li>
                    <li>:</li>
                    <li> 
                      <div class="timer">
                        <div class="minutes"></div>
                      </div><span class="title">Min</span>
                    </li>
                    <li>:</li>
                    <li> 
                      <div class="timer">
                        <div class="seconds"></div>
                      </div><span class="title">Sec</span>
                    </li>
                  </ul>
                </div>
              </div> --}}
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="product-section-box x-small-section pt-0"> 
      <div class="custom-container container">
        <div class="row"> 
          <div class="col-12"> 
            <ul class="product-tab theme-scrollbar nav nav-tabs nav-underline" id="Product" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="Description-tab" data-bs-toggle="tab" data-bs-target="#Description-tab-pane" role="tab" aria-controls="Description-tab-pane" aria-selected="true">Description</button>
              </li>
              
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="Reviews-tab" data-bs-toggle="tab" data-bs-target="#Reviews-tab-pane" role="tab" aria-controls="Reviews-tab-pane" aria-selected="false">Reviews</button>
              </li>
            </ul>
            <div class="tab-content product-content" id="ProductContent">
              <div class="tab-pane fade show active" id="Description-tab-pane" role="tabpanel" aria-labelledby="Description-tab" tabindex="0">
                <div class="row gy-4"> 
                  <div class="col-12">    
                    
                    @if( !is_null( $product->long_description) && ( $product->long_description != '<p><br></p>') )
                      {!! $product->long_description !!}
                    @else
                        <span style="color: #ff6b6b;font-weight: 700;font-size: 15px;font-style: italic;">No description in this product!</span>
                    @endif
                        
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="Reviews-tab-pane" role="tabpanel" aria-labelledby="Reviews-tab" tabindex="0"> 
                <livewire:frontend.product.product-review :productId="$product->id" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('frontend.pages.product.related-product')

  {{-- share modal --}}
  <div class="modal theme-modal fade social-modal" id="social-box" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6>Copy link</h6>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input class="form-field form-field--input" type="text" value="http://localhost:3000/katie/template/product.html#">
          <h6>Share:</h6>
          <ul> 
            <li> <a href="https://www.facebook.com/" target="_blank"> <i class="fa-brands fa-facebook-f"></i></a></li>
            <li> <a href="https://in.pinterest.com/" target="_blank"> <i class="fa-brands fa-pinterest-p"></i></a></li>
            <li> <a href="https://twitter.com/" target="_blank"> <i class="fa-brands fa-x-twitter"></i></a></li>
            <li> <a href="https://www.instagram.com/" target="_blank"> <i class="fa-brands fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
 
@endsection 
    
@section('page-script')
  <script src="{{asset('frontend/js/swiper-slider/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('frontend/js/swiper-slider/swiper-custom.js')}}"></script>
  
  {{-- review modal open or close --}}
  <script>
      const modal = document.querySelector('#Reviews-modal');
      modal.addEventListener('show.bs.modal', (e) => {
          Livewire.emit('open_add_modal');
      });

      document.addEventListener('livewire:load', function () {
            Livewire.on('success', function () {
              const cancelButton = document.querySelector('.cancel-modal-review');
              if (cancelButton) {
                  cancelButton.click();
              }
            });
        });
        
  </script>

  {{-- js for rating --}}
  <script>
    function setRating(value) {
        Livewire.emit('updatedRating', value);
    }
  </script>

@endsection