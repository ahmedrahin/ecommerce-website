<div>
    <div class="row-cols-xl-5 row-cols-md-3 row-cols-2 grid-section view-option row g-3 g-xl-4">
        @if( !$wishlistItems->isEmpty() )
            @foreach ($wishlistItems as $item)
                @if($item->product)
                    <div> 
                        <div class="product-box-3">
                            <div class="img-wrapper">
                            <div class="label-block">
                                <div class="label-block">
                                    <button class="label-2 wishlist-icon delete-button" title="delete Wishlist" tabindex="0" wire:click="removeFromWishlist({{$item->id}})" style="border: none;">
                                        <i class="iconsax" data-icon="trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- product thumb or back image --}}
                            <div class="product-image {{ !is_null($item->product->back_image) ? 'has-back-image' : '' }}">
                                <a href="{{ route('product-details', $item->product->slug) }}">
                                    <img class="product-thumb" src="{{ asset($item->product->thumb_image ?? 'frontend/images/blank.jpg') }}" alt="product">
                                    @if(!is_null($item->product->back_image))
                                        <img class="product-back" src="{{ asset($item->product->back_image) }}" alt="product-back">
                                    @endif
                                </a>
                            </div>

                            </div>
                            <div class="product-detail">
                                
                                <div class="rating p-0">
                                    @php
                                        $reviews = App\Models\Review::where('product_id', $item->product->id)->get();
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
                                

                                <a href="{{ route('product-details', $item->product->slug) }}">
                                    <h6 style="font-weight: 700;">{{ Str::limit($item->product->name, 22, '...') }}</h6>
                                </a>
        
                                <p>
                                    {{ $item->product->offer_price }}৳
                                    @if($item->product->discount_option == 2 || $item->product->discount_option == 3)
                                        <del class="text-danger opacity-80">
                                            {{ $item->product->base_price }}৳
                                        </del>
                                        @php
                                            $discountPercentage = round((($item->product->discount_amount) / $item->product->base_price) * 100);
                                        @endphp
                                        <span class="discountvalue">-{{ $discountPercentage }}%</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                @if($item->product->quantity > 0)
                                    <button class="button btn btn_black btn-buy quickview" data-bs-toggle="modal" data-bs-target="#quick-view" data-product-id="{{ $item->product->id }}"> <i class="fa fa-cart-plus"></i> Buy Now</button>
                                @else
                                    <button class="button btn btn_black btn-buy stock-out" disabled>Out of stock!!</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="alert alert-danger w-100 mb-0">No product found in your wishlist.</div>
        @endif
    </div>
</div>
