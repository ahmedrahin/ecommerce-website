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
use App\Models\Coupon;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;


class Checkout extends Component
{   
    public $name;
    public $email;
    public $phone;
    public $shipping_address;
    public $district_id;
    public $note;
    public $payment_type;
    public $selectedShippingMethodId; 
    public $selectedShippingCharge = 0 ;

    public $cart = [];
    public $quantities = [];
    public $shippingMethods;
    public $couponCode;
    public $discountAmount = 0;
    public $appliedCoupon;
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
        $this->loadCart();
        $this->loadShippingMethods();
        $this->payment_type = 'cod';

        $this->appliedCoupon = session()->get('applied_coupon', null);

        if( Auth::check() ){
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
            $this->phone = Auth::user()->phone;
            $this->shipping_address = Auth::user()->shipping_address;
        }
    }

    public function loadCart()
    {
        // Retrieve the cart from the session
        $sessionCart = session()->get('cart', []);
    
        $validCart = []; // Temporary array for valid items
    
        foreach ($sessionCart as $cartKey => $item) {
            $productId = explode('-', $cartKey)[0];
            $product = Product::find($productId);
    
            if ($product && ($product->status == 1 || $product->status == 3) && $product->quantity > 0) {
                $validCart[$cartKey] = $item;
                $validCart[$cartKey]['name'] = $product->name;
                $validCart[$cartKey]['slug'] = $product->slug;
                $validCart[$cartKey]['offer_price'] = $product->offer_price;
                $validCart[$cartKey]['price'] = $product->base_price;
                $validCart[$cartKey]['image_url'] = $product->thumb_image;
                $validCart[$cartKey]['available_quantity'] = $product->quantity;
                $validCart[$cartKey]['discount_option'] = $product->discount_option;
                $validCart[$cartKey]['quantity'] = $item['quantity'] ?? 1; 
            }
        }
    
        // Assign valid items to the cart
        $this->cart = $validCart;
    }
    

    public function applyCoupon()
    {   
        if( $this->couponCode == null ){
            $this->emit('error', 'please enter your coupon code.');
            return;
        }
        
        $coupon = Coupon::where('code', $this->couponCode)
            ->where('status', 1)
            ->whereDate('start_at', '<=', now()) 
            ->where(function ($query) {
                $query->whereNull('expire_date') 
                    ->orWhereDate('expire_date', '>=', now());
            })
            ->first();


        if (!$coupon) {
            $this->emit('error', 'Invalid or expired coupon code!');
            $this->couponCode = '';
            return;
        }

        if( $coupon->min_purchase_amount && ($coupon->min_purchase_amount > $this->getTotalAmount() ) ){
            $this->emit('error', 'You need to minimum purchase ' . $coupon->min_purchase_amount . 'tk for use this coupon');
            $this->couponCode = '';
            return;
        }

        // Check usage limit
        $usage = $coupon->orders()->count();
        if ($coupon->usage_limit && ($usage >= $coupon->usage_limit)) {
            $this->emit('error', 'The coupon usage limit has been reached.');
            $this->couponCode = '';
            return;
        }

        // Apply the discount based on coupon type
        if ($coupon->discount_type == 'percentage') {
            $this->discountAmount = $this->getTotalAmount() * ($coupon->discount_amount / 100);
        } else {
            $this->discountAmount = $coupon->discount_amount;
        }

        // Store the coupon and discount amount
        session()->put('applied_coupon', [
            'code' => $this->couponCode,
            'discount' => $this->discountAmount,
        ]);
        $this->appliedCoupon = session()->get('applied_coupon');
        $this->emit('success', 'Coupon applied successfully!');
    }

    public function removeCoupon()
    {
        $this->couponCode = null;
        $this->discountAmount = 0;
        $this->appliedCoupon = [];
        session()->forget('applied_coupon');

        // $this->emit('info', 'Coupon removed.');
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

        $orderId = 'F' . now()->format('Ymd') . '-' . strtoupper(uniqid());
        // Validation rules
        $rules = [
            'name'  => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|numeric|digits:11',
            'shipping_address' => 'required',
            'district_id' => 'required'
        ];

        // Custom messages
        $messages = [];

        $this->validate($rules, $messages);

        if( $this->selectedShippingCharge == null ){
            $this->emit('warning', 'select a shipping method');
            return;
        }elseif( $this->payment_type == null ){
            $this->emit('warning', 'select a payment method');
            return;
        }

        $selectedProduct = session()->get('cart', []);

        $order = Order::create([
            'order_id'                  => $orderId,
            'user_id'                   => Auth::id() ?? null,
            'user_type'                 => 'customer',
            'name'                      => $this->name,
            'email'                     => $this->email,
            'phone'                     => $this->phone,
            'shipping_address'          => $this->shipping_address,
            'district_id'               => $this->district_id,
            'payment_type'              => $this->payment_type,
            'shipping_method'           => $this->selectedShippingMethodId,
            'order_date'                => Carbon::now()->format('Y-m-d H:i:s'),
            'shipping_cost'             => $this->selectedShippingCharge,
            'note'                      => $this->note,
            'grand_total'               => $this->grandTotal(),
            'cupon_code'               => $this->appliedCoupon['code'] ?? null, 
            'coupon_discount'           => $this->appliedCoupon['discount'] ?? 0,
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
                    $orderItem = $order->orderItems()->create([
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);

                    // Insert variations (size, color, etc.)
                    $variations = [
                        'size' => $productData['size'] ?? null,
                        'color' => $productData['color'] ?? null,
                    ];

                    foreach ($variations as $attributeName => $attributeValue) {
                        if ($attributeValue) { 
                            $orderItem->orderItemVariations()->create([
                                'attribute_name' => $attributeName,
                                'attribute_value' => $attributeValue,
                            ]);
                        }
                    }
                }
            }
        }
        
        // mail sent to admin
        $adminMail = config('app.email');
        Mail::to($adminMail)->send(new OrderPlaced($order));

        $this->emit('cartUpdated');
        session()->flash('success', 'Your order has been successfully placed. Thank you!!');
        $this->refreshCache();
        $this->removeCoupon();
        session()->forget('cart');
        return redirect()->route('success.order', ['order_id' => $orderId]);
    }

    public function refreshCart()
    {
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

    public function grandTotal()
    {
        $discount = $this->appliedCoupon ? ($this->appliedCoupon['discount'] ?? 0) : 0;
        return $this->getTotalAmount() + $this->selectedShippingCharge - $discount;
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
