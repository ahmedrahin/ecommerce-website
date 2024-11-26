<div class="row g-md-4 g-lg-4 g-2" id="hilghtrow">
    <div class="col-xxl-3 col-lg-3 col-6"> 
      <div class="special-offer-slider"> 
        <h4>New Arrivals</h4>
        <div class="swiper special-offer-slide">
          <div class="swiper-wrapper trending-products">
            @foreach ($newArrivales as $product)
                <div class="swiper-slide product-box-3">
                    <div class="img-wrapper">
                    <div class="label-block">
                        <span class="lable-1">NEW</span>
                    </div>
    
                    <div class="product-image {{ !is_null($product->back_image) ? 'has-back-image' : '' }}">
                        <a href="{{route('product-details', $product->slug)}}">
                            <img class="product-thumb" src="{{ asset($product->thumb_image ?? 'frontend/images/blank.jpg') }}" alt="product">
                            @if(!is_null($product->back_image))
                                <img class="product-back" src="{{ asset($product->back_image) }}" alt="product-back">
                            @endif
                        </a>
                    </div>

                    </div>
    
                    <div class="product-detail">
                        <div class="rating p-0">
                            @php
                                $reviews = App\Models\Review::where('product_id', $product->id)->get();
                                $averageRating = $reviews->avg('rating');
                                $averageRating = round($reviews->avg('rating'), 1);
                                $fullStars = floor($averageRating);
                                $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;
                            @endphp
                        
                            <ul class="">
                                <!-- Full stars -->
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <li><i class="fa-solid fa-star"></i></li>
                                @endfor
                        
                                <!-- Half star if needed -->
                                @if ($halfStar)
                                    <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                @endif
                        
                                <!-- Empty stars -->
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <li><i class="fa-regular fa-star"></i></li>
                                @endfor
                        
                                <!-- Review count -->
                                <li><span>({{ $reviews->count() }})</span></li>
                            </ul>
                        
                        </div>
                        <a href="{{route('product-details', $product->slug)}}">
                            <h6 style="font-weight: 700;">{{ Str::limit($product->name, 28, '...') }}</h6>
                        </a>
                        
                        <p>
                            {{$product->offer_price}}৳
                            @if( $product->discount_option == 2 || $product->discount_option == 3 )
                                <del class="text-danger opacity-80">
                                    {{$product->base_price}}৳
                                </del>
                                @php
                                    $discountPercentage = round((($product->discount_amount) / $product->base_price) * 100);
                                @endphp
                            @endif
                        </p>
                        
                    </div>
                </div>
            @endforeach
            
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
    </div>

    <div class="col-xxl-3 col-lg-3 col-6"> 
        <div class="special-offer-slider"> 
          <h4>Featured Products</h4>
          <div class="swiper special-offer-slide">
            <div class="swiper-wrapper trending-products">
              @foreach ($featured as $product)
                  <div class="swiper-slide product-box-3">
                      <div class="img-wrapper">
                      @if( $product->is_new == 1 )
                        <div class="label-block">
                            <span class="lable-1">NEW</span>
                        </div>
                      @endif
      
                      <div class="product-image {{ !is_null($product->back_image) ? 'has-back-image' : '' }}">
                          <a href="{{route('product-details', $product->slug)}}">
                              <img class="product-thumb" src="{{ asset($product->thumb_image ?? 'frontend/images/blank.jpg') }}" alt="product">
                              @if(!is_null($product->back_image))
                                  <img class="product-back" src="{{ asset($product->back_image) }}" alt="product-back">
                              @endif
                          </a>
                      </div>
  
                      </div>
      
                      <div class="product-detail">
                          <div class="rating p-0">
                              @php
                                  $reviews = App\Models\Review::where('product_id', $product->id)->get();
                                  $averageRating = $reviews->avg('rating');
                                  $averageRating = round($reviews->avg('rating'), 1);
                                  $fullStars = floor($averageRating);
                                  $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                  $emptyStars = 5 - $fullStars - $halfStar;
                              @endphp
                          
                              <ul class="">
                                  <!-- Full stars -->
                                  @for ($i = 0; $i < $fullStars; $i++)
                                      <li><i class="fa-solid fa-star"></i></li>
                                  @endfor
                          
                                  <!-- Half star if needed -->
                                  @if ($halfStar)
                                      <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                  @endif
                          
                                  <!-- Empty stars -->
                                  @for ($i = 0; $i < $emptyStars; $i++)
                                      <li><i class="fa-regular fa-star"></i></li>
                                  @endfor
                          
                                  <!-- Review count -->
                                  <li><span>({{ $reviews->count() }})</span></li>
                              </ul>
                          
                          </div>
                          <a href="{{route('product-details', $product->slug)}}">
                              <h6 style="font-weight: 700;">{{ Str::limit($product->name, 28, '...') }}</h6>
                          </a>
                          
                          <p>
                              {{$product->offer_price}}৳
                              @if( $product->discount_option == 2 || $product->discount_option == 3 )
                                  <del class="text-danger opacity-80">
                                      {{$product->base_price}}৳
                                  </del>
                                  @php
                                      $discountPercentage = round((($product->discount_amount) / $product->base_price) * 100);
                                  @endphp
                              @endif
                          </p>
                          
                      </div>
                  </div>
              @endforeach
              
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3 col-6"> 
        <div class="special-offer-slider"> 
          <h4>Best Selling</h4>
          <div class="swiper special-offer-slide">
            <div class="swiper-wrapper trending-products">
              @foreach ($selling as $product)
                  <div class="swiper-slide product-box-3">
                      <div class="img-wrapper">
                      @if( $product->is_new == 1 )
                        <div class="label-block">
                            <span class="lable-1">NEW</span>
                        </div>
                      @endif
      
                      <div class="product-image {{ !is_null($product->back_image) ? 'has-back-image' : '' }}">
                          <a href="{{route('product-details', $product->slug)}}">
                              <img class="product-thumb" src="{{ asset($product->thumb_image ?? 'frontend/images/blank.jpg') }}" alt="product">
                              @if(!is_null($product->back_image))
                                  <img class="product-back" src="{{ asset($product->back_image) }}" alt="product-back">
                              @endif
                          </a>
                      </div>
  
                      </div>
      
                      <div class="product-detail">
                          <div class="rating p-0">
                              @php
                                  $reviews = App\Models\Review::where('product_id', $product->id)->get();
                                  $averageRating = $reviews->avg('rating');
                                  $averageRating = round($reviews->avg('rating'), 1);
                                  $fullStars = floor($averageRating);
                                  $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                  $emptyStars = 5 - $fullStars - $halfStar;
                              @endphp
                          
                              <ul class="">
                                  <!-- Full stars -->
                                  @for ($i = 0; $i < $fullStars; $i++)
                                      <li><i class="fa-solid fa-star"></i></li>
                                  @endfor
                          
                                  <!-- Half star if needed -->
                                  @if ($halfStar)
                                      <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                  @endif
                          
                                  <!-- Empty stars -->
                                  @for ($i = 0; $i < $emptyStars; $i++)
                                      <li><i class="fa-regular fa-star"></i></li>
                                  @endfor
                          
                                  <!-- Review count -->
                                  <li><span>({{ $reviews->count() }})</span></li>
                              </ul>
                          
                          </div>
                          <a href="{{route('product-details', $product->slug)}}">
                              <h6 style="font-weight: 700;">{{ Str::limit($product->name, 28, '...') }}</h6>
                          </a>
                          
                          <p>
                              {{$product->offer_price}}৳
                              @if( $product->discount_option == 2 || $product->discount_option == 3 )
                                  <del class="text-danger opacity-80">
                                      {{$product->base_price}}৳
                                  </del>
                                  @php
                                      $discountPercentage = round((($product->discount_amount) / $product->base_price) * 100);
                                  @endphp
                              @endif
                          </p>
                          
                      </div>
                  </div>
              @endforeach
              
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3 col-6"> 
        <div class="special-offer-slider"> 
          <h4>4+ Star Products</h4>
          <div class="swiper special-offer-slide">
            <div class="swiper-wrapper trending-products">
              @foreach ($productsWithHighReviews as $product)
                  <div class="swiper-slide product-box-3">
                      <div class="img-wrapper">
                      @if( $product->is_new == 1 )
                        <div class="label-block">
                            <span class="lable-1">NEW</span>
                        </div>
                      @endif
      
                      <div class="product-image {{ !is_null($product->back_image) ? 'has-back-image' : '' }}">
                          <a href="{{route('product-details', $product->slug)}}">
                              <img class="product-thumb" src="{{ asset($product->thumb_image ?? 'frontend/images/blank.jpg') }}" alt="product">
                              @if(!is_null($product->back_image))
                                  <img class="product-back" src="{{ asset($product->back_image) }}" alt="product-back">
                              @endif
                          </a>
                      </div>
  
                      </div>
      
                      <div class="product-detail">
                          <div class="rating p-0">
                              @php
                                  $reviews = App\Models\Review::where('product_id', $product->id)->get();
                                  $averageRating = $reviews->avg('rating');
                                  $averageRating = round($reviews->avg('rating'), 1);
                                  $fullStars = floor($averageRating);
                                  $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                  $emptyStars = 5 - $fullStars - $halfStar;
                              @endphp
                          
                              <ul class="">
                                  <!-- Full stars -->
                                  @for ($i = 0; $i < $fullStars; $i++)
                                      <li><i class="fa-solid fa-star"></i></li>
                                  @endfor
                          
                                  <!-- Half star if needed -->
                                  @if ($halfStar)
                                      <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                  @endif
                          
                                  <!-- Empty stars -->
                                  @for ($i = 0; $i < $emptyStars; $i++)
                                      <li><i class="fa-regular fa-star"></i></li>
                                  @endfor
                          
                                  <!-- Review count -->
                                  <li><span>({{ $reviews->count() }})</span></li>
                              </ul>
                          
                          </div>
                          <a href="{{route('product-details', $product->slug)}}">
                              <h6 style="font-weight: 700;">{{ Str::limit($product->name, 28, '...') }}</h6>
                          </a>
                          
                          <p>
                              {{$product->offer_price}}৳
                              @if( $product->discount_option == 2 || $product->discount_option == 3 )
                                  <del class="text-danger opacity-80">
                                      {{$product->base_price}}৳
                                  </del>
                                  @php
                                      $discountPercentage = round((($product->discount_amount) / $product->base_price) * 100);
                                  @endphp
                              @endif
                          </p>
                          
                      </div>
                  </div>
              @endforeach
              
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
    </div>
  </div>