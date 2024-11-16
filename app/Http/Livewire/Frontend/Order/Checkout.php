<?php

namespace App\Http\Livewire\Frontend\Order;

use Livewire\Component;
use App\Models\ShippingMethod;
use App\Models\District;

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

    protected $listeners = [
        'cartUpdated' => 'refreshCart',
    ];

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

    public function render()
    {   
        $districts = District::orderBy('name', 'asc')->where('status',1)->get();
        return view('livewire.frontend.order.checkout', compact('districts'));
    }
}
