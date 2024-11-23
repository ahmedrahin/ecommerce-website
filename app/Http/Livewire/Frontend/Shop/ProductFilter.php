<?php

namespace App\Http\Livewire\Frontend\Shop;

use Livewire\Component;
use App\Models\Category;

class ProductFilter extends Component
{
    public $selectedCategories = [];
    public $searchQuery = '';

    protected $queryString = [
        'selectedCategories' => ['as' => 'categories', 'except' => []],
        'searchQuery' => ['as' => 'query', 'except' => ''],
    ];

    protected $listeners = [
        'categoryTagRemoved' => 'removeFromSelectedCategories'
    ];

    public function updatedSelectedCategories()
    {
        $this->emit('filterUpdated', $this->selectedCategories);
    }

    public function updatedSearchQuery()
    {
        $this->emit('searchUpdated', $this->searchQuery); 
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
                $query->orderBy('id', 'asc')
                    ->where('status', 1)
                    ->withCount('products');
            }, 'product'])
            ->orderBy('id', 'asc')
            ->get();

        return view('livewire.frontend.shop.product-filter', compact('categories'));
    }
}
