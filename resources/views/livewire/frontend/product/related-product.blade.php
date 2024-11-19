<div class="custom-container container product-contain">
    @if( !$products->isEmpty() )
        <div class="title text-start"> 
        <h3>You may also like</h3>
        <svg>
            <use href="../assets/svg/icon-sprite.svg#main-line"></use>
        </svg>
        </div>

        <div class="swiper special-offer-slide-2">
        <div class="swiper-wrapper ratio1_3">
            @foreach ($products as $product)
                <div class="swiper-slide">
                    <div class="product-box-3">
                        <div class="img-wrapper">
                        <div class="label-block"><a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a>
                            </div>

                            {{-- product thumb or back image --}}
                        <div class="product-image {{ !is_null($product->back_image) ? 'has-back-image' : '' }}">
                                <a href="{{route('product-details', $product->slug)}}">
                                    <img class="product-thumb" src="{{ asset($product->thumb_image ?? 'frontend/images/blank.jpg') }}" alt="product">
                                    @if(!is_null($product->back_image))
                                        <img class="product-back" src="{{ asset($product->back_image) }}" alt="product-back">
                                    @endif
                                </a>
                            </div>

                            {{-- expire date --}}
                            @if( !is_null( $product->expire_date ) )
                                <div class="countdown">
                                    <ul class="clockdiv1">
                                        <li>
                                            <div class="timer">
                                            <div class="days"></div>
                                            </div>
                                            <span class="title">Days</span>
                                        </li>
                                        <li class="dot"> <span>:</span></li>
                                        <li>
                                            <div class="timer">
                                            <div class="hours"></div>
                                            </div>
                                            <span class="title">Hours</span>
                                        </li>
                                        <li class="dot"> <span>:</span></li>
                                        <li>
                                            <div class="timer">
                                            <div class="minutes"></div>
                                            </div>
                                            <span class="title">Min</span>
                                        </li>
                                        <li class="dot"> <span>:</span></li>
                                        <li>
                                            <div class="timer">
                                            <div class="seconds"></div>
                                            </div>
                                            <span class="title">Sec</span>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        
                        </div>

                        <div class="product-detail">
                            

                            <a href="{{route('product-details', $product->slug)}}">
                                <h6 style="font-weight: 700;">{{ Str::limit($product->name, 25, '...') }}</h6>
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
                                    <span class="discountvalue">-{{ $discountPercentage }}%</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            @if( $product->quantity > 0 )
                                <button class="button btn btn_black btn-buy quickview" data-bs-toggle="modal" data-bs-target="#quick-view" data-product-id="{{$product->id}}"> <i class="fa fa-cart-plus"></i> Buy Now</button>
                            @else
                                <button class="button btn btn_black btn-buy stock-out" disabled>Out of stock!!</button>
                            @endif
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
        </div>
    @endif
</div>
