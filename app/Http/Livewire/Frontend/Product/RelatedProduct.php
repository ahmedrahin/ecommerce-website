<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;

class RelatedProduct extends Component
{
    public $productId;

    public function mount($id){
        $this->productId = $id;
    }

    public function render()
    {   
        $product = Product::find($this->productId);
        $products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->whereIn('status', [1, 3]) 
            ->where(function ($query) {
                $query->whereNull('publish_at') 
                    ->orWhere('publish_at', '<=', Carbon::now());
            })
            ->where(function ($query) {
                $query->whereNull('expire_date') 
                    ->orWhere('expire_date', '>', Carbon::now());
            })
            ->get();

        return view('livewire.frontend.product.related-product', compact('products'));
    }
}
