<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use App\Models\Order;

class OrderAction extends Component
{   
    public $order;
    public $delivery_status;

    public function mount($order_id){
        $this->order = Order::find($order_id);

        if ($this->order) {
            $this->order->update(['viewed' => 1]); 
            $this->delivery_status = $this->order->delivery_status;
        } else {
            throw new \Exception('Order not found.');
        }
    }

    public function updatedDeliveryStatus($value)
    {
        if ($this->order) {
            $this->order->update(['delivery_status' => $value]);
            $this->emit('info', 'Delivery status updated.');
        }
    }

    public function render()
    {
        return view('livewire.order.order-action');
    }
}
