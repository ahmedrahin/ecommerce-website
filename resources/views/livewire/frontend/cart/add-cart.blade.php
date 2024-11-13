<div>
   {{-- product variation --}}
 <div>
  <div class="d-flex">
      <div> 
        <h5>Size:</h5>
        <div class="size-box">
          <ul class="selected">
            <li><a href="#">s</a></li>
            <li><a href="#">m</a></li>
            <li class="active"><a href="#">l</a></li>
            <li><a href="#">xl  </a></li>
          </ul>
        </div>
      </div>
    </div>
    
    <div>
      <h5>Color:</h5>
      <div class="color-box">
        <ul class="color-variant">
          <li class="bg-color-brown"></li>
          <li class="bg-color-chocolate"></li>
          <li class="bg-color-coffee"></li>
          <li class="bg-color-black"></li>
        </ul>
      </div>
    </div>
</div>

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
@endsection
</div>
