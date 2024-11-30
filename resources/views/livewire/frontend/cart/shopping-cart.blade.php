
<div class="offcanvas offcanvas-end shopping-details" id="offcanvasRight" tabindex="-1" aria-labelledby="offcanvasRightLabel" wire:ignore.self>
    <div class="offcanvas-header">
      <h4 class="offcanvas-title" id="offcanvasRightLabel">Shopping Cart</h4>
      <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body theme-scrollbar">
        @if( !empty($cart) )
            <ul class="offcanvas-cart">
                @foreach($cart as $cartKey => $item)
                    <li>
                        <a href="{{ route('product-details', $item['slug']) }}">
                            <img src="{{ asset($item['image_url']) }}" alt="{{ $item['name'] }}"/>
                        </a>
                        <div> 
                            <a href="{{ route('product-details', $item['slug']) }}"> 
                                <h6 class="mb-0">{{ $item['name'] }}</h6>
                            </a>
                            
                            <!-- Display selected size and color -->
                            <p>
                                @if(isset($item['size']) && $item['size'])
                                    <strong>Size:</strong> {{ $item['size'] }}
                                @endif
                                @if(isset($item['color']) && $item['color'])
                                    <strong>Color:</strong> {{ $item['color'] }}
                                @endif
                            </p>
                
                            <p>
                                ৳{{ $item['offer_price'] }}
                                @if($item['discount_option'] != 1)
                                    <del style="font-size: 14px;color: #ff4f4fb0;">৳{{ $item['price'] }}</del>
                                @endif
                                <span class="btn-cart"> = ৳<span class="btn-cart__total">{{ $item['offer_price'] * $item['quantity'] }}</span></span>
                            </p>
                
                            <div class="quantity">
                                <button type="button" class="removeQty" wire:click="decrementQuantity('{{ $cartKey }}')">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                
                                <input type="number" class="Qtyinput" wire:model.lazy="quantities.{{ $cartKey }}" 
                                    min="1" wire:change="updateQuantities('{{ $cartKey }}', $event.target.value)"
                                    value="{{ $item['quantity'] }}" />
                                    
                                <button type="button" class="addQty" wire:click="incrementQuantity('{{ $cartKey }}')">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div> 
                
                        </div>
                        <i wire:click="removeItem('{{ $cartKey }}')" class="iconsax delete-icon" data-icon="trash"></i>
                    </li>
                @endforeach
            
            </ul>
        @else
            <div class="no-cart">
                <img src="{{asset('frontend/images/no-shopping-cart.png')}}" alt="">
                <h5>Your Cart is Empty</h5>
                <a href="{{route('shop')}}">
                    Start shopping
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        @endif
       
    </div>
    
    @if( !empty($cart) )
        <div class="offcanvas-footer">
            <div class="price-box"> 
                <h6>Total :</h6>
                <p>৳ {{ number_format($this->getTotalAmount(), 2) }}</p>
            </div>
            <div class="cart-button"> <a class="btn btn_outline" href="{{route('cart')}}"> View Cart</a>
                @if( config('website_settings.guest_checkout') == 1 && Auth::check() )
                    <a class="btn btn_black" href="{{route('checkout')}}"> Checkout</a>
                @elseif( config('website_settings.guest_checkout') == 0 && !Auth::check() )
                    <button class="btn btn_black" onclick="error('Please log in at first to checkout')">Checkout</button>
                @else 
                    <a class="btn btn_black" href="{{route('checkout')}}"> Checkout</a>
                @endif
            </div>
        </div>
    @endif
      
</div>