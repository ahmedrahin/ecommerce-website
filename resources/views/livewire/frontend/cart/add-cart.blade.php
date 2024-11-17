<div>
   {{-- product variation --}}

   @php 
      $productStocks = $product->productStock ?? collect(); 
      $attributesList = $attributes->keyBy('id'); 
      $attributesValuesList = $attributesValues->keyBy('id'); 
      $groupedAttributes = []; 
    @endphp

    @if($productStocks->isNotEmpty())
      {{-- Group attributes and their values --}}
      @foreach ($productStocks as $productStock)
          @php 
              $attributeOptions = $productStock->attributeOptions; 
          @endphp

          @foreach ($attributeOptions as $attributeOption)
              @php
                  $groupedAttributes[$attributeOption->attribute_id][] = $attributesValuesList[$attributeOption->attribute_value_id] ?? '';
              @endphp
          @endforeach
      @endforeach

      {{-- Display all attributes except "Color" first --}}
      @foreach ($groupedAttributes as $attribute_id => $attributeValues)
          @if($attributesList[$attribute_id]->attr_name != 'Color' && $attributesList[$attribute_id]->attr_name == 'Size')
              <div class="d-flex">
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
            <h5>Color:</h5>
            <div class="color-box">
                <ul class="color-variant">
                    @foreach ($colorValues as $color)
                        <li style="background: {{ is_object($color) ? ($color->option ?: $color->attr_value) : $color }};" title="{{ is_object($color) ? $color->attr_value : $color }}" data-color="{{ $color->attr_value }}" class="{{ $color->attr_value == $selectedColor ? 'active' : '' }}" >
                        </li>
                    @endforeach
                </ul>
                @if ($colorError)
                  <div class="text-danger">{{ $colorError }}</div>
              @endif
            </div>
        </div>
      @endif

    @endif


<div class="quantity-box d-flex align-items-center gap-3">
  <div class="quantity" id="quantity">
      <button type="button" class="minus">
          <i class="fa-solid fa-minus"></i>
      </button>
      <input type="number" class="quntity-filed" wire:model="quantity" min="1" data-quantity="{{$product->quantity}}" />
      <button  type="button" class="plus">
          <i class="fa-solid fa-plus"></i>
      </button>
  </div>
  
  <div class="d-flex align-items-center gap-3 w-100">
    @if( $product->quantity > 0 )
      <button wire:click="addToCart" class="btn btn_black sm addcart" style="width: 200px;">
        <span wire:loading.remove wire:target="addToCart">Add to cart</span>
        <span wire:loading wire:target="addToCart">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </span>
      </button>
    @else
      <button class="btn btn_black sm addcart" style="width: 200px;" disabled>
          Out of stock
      </button>
    @endif
  </div>
</div>


@section('addcart-js')
  <script>
    // quantity js 
    document.addEventListener("DOMContentLoaded", () => {
        const plusMinus = document.querySelectorAll('#quantity');
        
        plusMinus.forEach((element) => {
            const addButton = element.querySelector('.plus');
            const subButton = element.querySelector('.minus');
            const inputEl = element.querySelector(".quntity-filed");

            // Check if inputEl exists and has a quantity dataset
            if (inputEl && inputEl.dataset.quantity) {
                const maxQuantity = parseInt(inputEl.dataset.quantity);

                addButton?.addEventListener('click', function () {
                    let currentValue = Number(inputEl.value);
                    if (currentValue < maxQuantity) {
                        inputEl.value = currentValue + 1;
                        Livewire.emit('updateQuantity', inputEl.value);
                    }

                    addButton.disabled = (inputEl.value >= maxQuantity);
                    subButton.disabled = false;
                });

                subButton?.addEventListener('click', function () {
                    let currentValue = Number(inputEl.value);
                    if (currentValue > 1) {
                        inputEl.value = currentValue - 1;
                        Livewire.emit('updateQuantity', inputEl.value);
                    }

                    subButton.disabled = (inputEl.value <= 1);
                });

                // Initial button state on page load
                addButton.disabled = (inputEl.value >= maxQuantity);
            }
        });
    });

  </script>

  {{-- product qty and variaiton js --}}
  <script>
      
    document.addEventListener('DOMContentLoaded', function () {
      var sizeItems = document.querySelectorAll('.option-box ul li');
      sizeItems.forEach(function (item) {
          item.addEventListener('click', function () {
              sizeItems.forEach(function (sizeItem) {
                  sizeItem.classList.remove('active');
              });
              this.classList.add('active');
              var selectedSize = this.getAttribute('data-size');
              Livewire.emit('selectSize', selectedSize);
          });
      });

      var colorItems = document.querySelectorAll('.color-variant li');
      colorItems.forEach(function (item) {
          item.addEventListener('click', function () {
              colorItems.forEach(function (colorItem) {
                  colorItem.classList.remove('active');
              });
              this.classList.add('active');
              var selectedColor = this.getAttribute('data-color');
              Livewire.emit('selectColor', selectedColor);
          });
      });
    });

</script>
 
@endsection
</div>
