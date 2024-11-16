<?php

namespace App\Http\Livewire\Frontend\Shop;

use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\WithPagination;

class ShopProduct extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; 

    public $selectedCategories = [];
    public $selectedCategoryNames = [];

    protected $queryString = [
        'selectedCategories' => ['as' => 'categories', 'except' => []],
    ];

    protected $listeners = [
        'filterUpdated' => 'updateFilter',
    ];

    public function updateFilter($categories)
    {
        $this->selectedCategories = array_values($categories);
        $this->resetPage(); 
    }

    public function render()
    {
        $products = Product::whereIn('status', [1, 3])
            ->where(function ($query) {
                $query->whereNull('publish_at')
                    ->orWhere('publish_at', '<=', Carbon::now());
            })
            ->where(function ($query) {
                $query->whereNull('expire_date')
                    ->orWhere('expire_date', '>', Carbon::now());
            })
            ->when(!empty($this->selectedCategories), function ($query) {
                $query->where(function ($q) {
                    $q->whereIn('category_id', $this->selectedCategories)
                      ->orWhereIn('subcategory_id', $this->selectedCategories);
                });
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20); 

        return view('livewire.frontend.shop.shop-product', compact('products'));
    }
}
