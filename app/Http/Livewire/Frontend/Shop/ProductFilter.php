<?php

namespace App\Http\Livewire\Frontend\Shop;

use Livewire\Component;
use App\Models\Category;

class ProductFilter extends Component
{
    public $selectedCategories = [];

    // Sync selectedCategories and collectionFilters with query string
    protected $queryString = [
        'selectedCategories' => ['as' => 'categories', 'except' => []],
    ];

    protected $listeners = [
        'categoryTagRemoved' => 'removeFromSelectedCategories'
    ];

    public function updatedSelectedCategories()
    {
        $this->emit('filterUpdated', $this->selectedCategories);
    }

    public function removeFromSelectedCategories($categoryId)
    {
        $this->selectedCategories = array_values(
            array_diff($this->selectedCategories, [$categoryId])
        );
    }

    public function render()
    {
        $categories = Category::where('status', 1)
            ->with(['subcategories' => function ($query) {
                $query->orderBy('name', 'asc')
                    ->where('status', 1)
                    ->withCount('products');
            }, 'product'])
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.frontend.shop.product-filter', compact('categories'));
    }
}
