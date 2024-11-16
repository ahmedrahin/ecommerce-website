<div class="custom-accordion theme-scrollbar left-box">
    <div class="left-accordion"> 
      <h5>Back </h5><i class="back-button fa-solid fa-xmark"></i>
    </div>
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="search-box">
        <input type="search" name="text" placeholder="Search here..."><i class="iconsax" data-icon="search-normal-2"></i>
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
                  <label for="cat-{{ $category->id }}">{{ $category->name }} <span>({{$category->product->count()}})</span></label>
                </li>

                    {{-- Display Subcategories --}}
                    @if($category->subcategories->isNotEmpty())
                        <ul class="subcategory-list">
                            @foreach($category->subcategories as $subcategory)
                                <li>
                                    <input class="custom-checkbox" id="subcat-{{$subcategory->id}}" value="{{$subcategory->id}}" type="checkbox" wire:model="selectedCategories">
                                    <label for="subcat-{{$subcategory->id}}">{{$subcategory->name}} <span>({{$subcategory->products_count}})</span></label>
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