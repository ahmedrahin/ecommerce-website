<?php

namespace App\Http\Livewire\Frontend\User;

use Livewire\Component;
use App\Models\User;

class Contactinfo extends Component
{   
    public $user_id;
    public $user;

    protected $listeners = ['profileUpdated'];

    public function mount($user_id){
        $this->user_id = $user_id;
        $this->profileUpdated();
    }
    
    public function profileUpdated(){
        $this->user = User::find($this->user_id);
    }

    public function render()
    {
        return view('livewire.frontend.user.contactinfo');
    }
}
