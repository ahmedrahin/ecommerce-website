<?php

namespace App\Http\Livewire\Frontend\Shop;

use Livewire\Component;

class Sorting extends Component
{
    public $sortOrder = '';

    public function updatedSortOrder($value)
    {
        $this->emit('sortOrderUpdated', $value);
    }

    
    public function render()
    {
        return view('livewire.frontend.shop.sorting');
    }
}
