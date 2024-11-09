<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;

class ShopProduct extends Component
{
    public $products;

    public function mount(){
        $query =  Product::whereIn('status', [1, 3])
        ->where(function ($query) {
            $query->whereNull('publish_at')
                ->orWhere('publish_at', '<=', Carbon::now());
        })
        ->where(function ($query) {
            $query->whereNull('expire_date')
                ->orWhere('expire_date', '>', Carbon::now());
        });

        $this->products = $query->latest()->get();
    }

    public function render()
    {
        return view('livewire.frontend.product.shop-product');
    }
}
