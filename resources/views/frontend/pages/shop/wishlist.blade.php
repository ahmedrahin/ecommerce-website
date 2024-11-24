@extends('frontend.layout.app')
    
@section('page-title')
    Wishlist | {{config('app.name')}}
@endsection

@section('body-content')
  {{-- quick view modal --}}
  <livewire:frontend.cart.quick-view />

  <section class="mb-4" style="margin-bottom: 20px;"> 
    <div class="heading-banner">
      <div class="custom-container container">
        <div class="row align-items-center">
            <h6 class="text-center mb-0 fw-bold">
                My Wishlist
            </h6>
        </div>
      </div>
    </div>
  </section>

  <section > 
    <div class="custom-container container wishlist-box"> 
      <div class="product-tab-content ratio1_3">
        
        <livewire:frontend.wishlist.wishlist-list />

      </div>
    </div>
  </section>

@endsection
  
@section('page-script')
  
@endsection

    