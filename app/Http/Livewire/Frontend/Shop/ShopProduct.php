<?php

namespace App\Http\Livewire\Frontend\Shop;

use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ShopProduct extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; 
    public $wishlist = [];

    public $selectedCategories = [];
    public $selectedCategoryNames = [];
    public $selectedCollections = [];
    public $searchQuery = '';
    public $sortOrder = '';

    protected $queryString = [
        'selectedCategories' => ['as' => 'categories', 'except' => []],
        'selectedCollections' => ['as' => 'collections', 'except' => []],
        'searchQuery' => ['as' => 'query', 'except' => ''],
        'sortOrder' => ['as' => 'sort', 'except' => ''],
    ];

    protected $listeners = [
        'filterUpdated' => 'updateFilter',
        'searchUpdated' => 'updateSearchQuery',
        'sortOrderUpdated' => 'updateSortOrder',
        'collectionFilterUpdated' => 'updateCollections',
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


    public function updateFilter($categories)
    {
        $this->selectedCategories = array_values($categories);
        $this->resetPage(); 
    }

    public function updateCollections($collections)
    {
        $this->selectedCollections = array_values($collections);
        $this->resetPage();
    }

    public function updateSearchQuery($query)
    {
        $this->searchQuery = $query;
        $this->resetPage();
    }

    public function updateSortOrder($order)
    {
        $this->sortOrder = $order;
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::whereIn('status', [1, 3])
            ->where(function ($query) {
                $query->whereNull('publish_at')
                    ->orWhere('publish_at', '<=', Carbon::now());
            })
            ->where(function ($query) {
                $query->whereNull('expire_date')
                    ->orWhere('expire_date', '>', Carbon::now());
            })
            ->when(!empty($this->selectedCategories), function ($query) {
                $query->where(function ($q) {
                    $q->whereIn('category_id', $this->selectedCategories)
                    ->orWhereIn('subcategory_id', $this->selectedCategories);
                });
            })
            ->when(!empty($this->selectedCollections), function ($query) {
                $query->where(function ($q) {
                    if (in_array('new_arrivals', $this->selectedCollections)) {
                        $q->orWhere(function ($query) {
                            $query->where('created_at', '>=', now()->subDays(10))
                                  ->orWhere('is_new', 1);
                        });
                    }
                });
            
                if (in_array('top_selling', $this->selectedCollections)) {
                    $query->withCount('orderItems') 
                          ->orderBy('order_items_count', 'desc');
                }
            })
            ->when($this->searchQuery, function ($query) {
                $query->where('name', 'like', '%' . $this->searchQuery . '%') 
                    ->orWhereHas('tags', function ($q) { 
                        $q->where('name', 'like', '%' . $this->searchQuery . '%');
                    });
            })
            ->when($this->sortOrder, function ($query) {
                if ($this->sortOrder === 'price_desc') {
                    $query->orderBy('offer_price', 'desc');
                } elseif ($this->sortOrder === 'price_asc') {
                    $query->orderBy('offer_price', 'asc');
                }elseif($this->sortOrder == 'offer'){
                    $query->where('discount_option', '!=', 1);
                }
            })
            ->orderBy('is_featured', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10); 

        return view('livewire.frontend.shop.shop-product', compact('products'));
    }

}
