<div>
    <a class="filter-button btn"> 
      <h6> <i class="iconsax" data-icon="filter"></i>Filter Menu </h6></a>
    <div class="category-dropdown">
      <label for="cars">Sort By :</label>
      <select wire:model="sortOrder" id="sortOrder" class="form-select">
        <option value="">All Products</option>
        <option value="price_desc" {{ $sortOrder == 'price_desc' ? 'selected' : '' }} >High - Low Price</option>
        <option value="price_asc" {{ $sortOrder == 'price_asc' ? 'selected' : '' }}>Low - High Price</option>
        <option value="offer" {{ $sortOrder == 'offer' ? 'selected' : '' }}>Offer Product</option>
    </select>
    </div>
  </div>