<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\WebsiteSetting;

class Productdetails extends Component
{
    public $product_info;
    public $show_expire;
    public $share;
    public $ask_qustion;
    public $show_size_chart;
    public $show_order_count;

    public function mount()
    {
        // Load existing settings or defaults
        $settings = WebsiteSetting::first();
        $this->product_info = $settings->product_info ?? true;
        $this->show_expire = $settings->show_expire ?? 20;
        $this->share = $settings->share ?? true;

        $this->ask_qustion = $settings->ask_qustion ?? true;
        $this->show_size_chart = $settings->show_size_chart ?? true;
        $this->show_order_count = $settings->show_order_count ?? true;

    }

    public function update()
    {
        // Validate inputs
        $this->validate([
           
        ]);


        WebsiteSetting::updateOrCreate(
            ['id' => 1],
            [
                
            ]
        );

        $this->emit('success', __('Settings Updated successfully.'));
    }

    public function render()
    {
        return view('livewire.settings.productdetails');
    }
}
