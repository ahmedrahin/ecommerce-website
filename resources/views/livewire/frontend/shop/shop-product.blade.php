<div>
    <div class="row-cols-lg-4 row-cols-md-3 row-cols-2 grid-section view-option row g-3 g-xl-4">
   
        @if( !$products->isEmpty() )
            @foreach ($products as $product)
                <div> 
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
                        <ul class="rating">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star-half-stroke"></i></li>
                            <li><i class="fa-regular fa-star"></i></li>
                            <li>4.3</li>
                        </ul>
                        <a href="{{route('product-details', $product->slug)}}">
                            <h6 style="font-weight: 700;">{{ $product->name }}</h6>
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
                            <button class="button btn btn_black btn-buy"> <i class="fa fa-cart-plus"></i> Buy Now</button>
                    </div>
                    </div>
                </div>
            @endforeach
        @else 
             <div style="color: #ff00008a;font-size: 20px;font-weight: 600;">No products found.</div>
        @endif
    
    </div>
    
    <div class="pagination-wrap mt-5">
        <ul class="pagination"> 
            {{ $products->links() }}
        </ul>
    </div>
</div>