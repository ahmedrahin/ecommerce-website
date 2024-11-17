<?php

namespace App\Http\Livewire\Frontend\Order;

use Livewire\Component;
use App\Models\ShippingMethod;
use App\Models\District;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Auth;
use Carbon\Carbon;

class Checkout extends Component
{   
    public $name;
    public $email;
    public $phone;
    public $shipping_address;
    public $district_id;
    public $note;
    public $selectedShippingMethodId; 
    public $selectedShippingCharge = 0 ;

    public $cart = [];
    public $shippingMethods;
    private $cacheKey;

    protected $listeners = [
        'cartUpdated' => 'refreshCart',
    ];

    public function __construct()
    {
        $this->cacheKey = config('dbcachekey.order');
    }

    public function mount()
    {
        $this->checkCart();
        $this->loadShippingMethods();
    }

    public function updatedDistrictId($value)
    {
        $methods = ShippingMethod::where('status', 1)->where('base_id', $value)->first();
    
        if ($methods) {

            $this->selectedShippingMethodId = $methods->id;
            $this->selectedShippingCharge = $methods->base_charge;
            $this->shippingMethods = collect();
        } else {
            $this->loadShippingMethods();
        }
    }
    
    public function loadShippingMethods()
    {
        $this->shippingMethods = ShippingMethod::where('status', 1)
            ->where('base_id', null)
            ->get();
    
        if ($this->shippingMethods->count() === 1) {
            $singleMethod = $this->shippingMethods->first();
            $this->selectedShippingMethodId = $singleMethod->id;
            $this->selectedShippingCharge = $singleMethod->provider_charge;
        } elseif ($this->shippingMethods->count() > 1) {
            $this->selectedShippingMethodId = null;
            $this->selectedShippingCharge = 0;
        }
    }
    
    public function updatedSelectedShippingMethodId()
    {
        // Validate and fetch the charge securely
        $shippingMethod = ShippingMethod::where('id', $this->selectedShippingMethodId)
            ->first();

        if ($shippingMethod) {
            $this->selectedShippingCharge = $shippingMethod->provider_charge;
        } else {
            $this->selectedShippingCharge = 0;
        }
    }

    public function order(){
        // Validation rules
        $rules = [
            'name'  => 'required',
            'email' => 'nullable|email',
            'phone' => 'required',
            'shipping_address' => 'required',
            'district_id' => 'required'
        ];

        // Custom messages
        $messages = [];

        $this->validate($rules, $messages);

        if( $this->selectedShippingCharge == null ){
            $this->emit('warning', 'select a shipping method');
            return;
        }

        $selectedProduct = session()->get('cart', []);

        $order = Order::create([
            'user_id'                   => Auth::id() ?? null,
            'user_type'                 => 'customer',
            'name'                      => $this->name,
            'email'                     => $this->email,
            'phone'                     => $this->phone,
            'shipping_address'          => $this->shipping_address,
            'district_id'               => $this->district_id,
            // 'payment_type'              => $this->payment_type,
            'shipping_method'           => $this->selectedShippingMethodId,
            'order_date'                => Carbon::now()->format('Y-m-d H:i:s'),
            'shipping_cost'             => $this->selectedShippingCharge,
            'note'                      => $this->note,
            'grand_total'               => $this->grandTotal()
        ]);

        foreach ($selectedProduct as $productData) {
            $productId = $productData['product_id'] ?? null;
           
            $quantity = $productData['quantity'] ?? 1;
        
            if (!$productId) {
                continue;
            }
        
            $product = Product::find($productId);
        
            if ($product) {
                if ($product->quantity >= $quantity) {
                    $price = ($product->discount_option != 1) ? $product->offer_price : $product->base_price;
        
                    $product->update(['quantity' => $product->quantity - $quantity]);
        
                    // Create the order item
                    $order->orderItems()->create([
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);
                }
            }
        }
        
        session()->forget('cart');
        $this->emit('cartUpdated');
        session()->flash('success', 'Your order has been successfully placed. Thank you!!');
        $this->refreshCache();
    }

    public function loadCart()
    {
        $this->cart = session()->get('cart', []);
    }

    public function refreshCart()
    {
        $this->loadCart();
        $this->checkCart();
    }

    public function getTotalAmount()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['quantity'] * $item['offer_price'];
        }
        return $total;
    }

    public function grandTotal(){
        return $this->getTotalAmount() + $this->selectedShippingCharge;
    }

    public function checkCart()
    {
        $this->loadCart();
        
        if (empty($this->cart)) {
            return redirect()->route('shop');
        }
    } 
    
    public function hydrate()
    {
        // Reset error bag and validation
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function refreshCache()
    {
        Cache::forget($this->cacheKey);
        Cache::rememberForever($this->cacheKey, function () {
            return Order::orderBy('id', 'desc')->get();
        });
    }

    public function render()
    {   
        $districts = District::orderBy('name', 'asc')->where('status',1)->get();
        return view('livewire.frontend.order.checkout', compact('districts'));
    }
}
