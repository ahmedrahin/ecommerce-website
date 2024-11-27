<div class="row g-4 align-items-center">
    <div class="col-xxl-9 col-xl-8">
        <div class="cart-table">
        <div class="table-title"> 
            <h5>Your Cart<span id="cartTitle">({{count($cart)}})</span></h5>
            <button id="clearAllButton" wire:click="clearCart">Clear All</button>
        </div>
        <div class="table-responsive theme-scrollbar"> 
            <table class="table" id="cart-table">
                <thead>
                    <tr> 
                    <th>Product </th>
                    <th>Price </th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach($cart as $cartKey => $item)
                        <tr> 
                            <td> 
                                <div class="cart-box">
                                    <a href="{{ route('product-details', $item['slug']) }}">
                                        <img src="{{ asset($item['image_url']) }}">
                                    </a>
                                    <div> 
                                        <a href="{{ route('product-details', $item['slug']) }}"> 
                                            <h5>{{ $item['name'] }}</h5>
                                        </a>
                                        <p>
                                            @if(isset($item['size']) && $item['size'])
                                                <strong>Size:</strong> {{ $item['size'] }}
                                            @endif
                                            @if(isset($item['color']) && $item['color'])
                                                <strong>Color:</strong> {{ $item['color'] }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                ৳{{ $item['offer_price'] }}
                                @if($item['discount_option'] != 1)
                                    <del style="font-size: 14px;color: #ff4f4fb0;display:block;">৳{{ $item['price'] }}</del>
                                @endif
                            </td>
                            <td>
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
                            </td>
                            <td>৳{{ $item['offer_price'] * $item['quantity'] }}</td>
                            <td>
                                <a class="deleteButton" href="javascript:void(0)" wire:click="removeItem('{{ $cartKey }}')">
                                    <i class="iconsax" data-icon="trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        </div>
    </div>
    <div class="col-xxl-3 col-xl-4">
        <div class="cart-items">      
            <div class="cart-body"> 
                <h6 class="m-0">Cart Items ({{count($cart)}} Items) </h6>
                <ul> 
                    <li> 
                        <p>Total Qty </p><span>{{ array_sum(array_column($cart, 'quantity')) }}</span>
                    </li>
                </ul>
            </div>
            <div class="cart-bottom"> 
                <p><i class="iconsax me-1" data-icon="tag-2"></i>SPECIAL OFFER (-৳0) </p>
                <h6 class="mb-3 mt-2">Subtotal <span>৳{{ number_format($this->getTotalAmount(), 0) }}</span></h6>
            </div>
            @if( config('website_settings.guest_checkout') == 1 && Auth::check() )
                <a class="btn btn_black w-100 rounded sm" href="{{route('checkout')}}"> Checkout</a>
            @elseif( config('website_settings.guest_checkout') == 0 )
                <button class="btn btn_black w-100 rounded sm" onclick="error('Please log in at first to checkout')">Checkout</button>
            @else 
                <a class="btn btn_black w-100 rounded sm" href="{{route('checkout')}}"> Checkout</a>
            @endif
        </div>
    </div>
</div>