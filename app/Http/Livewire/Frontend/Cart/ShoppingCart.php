<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ShoppingCart extends Component
{
    public $cart = [];
    public $quantities = []; // Track each product's quantity

    protected $listeners = [
        'cartUpdated' => 'refreshCart',
        'updateQuantities'
    ];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        // Retrieve the cart from session
        $this->cart = session()->get('cart', []);
        $now = now();
        $cartUpdated = false;
    
        foreach ($this->cart as $cartKey => $item) {
            if (!empty($item['added_at']) && $now->diffInHours(Carbon::parse($item['added_at'])) > config('website_settings.cart_session')) {
                unset($this->cart[$cartKey]);
                $cartUpdated = true;
            }
        }
    
        if ($cartUpdated) {
            // Update the session with the modified cart
            session()->put('cart', $this->cart);
            $this->emit('cartUpdated');
        }
        
        // Create a temporary cart array to store valid items
        $validCart = [];

        foreach ($this->cart as $cartKey => $item) {
            $productId = explode('-', $cartKey)[0];
            $product = Product::find($productId);

            if ($product && ($product->status == 1 || $product->status == 3 )  && $product->quantity > 0) { 
                $validCart[$cartKey] = $item;
                $validCart[$cartKey]['name'] = $product->name;
                $validCart[$cartKey]['slug'] = $product->slug;
                $validCart[$cartKey]['offer_price'] = $product->offer_price;
                $validCart[$cartKey]['price'] = $product->base_price;
                $validCart[$cartKey]['image_url'] = $product->thumb_image;
                $validCart[$cartKey]['available_quantity'] = $product->quantity;
                $validCart[$cartKey]['discount_option'] = $product->discount_option;
                $this->quantities[$cartKey] = $item['quantity'] ?? 1;
            }
        }

        // Update the session with the valid cart
        session()->put('cart', $validCart);
        $this->cart = $validCart;
    }
    
    public function updateQuantities($cartKey, $quantity)
    {
        // Basic validation of quantity
        if (!$cartKey || !$quantity || !is_numeric($quantity) || $quantity <= 0) {
            $this->emit('error', 'Invalid product quantity. Please enter a valid positive quantity.');
            return;
        }
    
        // Check if this item exists in the cart
        $cart = session()->get('cart', []);
        if (isset($cart[$cartKey])) {
            $productId = explode('-', $cartKey)[0];
            $product = Product::find($productId);
    
            // Validate stock availability
            if ($product && $quantity > $product->quantity) {
                $this->emit('error', "We don't have enough stock for {$product->name}");
                return;
            }
    
            // Update quantity and refresh cart
            $cart[$cartKey]['quantity'] = (int) $quantity;
            session()->put('cart', $cart);
            $this->emit('success', 'Product quantity updated.');
            $this->loadCart();
            $this->emit('cartUpdated');
        } else {
            $this->emit('error', 'Product not found in the cart.');
        }
    }
    
    public function incrementQuantity($cartKey)
    {
        $currentQuantity = $this->quantities[$cartKey] ?? 1;
        $productId = explode('-', $cartKey)[0];
        $product = Product::find($productId);
    
        if ($product && $currentQuantity < $product->quantity) {
            $this->quantities[$cartKey] = $currentQuantity + 1;
            $this->updateQuantities($cartKey, $this->quantities[$cartKey]);
        } else {
            $this->emit('error', 'Maximum stock limit reached');
        }
    }
    
    public function decrementQuantity($cartKey)
    {
        $currentQuantity = $this->quantities[$cartKey] ?? 1;
    
        if ($currentQuantity > 1) {
            $this->quantities[$cartKey] = $currentQuantity - 1;
            $this->updateQuantities($cartKey, $this->quantities[$cartKey]);
        }
    }
    
    public function removeItem($cartKey)
    {
        $cart = session()->get('cart', []);
        unset($cart[$cartKey]);
        session()->put('cart', $cart);
        $this->emit('info', 'The product remove from your cart.');
        $this->emit('cartUpdated');
        $this->loadCart();
    }
    
    public function getTotalAmount()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['quantity'] * $item['offer_price'];
        }
        return $total;
    }

    public function refreshCart()
    {
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.frontend.cart.shopping-cart');
    }
}
