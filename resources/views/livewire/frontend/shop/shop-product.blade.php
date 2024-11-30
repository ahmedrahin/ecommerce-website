<div >
    <div class="row-cols-lg-4 row-cols-md-3 row-cols-2 grid-section view-option row g-3 g-xl-4" >
   
        @if( !$products->isEmpty() )
        @foreach ($products as $product)
        <div> 
            <div class="product-box-3">
                <div class="img-wrapper">
                    {{-- Wishlist logic --}}
                    @if( config('website_settings.show_wishlist') == true )
                        <div class="label-block">
                            @if(in_array($product->id, $wishlist))
                                <button class="label-2 wishlist-exist" style="border: none;" wire:click="$emit('removeFromWishlist', {{ $product->id }})">
                                    <i class="fa fa-heart " aria-hidden="true" style="color: #ff00008a;"></i>
                                </button>
                            @else
                                <button class="label-2 wishlist-icon" style="border: none;" wire:click="$emit('get_id', {{ $product->id }})">
                                    <i class="fa-regular fa-heart" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i>
                                </button>
                            @endif
                        </div>
                    @endif
    
                    {{-- Product thumb or back image --}}
                    <div class="product-image {{ !is_null($product->back_image) ? 'has-back-image' : '' }}">
                        <a href="{{route('product-details', $product->slug)}}">
                            <img class="product-thumb" src="{{ asset($product->thumb_image ?? 'frontend/images/blank.jpg') }}" alt="product">
                            @if(!is_null($product->back_image))
                                <img class="product-back" src="{{ asset($product->back_image) }}" alt="product-back">
                            @endif
                        </a>
                    </div>
    
                    {{-- Countdown timer --}}
                    @if( config('website_settings.show_expire_date') == true )
                        @if( !is_null( $product->expire_date ) )
                            <div class="countdown" id="countdown-{{ $product->id }}">
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
        
                            {{-- Countdown timer script --}}
                            <script>
                                (function() {
                                    const expireDate = new Date('{{ $product->expire_date }}').getTime();
                                    const countdownElement = document.querySelector("#countdown-{{ $product->id }} .clockdiv1");
        
                                    function updateTimer() {
                                        const now = new Date().getTime();
                                        const timeLeft = expireDate - now;
        
                                        if (timeLeft < 0) {
                                            countdownElement.innerHTML = "<li>Product Expired</li>";
                                            return;
                                        }
        
                                        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                                        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                                        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        
                                        countdownElement.querySelector(".days").textContent = days;
                                        countdownElement.querySelector(".hours").textContent = hours;
                                        countdownElement.querySelector(".minutes").textContent = minutes;
                                        countdownElement.querySelector(".seconds").textContent = seconds;
                                    }
        
                                    setInterval(updateTimer, 1000);
                                    updateTimer();
                                })();
                            </script>
                        @endif
                    @endif
                </div>
    
                {{-- Product details --}}
                <div class="product-detail">
                    {{-- Review display logic --}}
                    @if( config('website_settings.show_review') == true )
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
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <li><i class="fa-solid fa-star"></i></li>
                                @endfor
                                @if ($halfStar)
                                    <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <li><i class="fa-regular fa-star"></i></li>
                                @endfor
                                <li><span>({{ $reviews->count() }})</span></li>
                            </ul>
                        </div>
                    @endif
    
                    <a href="{{route('product-details', $product->slug)}}">
                        <h6 style="font-weight: 700;">{{ Str::limit($product->name, 22, '...') }}</h6>
                    </a>
    
                    <p>
                        {{$product->offer_price}}৳
                        @if( $product->discount_option == 2 || $product->discount_option == 3 )
                            <del class="text-danger opacity-80">{{$product->base_price}}৳</del>
                            @php
                                $discountPercentage = round((($product->discount_amount) / $product->base_price) * 100);
                            @endphp
                            <span class="discountvalue">-{{ $discountPercentage }}%</span>
                        @endif
                    </p>
                </div>
                <div>
                    @if( $product->quantity > 0 )
                        <button class="button btn btn_black btn-buy quickview" data-bs-toggle="modal" data-bs-target="#quick-view" data-product-id="{{$product->id}}"> 
                            <i class="fa fa-cart-plus"></i> Buy Now
                        </button>
                    @else
                        <button class="button btn btn_black btn-buy stock-out" disabled>Out of stock!!</button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    
        @else 
             <div style="color: #ff00008a;font-size: 20px;font-weight: 600;width: 100%;">No products found.</div>
        @endif
        
    </div>
    
    <div class="pagination-wrap mt-0">
        <ul class="pagination"> 
            {{ $products->links() }}
        </ul>
    </div>
</div>