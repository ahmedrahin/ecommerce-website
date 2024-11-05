<label class="form-check form-switch form-check-custom form-check-solid status-toggle">
    <input 
        class="form-check-input change-status" 
        type="checkbox"  
        wire:click="updateStatus"
        data-state-id="{{ $state->id }}"
        {{ $state->status == 1 ? 'checked' : '' }}
    >
</label>
