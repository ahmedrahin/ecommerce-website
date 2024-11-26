<?php

namespace App\Http\Livewire\Frontend\Home;

use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SpecialProduct extends Component
{   
    public $wishlist = [];
    public $take = 10;

    protected $listeners = [
        'wishlistUpdated' => 'loadWishlist'
    ];

    public function mount(){
        $this->loadWishlist();
    }

    public function loadWishlist()
    {
        if (Auth::check()) {
            $this->wishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        } else {
            $sessionId = session()->getId();
            $this->wishlist = Wishlist::where('session_id', $sessionId)->pluck('product_id')->toArray();
        }
    }

    public function render()
    {
        $offerProduct = Product::whereIn('status', [1, 3])
                        ->where(function ($query) {
                            $query->whereNull('publish_at')
                                ->orWhere('publish_at', '<=', Carbon::now());
                        })
                        ->where(function ($query) {
                            $query->whereNull('expire_date')
                                ->orWhere('expire_date', '>', Carbon::now());
                        })
                        ->orderBy('id', 'desc')
                        ->where('discount_option', '!=', 1)
                        ->take($this->take)
                        ->get();
        
        $discountedProducts = Product::whereIn('status', [1, 3])
                        ->where(function ($query) {
                            $query->whereNull('publish_at')
                                ->orWhere('publish_at', '<=', Carbon::now());
                        })
                        ->where(function ($query) {
                            $query->whereNull('expire_date')
                                ->orWhere('expire_date', '>', Carbon::now());
                        })
                        ->where(function ($query) {
                            $query->where(function ($q) {
                                // Products with percentage discounts >= 30%
                                $q->where('discount_option', 2)
                                    ->where('discount_percentage_or_flat_amount', '>=', 30);
                            })
                            ->orWhere(function ($q) {
                                // Products with flat discounts that result in >= 30% discount
                                $q->where('discount_option', 3)
                                    ->whereRaw('(discount_percentage_or_flat_amount / base_price) * 100 >= 30');
                            });
                        })
                        ->orderBy('offer_price', 'asc') 
                        ->take($this->take) 
                        ->get();
            
            $freeShipping = Product::whereIn('status', [1, 3])
                            ->where(function ($query) {
                                $query->whereNull('publish_at')
                                    ->orWhere('publish_at', '<=', Carbon::now());
                            })
                            ->where(function ($query) {
                                $query->whereNull('expire_date')
                                    ->orWhere('expire_date', '>', Carbon::now());
                            })
                            ->orderBy('id', 'desc')
                            ->where('free_shipping', '==', 'yes')
                            ->take($this->take)
                            ->get();

        return view('livewire.frontend.home.special-product', compact('offerProduct', 'discountedProducts', 'freeShipping'));
    }
}
