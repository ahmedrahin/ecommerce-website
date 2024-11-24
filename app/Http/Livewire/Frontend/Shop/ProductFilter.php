<?php

namespace App\Http\Livewire\Frontend\Shop;

use Livewire\Component;
use App\Models\Category;

class ProductFilter extends Component
{
    public $selectedCategories = [];
    public $selectedCollections = [];
    public $searchQuery = '';

    protected $queryString = [
        'selectedCategories' => ['as' => 'categories', 'except' => []],
        'selectedCollections' => ['as' => 'collections', 'except' => []],
        'searchQuery' => ['as' => 'query', 'except' => ''],
    ];

    protected $listeners = [
        'categoryTagRemoved' => 'removeFromSelectedCategories',
        'collectionTagRemoved' => 'removeFromSelectedCollections',
    ];

    public function updatedSelectedCategories()
    {
        $this->emit('filterUpdated', $this->selectedCategories);
    }

    public function updatedSearchQuery()
    {
        $this->emit('searchUpdated', $this->searchQuery); 
    }

    public function updatedSelectedCollections()
    {
        $this->emit('collectionFilterUpdated', $this->selectedCollections);
    }

    public function removeFromSelectedCategories($categoryId)
    {
        $this->selectedCategories = array_values(
            array_diff($this->selectedCategories, [$categoryId])
        );
    }

    public function removeFromSelectedCollections($collectionId)
    {
        $this->selectedCollections = array_values(
            array_diff($this->selectedCollections, [$collectionId])
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
