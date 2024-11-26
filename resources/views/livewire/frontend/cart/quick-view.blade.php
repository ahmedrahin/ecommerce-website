<div class="modal theme-modal fade" id="quick-view" tabindex="-1" role="dialog" aria-modal="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        @if( $on )
          <div class="modal-body">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="row align-items-center">
              <div class="col-lg-6 col-xs-12">
                <div class="quick-view-img">
                  <img class="bg-img" src="{{asset($product->thumb_image)}}" alt=""/>
                </div>
              </div>
              <div class="col-lg-6 rtl-text">
                <div class="product-right">
                  <div class="product-info">
                    <h3 class="name">{{$product->name}}</h3>
                    <h6>
                      ৳{{$product->offer_price}}
                      @if( $product->discount_option == 2 || $product->discount_option == 3 )
                        @php
                            $discountPercentage = round((($product->discount_amount) / $product->base_price) * 100);
                        @endphp
                        ৳<del style="color:#767676;">{{$product->base_price}}</del><span class="offer-btn">{{$discountPercentage}}% off</span>
                      @endif
                    </h6>
                  </div>
                  
                    {{-- product single variation --}}
                    @php 
                      $productStocks = $product->productStock ?? collect(); 
                      $attributesList = $attributes->keyBy('id'); 
                      $attributesValuesList = $attributesValues->keyBy('id'); 
                      $groupedAttributes = []; 

                      $singleVariationStocks = $productStocks->filter(function ($productStock) {
                            return $productStock->attributeOptions->count() === 1; 
                        });
                    @endphp

                    @if($singleVariationStocks->isNotEmpty())
                      {{-- Group attributes and their values --}}
                      @foreach ($singleVariationStocks as $productStock)
                          @php 
                              $attributeOptions = $productStock->attributeOptions; 
                          @endphp

                          @foreach ($attributeOptions as $attributeOption)
                              @php
                                  $groupedAttributes[$attributeOption->attribute_id][] = $attributesValuesList[$attributeOption->attribute_value_id] ?? '';
                              @endphp
                          @endforeach
                      @endforeach
                      <div class="product-variant">
                      {{-- Display all attributes except "Color" first --}}
                      @foreach ($groupedAttributes as $attribute_id => $attributeValues)
                          @if($attributesList[$attribute_id]->attr_name != 'Color' && $attributesList[$attribute_id]->attr_name == 'Size')
                              <div class="d-flex mb-3">
                                  <div> 
                                      <h5>{{ $attributesList[$attribute_id]->attr_name }}:</h5>
                                      <div class="option-box">
                                          <ul class="selected">
                                              @foreach ($attributeValues as $value)
                                                  <li data-size="{{ $value->attr_value }}" class="{{ $value->attr_value == $selectedSize ? 'active' : '' }}" >
                                                      <label>{{ is_object($value) ? $value->attr_value : $value }}</label>
                                                  </li>
                                              @endforeach
                                          </ul>
                                      </div>
                                      @if ($sizeError)
                                          <div class="text-danger">{{ $sizeError }}</div>
                                      @endif
                                  </div>
                              </div>
                          @endif
                      @endforeach

                      {{-- Display the "Color" attribute last --}}
                      @php
                          $colorAttribute = $attributesList->firstWhere('attr_name', 'Color');
                          $colorValues = $colorAttribute ? ($groupedAttributes[$colorAttribute->id] ?? []) : [];
                      @endphp

                      @if(!empty($colorValues))
                        <div>
                            <h5 style="margin: 0">Color:</h5>
                            <div class="color-box">
                                <ul class="color-variant" style="border: none !important;">
                                    @foreach ($colorValues as $color)
                                        <li style="background: {{ is_object($color) ? ($color->option ?: $color->attr_value) : $color }};" title="{{ is_object($color) ? $color->attr_value : $color }}" data-color="{{ $color->attr_value }}" class="{{ $color->attr_value == $selectedColor ? 'active' : '' }}" >
                                        </li>
                                    @endforeach
                                </ul>
                                @if ($colorError)
                                  <div class="text-danger" style="margin-top:-10px;">{{ $colorError }}</div>
                              @endif
                            </div>
                        </div>
                      @endif
                    </div>
                    @endif

                  <div class="product-description">
                    
                    <h6 class="product-title">Quantity</h6>
                   <div class="quantity quantity-quickview">
                        <button type="button" class="minus">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" class="quntity-filed" wire:model="quantity" min="1" data-quantity="{{$product->quantity}}" />
                        <button  type="button" class="plus">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                  </div>

                  <div class="product-buttons">
                    <button class="btn btn-solid" wire:click="addToCart" style="width: 108px;">
                        <span wire:loading.remove wire:target="addToCart">Add to cart</span>
                        <span wire:loading wire:target="addToCart">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </span>
                    </button>
                    <a class="btn btn-solid" href="{{route('product-details',$product->slug)}}">View detail</a>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>

    
</div>
