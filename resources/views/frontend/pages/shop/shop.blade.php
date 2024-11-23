@extends('frontend.layout.app')
    
@section('page-title')
    Product Collection | {{config('app.name')}}
@endsection

@section('body-content')

 
  <section> 
    <div class="custom-container container">
      <div class="row"> 
        <div class="col-3"> 
          <livewire:frontend.shop.product-filter />
        </div>

        <div class="col-xl-9">
          <div class="sticky">
            <div class="top-filter-menu">
              <div class="accordion-body">
                <livewire:frontend.shop.selected-tags :initial-categories="request()->get('categories', [])" />
              </div>
                {{-- sort product here --}}
                <livewire:frontend.shop.sorting></livewire>
              
            </div>
            
                {{-- all products list here --}}
                <livewire:frontend.shop.shop-product></livewire>
  
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section> 
  
  {{-- quick view modal --}}
  <livewire:frontend.cart.quick-view />

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
  </script>

@endsection

    