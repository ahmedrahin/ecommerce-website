<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class AddCart extends Component
{
    public $productId;
    public $quantity = 1;

    public function mount($productId){
        $this->productId = $productId;
    }

    protected $listeners = ['updateQuantity'];

    public function updateQuantity($quantity)
    {   
       
        $this->quantity = $quantity;
        // dd($this->quantity);
    }


    public function addToCart()
    {
        $product = Product::find($this->productId);

        if ($product) {
            $cart = session()->get('cart', []);

            // Calculate the total quantity that would result from this addition
            $existingQuantity = isset($cart[$this->productId]) ? $cart[$this->productId]['quantity'] : 0;
            $newTotalQuantity = $existingQuantity + $this->quantity;

            // Validate quantity input
            if ($this->quantity == 0 || empty($this->quantity)) {
                $this->emit('error', 'Please select a quantity');
                return;
            } elseif (!is_numeric($this->quantity) || $this->quantity <= 0) {
                $this->emit('error', 'Invalid product quantity, Please enter a valid positive quantity');
                return;
            } elseif ($newTotalQuantity > $product->quantity) {
                $this->emit('error', "You have exceeded the available stock for {$product->name}. Only {$product->quantity} items are available.");
                return;
            }

            // Add or update the product in the cart
            if (isset($cart[$this->productId])) {
                $cart[$this->productId]['quantity'] = $newTotalQuantity;
                $this->emit('success', 'The product quantity updated.');
            } else {
                $cart[$this->productId] = [
                    'quantity' => $this->quantity,
                ];
                $this->emit('success', 'The product added to your cart.');
            }

            session()->put('cart', $cart);

            $this->emit('cartUpdated');
        }
    }


    public function render()
    {   
        $product = Product::find($this->productId);
        return view('livewire.frontend.cart.add-cart', compact('product'));
    }
}
