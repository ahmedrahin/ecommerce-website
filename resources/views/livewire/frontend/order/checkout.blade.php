<form id="checkout-form" wire:submit.prevent="order">
    <div class="row g-lg-5">
        <div class="col-md-6 col-lg-6"> 
            <div class="left-sidebar-checkout">
                <div class="">
                <div class="address-title mb-3"> 
                    <h4>Contact Info </h4>
                </div>
                
                    <div class="mb-3">
                        <label for="">Full Name</label>
                        <input type="text" class="form-control @error('name') error-border @enderror" placeholder="Full Name" wire:model="name">
                        @error('name')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">E-mail</label>
                                <input type="text" class="form-control @error('email') error-border @enderror" placeholder="Enter email" wire:model="email">
                                @error('email')
                                    <div class="text-danger mt-2">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Phone no.</label>
                                <input type="text" class="form-control @error('phone') error-border @enderror" placeholder="Phone number" wire:model="phone">
                                @error('phone')
                                    <div class="text-danger mt-2">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="address-title my-3"> 
                        <h4>Shipping Info </h4>
                    </div>

                    <div class="mb-3">
                        <label for="">Shipping Address</label>
                        <input type="text" class="form-control @error('shipping_address') error-border @enderror" placeholder="Shipping address" wire:model="shipping_address">
                        @error('shipping_address')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>City</label>
                        <select  class="form-control" wire:model="district_id">
                            <option value="">Select City</option>
                            @foreach( $districts as $district )
                                <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>
                        @error('shipping_address')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    <label for="">Note (optional) </label>
                    <textarea class="form-control" id="comment" cols="30" rows="4" placeholder="Write a note"></textarea>

                </div>
            
            </div>
            
        </div>

        <div class="col-md-6 col-lg-6">
        <div class="right-sidebar-checkout">
            <h4>Checkout</h4>
            <div class="cart-listing">
            <ul> 
                @foreach($cart as $cartKey => $item)
                    <li>
                        <a href="{{ route('product-details', $item['slug']) }}">
                            <img src="{{ asset($item['image_url']) }}" width="55px"/>
                        </a>
                        <div> 
                            <a href="{{ route('product-details', $item['slug']) }}"> 
                                <h6>{{ ($item['name']) }}</h6>
                            </a>
                            <span style="display: block">
                                @if(isset($item['size']) && $item['size'])
                                    <strong>Size:</strong> {{ $item['size'] }}
                                @endif
                                @if(isset($item['color']) && $item['color'])
                                    <strong>Color:</strong> {{ $item['color'] }}
                                @endif
                            </span>
                        </div>
                        <p>
                            {{$item['quantity']}} X @if($item['discount_option'] != 1)  <del style="font-size: 14px;color: #ff4f4fb0;">৳{{ $item['price'] }}</del>@endif ৳{{$item['offer_price']}}
                        </p>
                    </li>
                @endforeach
            </ul>
            <div class="summary-total"> 
                <ul> 
                    <li> 
                        <p>Subtotal:</p><span>৳ {{ number_format($this->getTotalAmount(), 2) }}</span>
                    </li>
                    <li> 
                        <p>Shipping (+):</p>
                        @if($selectedShippingCharge) 
                            <span>
                                ৳{{ $selectedShippingCharge }}
                            </span>
                        @elseif($shippingMethods->count() > 1)
                        <span>
                            @foreach($shippingMethods as $shippingMethod)
                                <div style="text-align: right;">
                                    <input type="radio" 
                                    wire:model="selectedShippingMethodId" 
                                    value="{{ $shippingMethod->id }}" 
                                    id="shipping-method-{{ $shippingMethod->id }}" 
                                    @if($loop->first && !$selectedShippingMethodId) checked @endif />
                                    <label for="shipping-method-{{ $shippingMethod->id }}">
                                        {{ $shippingMethod->provider_name }} - ৳{{ $shippingMethod->provider_charge }}
                                    </label>
                                </div>
                            @endforeach
                        </span>
                        @elseif($shippingMethods->count() === 1)
                            @php $singleMethod = $shippingMethods->first(); @endphp
                            <span>
                            ৳{{ $singleMethod->provider_charge }}
                            </span>
                        @else
                            <span>
                                ৳0
                            </span>
                        @endif
                    </li>

                    {{-- coupon item --}}
                    @if(!empty($appliedCoupon))
                        <li>
                            <p>Coupon Discount (-):</p>
                            <span>৳{{ $appliedCoupon['discount'] }}</span>
                        </li>
                    @endif
                </ul>

                @if(empty($appliedCoupon))
                    <div class="coupon-code"> 
                        <input type="text" wire:model="couponCode" placeholder="Enter Coupon Code">
                        <button class="btn btn-coupon" type="button" wire:click="applyCoupon" style="width: 85px;">
                            <span wire:loading.remove wire:target="applyCoupon">Apply</span>
                            <span wire:loading wire:target="applyCoupon">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </span>
                        </button>
                    </div>
                @else
                    <div class="coupon-code"> 
                        <input type="text" value="{{$appliedCoupon['code']}}" readonly>
                        <button class="btn btn-coupon" type="button" wire:click="removeCoupon" style="width: 85px;">
                            <span wire:loading.remove wire:target="removeCoupon">Cancel</span>
                            <span wire:loading wire:target="removeCoupon">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </span>
                        </button>
                    </div>
                @endif
            </div>

            <div class="payment-options">
                <h4 class="mb-3" style="font-size: 16px;">Payment Options</h4>
                <div class="row gy-3">
                  <div class="col-sm-6"> 
                    <div class="payment-box">
                      <input class="me-2" id="cod" type="radio" checked="checked" value="cod" wire:model="payment_type">
                      <label for="cod">
                        <img src="{{asset('frontend/images/cod-pay.png')}}" alt="">
                      </label>
                    </div>
                  </div>

                  <div class="col-sm-6"> 
                    <div class="payment-box">
                      <input class="me-2" id="ssl" type="radio" checked="checked" value="ssl" wire:model="payment_type">
                      <label for="ssl">
                        <img src="{{asset('frontend/images/card-pay.png')}}" alt="">
                      </label>
                    </div>
                  </div>
     
                </div>
              </div>

            <div class="total">
                <h6>Total : </h6>
                <h6>৳ {{ number_format($this->grandTotal(), 2) }}</h6>
            </div>
            <div class="order-button">
                <button class="btn btn_black sm w-100 rounded" type="submit">
                    <span wire:loading.remove wire:target="order">Confirm Order</span>
                    <span wire:loading wire:target="order">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </span>
                </button>
            </div>
            </div>
        </div>
        </div>
    </div>
</form>