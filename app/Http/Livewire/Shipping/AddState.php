<?php

namespace App\Http\Livewire\Shipping;
use App\Models\Upazila;
use App\Models\District;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddState extends Component
{
    // Properties for storing state data
    public $name;
    public $state_id;
    public $districts;
    public $district_id;
    public $status = 1;
    public $edit_mode = false;

    // Cache key for states
    private $cacheKey;

    // Event listeners
    protected $listeners = [
        'update_state'      => 'updateState',
        'delete_state'      => 'delete',
        'open_add_modal'    => 'openAddModal',
        'update_status'     => 'updateStatus',
        // 'districtId'        => 'setDistrictId',
    ];

    public function __construct()
    {
        $this->cacheKey = config('dbcachekey.shipping_state');
    }

    // public function setDistrictId($districtId)
    // {
    //     $this->district_id = $districtId;
    // }

    //all district list
    public function mount()
    {
        $this->districts = District::orderBy('name', 'asc')->get();
    }

    // Handle form submission
    public function submit()
    {
        // Validation rules
        $rules = [
            'name'          => 'required',
            'district_id'   => 'required'
        ];

        $message = [
            'district_id.required' => 'Please select a district'
        ];

        // Validate form input
        $validation = $this->validate($rules, $message);

        // Check if we are in edit mode
        if ($this->edit_mode) {
            $this->updateExistingState($validation);
        } else {
            $this->createNewstate($validation);
        }

        // Reset the form
        $this->resetForm();
    }

    // Create a new state
    public function createNewstate($validData)
    {
        // Create the state
        Upazila::create($validData);

        // Emit success message
        $this->emit('success', __('State created successfully.'));
        $this->refreshCache();

        // Reset form fields
        $this->resetForm();
    }

    // update the state
    public function updateState($id)
    {
        $state = Upazila::findOrFail($id);

        $this->edit_mode = true;
        $this->state_id = $state->id;
        $this->fill($state->toArray());

        $this->refreshCache();
    }

    // Update an existing state
    private function updateExistingState($validData)
    {
        $state = Upazila::findOrFail($this->state_id);

        $state->name           = $this->name;
        $state->district_id    = $this->district_id;
        $state->status         = $this->status;

        $state->save();

        $this->emit('success', __('State updated successfully.'));
        $this->refreshCache();
    }

    //update status
    public function updateStatus($id, $status)
    {
        $state = Upazila::findOrFail($id);
        $state->update(['status' => $status]);

        $message = $status == 0 ? "{$state->name} is inactive" : "{$state->name} is active";
        $type = $status == 0 ? 'info' : 'success';

        // Emit success message
        $this->emit($type, $message);
        $this->refreshCache();
    }

    // Delete a state
    public function delete($id)
    {
        // Find the state by ID
        $state = Upazila::findOrFail($id);

        // Delete the state
        $state->delete();

        // Emit success message and reset the form
        $this->emit('info', __('State was deleted.'));
        $this->resetForm();

        $this->refreshCache();
    }

    // Handle component hydration
    public function hydrate()
    {
        // Reset error bag and validation
        $this->resetErrorBag();
        $this->resetValidation();
    }

    // Reset form fields
    private function resetForm()
    {
        // Reset edit mode and form fields
        $this->edit_mode = false;
        $this->reset(['name', 'state_id', 'district_id', 'status']);
    }

    // Refresh the cache
    private function refreshCache()
    {
        Cache::forget($this->cacheKey);
        Cache::rememberForever($this->cacheKey, function () {
            return Upazila::orderBy('id', 'desc')->get();
        });
    }

    // Method to open the add modal and reset the form
    public function openAddModal()
    {
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.shipping.add-state');
    }
}
