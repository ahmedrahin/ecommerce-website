<?php

namespace App\Http\Livewire\Frontend\Shop;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;

class SelectedTags extends Component
{
    public $selectedCategoryIds = [];
    public $selectedCategoryNames = [];

    protected $listeners = ['filterUpdated' => 'updateTags'];

    public function mount($initialCategories = [])
    {
        $this->selectedCategoryIds = $initialCategories;
        $this->updateTags($this->selectedCategoryIds);
    }

    public function updateTags($categories)
    {
        $this->selectedCategoryIds = $categories;
        
        $this->selectedCategoryNames = Category::whereIn('id', $this->selectedCategoryIds)
            ->orWhereHas('subcategories', function ($query) {
                $query->whereIn('id', $this->selectedCategoryIds);
            })
            ->get()
            ->flatMap(function ($category) {
                $names = [];
                
                // For selected categories, add category name as a separate tag
                if (in_array($category->id, $this->selectedCategoryIds)) {
                    $names[] = $category->name; // Add category tag
                }

                // For selected subcategories, add the full path tag (category > subcategory)
                foreach ($category->subcategories as $subcategory) {
                    if (in_array($subcategory->id, $this->selectedCategoryIds)) {
                        $names[] = $category->name . ' > ' . $subcategory->name; // Add parent > subcategory tag
                    }
                }

                return $names;
            })
            ->toArray();
    }

    public function updatedSelectedCategories()
    {
        $this->emit('filterUpdated', $this->selectedCategories);
    }

    public function removeCategory($name)
    {
        $categoryOrSubcategory = explode(' > ', $name);
    
        if (count($categoryOrSubcategory) === 2) {
            // Subcategory removal
            $subcategory = Subcategory::where('name', $categoryOrSubcategory[1])->first();
            if ($subcategory) {
                $this->selectedCategoryIds = array_diff($this->selectedCategoryIds, [$subcategory->id]);
                $this->emit('categoryTagRemoved', $subcategory->id); 
            }
        } else {
            // Category removal
            $category = Category::where('name', $name)->first();
            if ($category) {
                $this->selectedCategoryIds = array_diff($this->selectedCategoryIds, [$category->id]);
                $this->emit('categoryTagRemoved', $category->id); 
            }
        }
    
        // Emit the full updated array
        $this->emit('filterUpdated', $this->selectedCategoryIds);
    
        // Update the tag display
        $this->updateTags($this->selectedCategoryIds);
    }
    

    public function render()
    {
        return view('livewire.frontend.shop.selected-tags');
    }
}
