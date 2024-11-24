<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlistList extends Component
{
    public $wishlistItems = [];

    public function mount()
    {
        $this->loadWishlist();
    }

    public function loadWishlist()
    {
        if (Auth::check()) {
            $this->wishlistItems = Wishlist::with(['product' => function ($query) {
                $query->whereIn('status', [1, 3])
                    ->where(function ($q) {
                        $q->whereNull('publish_at')
                          ->orWhere('publish_at', '<=', Carbon::now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('expire_date')
                          ->orWhere('expire_date', '>', Carbon::now());
                    });
            }])
            ->where('user_id', Auth::id())
            ->get();
        } else {
            $sessionId = session()->getId();
            $this->wishlistItems = Wishlist::with(['product' => function ($query) {
                $query->whereIn('status', [1, 3])
                    ->where(function ($q) {
                        $q->whereNull('publish_at')
                          ->orWhere('publish_at', '<=', Carbon::now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('expire_date')
                          ->orWhere('expire_date', '>', Carbon::now());
                    });
            }])
            ->where('session_id', $sessionId)
            ->get();
        }
    }    

    public function removeFromWishlist($wishlistId)
    {
        Wishlist::find($wishlistId)->delete();
        $this->loadWishlist(); 
        $this->emit('wishlistUpdated');
        $this->emit('info', 'The item removed from you wishlist.');
    }

    public function render()
    {
        return view('livewire.frontend.wishlist.wishlist-list', [
            'wishlistItems' => $this->wishlistItems,
        ]);
    }
}
