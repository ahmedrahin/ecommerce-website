<div>
  {{-- Cart Sidebar Button --}}
  <div class="cart-btn">
    <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <i class="bi bi-cart-check-fill"></i>
    </button>
    <div class="cart-count">
        {{ $cartCount }}
    </div>
  </div>

  <div class="shoping-prize"><i class="iconsax pe-2" data-icon="basket-2"> </i>{{ $cartCount }} items</div>
</div>
