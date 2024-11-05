<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Category;

class SelectProduct extends Component
{
    public $products;
    public $selectedProducts = [];
    public $quantities = [];
    public $totalQuantity = 0;
    public $totalCost = 0;
    public $currentUrl;
    public $search;
    public $categories;
    public $selectedCategory = null;

    public function mount()
    {
        $this->loadProducts();
        $this->categories = Category::orderBy('name', 'asc')->where('status', 1)->get();
        $this->selectedProducts = session()->get('selectedProducts', []);
        $this->quantities = session()->get('quantities', []);
    
        $this->totalQuantity = session()->get('totalQuantity', 0);
        $this->totalCost = session()->get('totalCost', 0);
    
        foreach ($this->products as $product) {
            if (!isset($this->quantities[$product->id])) {
                $this->quantities[$product->id] = 1;
            }
        }
    
        $this->currentUrl = url()->current();
        session()->put('lastVisitedUrl', $this->currentUrl);

        $this->listeners = [
            'clearSessionDataOnLeave' => 'clearSessionDataOnLeave'
        ];
    }
    
    public function loadProducts()
    {
        $query = Product::whereIn('status', [1, 3])
            ->where(function ($query) {
                $query->whereNull('publish_at')
                    ->orWhere('publish_at', '<=', Carbon::now());
            })
            ->where(function ($query) {
                $query->whereNull('expire_date')
                    ->orWhere('expire_date', '>', Carbon::now());
            });

        // Apply category filter if a specific category is selected
        if ($this->selectedCategory && $this->selectedCategory !== 'all') {
            $query->where('category_id', $this->selectedCategory);
        }

        // Apply search filter only within the selected category
        if (!empty($this->search)) {
            $query->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('sku_code', 'like', '%' . $this->search . '%');
            });
        }

        // Retrieve the products based on both filters
        $this->products = $query->latest()->get();
    }
    
    // Called whenever the search input changes
    public function updatedSearch()
    {
        $this->loadProducts();
    }

    public function updatedSelectedCategory()
    {
        $this->loadProducts();
    }

    public function updatedSelectedProducts()
    {
        $selectedProductIds = array_flip($this->selectedProducts);

        // Remove quantities for unchecked products
        foreach (session()->get('selectedProducts', []) as $productId) {
            if (!isset($selectedProductIds[$productId])) {
                unset($this->quantities[$productId]);
                session()->forget("quantities.$productId");
            }
        }

        // Add default quantity for newly selected products
        foreach ($this->selectedProducts as $productId) {
            if (!isset($this->quantities[$productId])) {
                $this->quantities[$productId] = 1;
            }
        }

        $this->updateSession();
    }

    public function updatedQuantities($value, $productId)
    {
        if (in_array($productId, $this->selectedProducts)) {
            // Update the session and Livewire state
            $this->updateSession();
            $this->emit('success', 'Quantity has been updated.');
        } else {
            $this->quantities[$productId] = 1;
            $this->emit('warning', 'Please select the product first.');
        }
    }

    public function updateSession()
    {
        $productData = [];
        $this->totalQuantity = 0;
        $this->totalCost = 0;

        foreach ($this->selectedProducts as $productId) {
            $quantity = $this->quantities[$productId] ?? 1;
            $productData[$productId] = $quantity;

            $product = Product::find($productId);
            if ($product) {
                $this->totalQuantity += $quantity;

                $price = ($product->discount_option != 1) ? $product->offer_price : $product->base_price;
                $this->totalCost += $price * $quantity;
            }
        }

        // Store selected products, quantities, and totals in the session
        session()->put('selectedProducts', $this->selectedProducts);
        session()->put('quantities', $this->quantities);
        session()->put('totalQuantity', $this->totalQuantity);
        session()->put('totalCost', $this->totalCost);
    }

    public function removeProduct($productId)
    {
        // Remove the product from selectedProducts
        $this->selectedProducts = array_filter($this->selectedProducts, function ($id) use ($productId) {
            return $id != $productId;
        });

        // Remove the product quantity from the quantities array
        unset($this->quantities[$productId]);

        // Update the session data
        session()->put('selectedProducts', $this->selectedProducts);
        session()->put('quantities', $this->quantities);

        // Recalculate the total quantity and cost
        $this->updateSession();
        $this->emit('info', 'The product remove from cart.');
    }


    public function clearSessionData()
    {
        // Clear session data when navigating to a different page
        session()->forget('selectedProducts');
        session()->forget('quantities');
        session()->forget('totalQuantity');
        session()->forget('totalCost');
    }

    public function clearSessionDataOnLeave()
    {
        $this->clearSessionData();
    }

    public function render()
    {
        return view('livewire.order.select-product');
    }
}
