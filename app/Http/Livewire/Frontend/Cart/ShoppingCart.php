<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\Product;

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
        // Get the cart from session
        $this->cart = session()->get('cart', []);
        
        // Initialize the quantities array with values from the cart
        foreach ($this->cart as $productId => $item) {
            // Retrieve product details from the database
            $product = Product::find($productId);

            $this->cart[$productId]['name'] = $product->name;
            $this->cart[$productId]['slug'] = $product->slug;
            $this->cart[$productId]['offer_price'] = $product->offer_price;
            $this->cart[$productId]['price'] = $product->base_price;
            $this->cart[$productId]['image_url'] = $product->thumb_image;
            $this->cart[$productId]['available_quantity'] = $product->quantity;
            $this->cart[$productId]['discount_option'] = $product->discount_option;
            $this->quantities[$productId] = $item['quantity'] ?? 1;
        }
        
    }


    public function updateQuantities($productId = null, $quantity = null)
    {
        if (!$productId || !$quantity) {
            $this->emit('error', 'Invalid product or quantity');
            return;
        }

        // Find the product by ID
        $product = Product::find($productId);
    

        // Basic validation of quantity
        if ($quantity == 0 || empty($quantity)) {
            $this->emit('error', 'Please select a quantity');
            return;
        } elseif (!is_numeric($quantity) || $quantity <= 0) {
            $this->emit('error', 'Invalid product quantity. Please enter a valid positive quantity.');
            return;
        } elseif ($quantity > $product->quantity) {
            $this->emit('error', "We don't have enough stock for " . $product->name);
            return;
        }

        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = (int)$quantity;
                session()->put('cart', $cart);

                $this->emit('success', 'Product quantity updated.');
            } 
         else {
            $this->emit('error', 'Product not found in the cart.');
        }

        $this->loadCart();
        $this->emit('cartUpdated');
    }

    public function incrementQuantity($productId)
    {
        $currentQuantity = $this->quantities[$productId] ?? 1;
        $product = Product::find($productId);

        if ($product && $currentQuantity < $product->quantity) {
            $this->quantities[$productId] = $currentQuantity + 1;
            $this->updateQuantities($productId, $this->quantities[$productId]);
        } else {
            $this->emit('error', 'Maximum stock limit reached');
        }
    }

    public function decrementQuantity($productId)
    {
        $currentQuantity = $this->quantities[$productId] ?? 1;

        if ($currentQuantity > 1) {
            $this->quantities[$productId] = $currentQuantity - 1;
            $this->updateQuantities($productId, $this->quantities[$productId]);
        } 
    }

    public function removeItem($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
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
