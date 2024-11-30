<div class="custom-accordion theme-scrollbar left-box">
    <div class="left-accordion"> 
      <h5>Back </h5><i class="back-button fa-solid fa-xmark"></i>
    </div>
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="search-box">
        <input 
            type="search" 
            class="form-control" 
            placeholder="Search a product..." 
            wire:model.debounce.500ms="searchQuery"
        >
        @if( !$searchQuery )
          <i class="iconsax" data-icon="search-normal-2"></i>
        @endif
      </div>
      
      <div class="accordion-item">
          <h2 class="accordion-header">
              <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseEight">
                  <span>Collections</span>
              </button>
          </h2>
          <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseEight">
              <div class="accordion-body">
                <ul class="collection-list">
                    <li>
                        <input type="checkbox" wire:model="selectedCollections" value="top_selling" id="collection-top-selling" class="custom-checkbox">
                        <label for="collection-top-selling">Top Selling</label>
                    </li>
                    <li>
                        <input type="checkbox" wire:model="selectedCollections" value="new_arrivals" id="collection-new-arrivals" class="custom-checkbox">
                        <label for="collection-new-arrivals">New Arrivals</label>
                    </li>
                </ul>
              </div>
          </div>
      </div>
    
      
      <div class="accordion-item"> 
        <h2 class="accordion-header">
          <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"><span>Categories</span></button>
        </h2>
        <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseTwo">
          <div class="accordion-body">
            <ul class="catagories-side theme-scrollbar">

               @foreach( $categories as $category ) 
                <li> 
                  <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" id="cat-{{ $category->id }}" class="custom-checkbox">
                  <label for="cat-{{ $category->id }}">{{ $category->name }}
                    @if( config('website_settings.product_count_enabled') == true )
                      <span>({{ $category->product->count() }})</span>
                    @endif
                  </label>
                </li>

                    {{-- Display Subcategories --}}
                    @if($category->subcategories->isNotEmpty())
                        <ul class="subcategory-list">
                            @foreach($category->subcategories as $subcategory)
                                <li>
                                    <input class="custom-checkbox" id="subcat-{{$subcategory->id}}" value="{{$subcategory->id}}" type="checkbox" wire:model="selectedCategories">
                                    <label for="subcat-{{$subcategory->id}}">{{$subcategory->name}}
                                      @if( config('website_settings.product_count_enabled') == true )
                                        <span>({{$subcategory->products_count}})</span>
                                      @endif
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    @endif
              @endforeach
              
            </ul>
          </div>
        </div>
      </div>

     
    </div>
  </div>