<div>
    <a class="filter-button btn"> 
      <h6> <i class="iconsax" data-icon="filter"></i>Filter Menu </h6>
    </a>
    <div class="category-dropdown">
      <label for="cars">Sort By :</label>
      <select wire:model="sortOrder" id="sortOrder" class="form-select" style="width: 200px;">
        <option value="">All Products</option>
        <option value="price_desc"  >High - Low Price</option>
        <option value="price_asc">Low - High Price</option>
        <option value="offer">Offer Product</option>
    </select>
    </div>
  </div>