@extends('frontend.layout.app')
    
@section('page-title')
    Product Collection | {{config('app.name')}}
@endsection

@section('body-content')

  {{-- quick view modal --}}
  <livewire:frontend.cart.quick-view />
  {{-- add wishlist --}}
  <livewire:frontend.wishlist.add-wishlist></livewire>

  <section> 
    <div class="custom-container container">
      <div class="row"> 
        <div class="col-3"> 
          <livewire:frontend.shop.product-filter />
        </div>

        <div class="col-xl-9">
          <div class="sticky">
            <div class="top-filter-menu">
              {{-- for dekstop version --}}
              <div class="accordion-body for-dekstop">
                <livewire:frontend.shop.selected-tags :initial-categories="request()->get('categories', [])" />
              </div>
                {{-- sort product here --}}
                <livewire:frontend.shop.sorting></livewire>

                {{-- for mobile version --}}
                <div class="accordion-body for-mobile">
                  <livewire:frontend.shop.selected-tags :initial-categories="request()->get('categories', [])" />
                </div>
            </div>
            
              {{-- all products list here --}}
              <livewire:frontend.shop.shop-product></livewire>
  
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section> 

@endsection
  
@section('page-script')
  <script>
    
      document.addEventListener('livewire:load', function () {
          // Listen for a custom event to remove the category tag
          Livewire.on('categoryTagRemoved', (categoryId) => {
              // Uncheck the corresponding checkbox when the tag is removed
              const categoryCheckbox = document.getElementById('cat-' + categoryId);
              if (categoryCheckbox) {
                  categoryCheckbox.checked = false;
              }

              // For subcategories, uncheck the corresponding checkbox
              const subcategoryCheckbox = document.getElementById('subcat-' + categoryId);
              if (subcategoryCheckbox) {
                  subcategoryCheckbox.checked = false;
              }
          });

      });

      document.addEventListener('DOMContentLoaded', function() {
          const filterButton = document.querySelector('.filter-button');
          const backButton = document.querySelector('.back-button');
          const leftBox = document.querySelector('.left-box');
          const bgOverlay = document.querySelector('.bg-overlay');

          filterButton.addEventListener('click', function() {
              leftBox.classList.toggle('open');
              bgOverlay.classList.toggle('open', leftBox.classList.contains('open'));
          });

          backButton.addEventListener('click', function() {
              leftBox.classList.remove('open');
              bgOverlay.classList.remove('open');
          });
      });
  </script>

@endsection

    