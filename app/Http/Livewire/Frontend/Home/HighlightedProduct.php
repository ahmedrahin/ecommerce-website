<?php

namespace App\Http\Livewire\Frontend\Home;

use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;

class HighlightedProduct extends Component
{
    public $take = 10;

    public function render()
    {
        $newArrivales = Product::whereIn('status', [1, 3])
        ->where(function ($query) {
            $query->whereNull('publish_at')
                ->orWhere('publish_at', '<=', Carbon::now());
        })
        ->where(function ($query) {
            $query->whereNull('expire_date')
                ->orWhere('expire_date', '>', Carbon::now());
        })
        ->orderBy('id', 'desc')
        ->where('is_new', 1)
        ->take($this->take)
        ->get();
    
    $featured = Product::whereIn('status', [1, 3])
        ->where(function ($query) {
            $query->whereNull('publish_at')
                ->orWhere('publish_at', '<=', Carbon::now());
        })
        ->where(function ($query) {
            $query->whereNull('expire_date')
                ->orWhere('expire_date', '>', Carbon::now());
        })
        ->orderBy('id', 'desc')
        ->where('is_featured', 1)
        ->take($this->take)
        ->get();
    
    $selling = Product::whereIn('status', [1, 3])
        ->where(function ($query) {
            $query->whereNull('publish_at')
                ->orWhere('publish_at', '<=', Carbon::now());
        })
        ->where(function ($query) {
            $query->whereNull('expire_date')
                ->orWhere('expire_date', '>', Carbon::now());
        })
        ->withCount('orderItems')
        ->orderBy('order_items_count', 'desc')
        ->take($this->take)
        ->get();
    
    $productsWithHighReviews = Product::whereIn('status', [1, 3])
        ->where(function ($query) {
            $query->whereNull('publish_at')
                ->orWhere('publish_at', '<=', Carbon::now());
        })
        ->where(function ($query) {
            $query->whereNull('expire_date')
                ->orWhere('expire_date', '>', Carbon::now());
        })
        ->with('review')
        ->withAvg('review', 'rating')
        ->having('review_avg_rating', '>=', 4)
        ->orderBy('review_avg_rating', 'desc')
        ->take(10)
        ->get();
    

    
        return view('livewire.frontend.home.highlighted-product', compact('newArrivales', 'featured', 'selling', 'productsWithHighReviews'));
    }
}
