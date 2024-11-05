@if( $coupon->status == 1 || $coupon->status == 0 )
<label class="form-check form-switch form-check-custom form-check-solid status-toggle">
    <input 
        class="form-check-input change-status" 
        type="checkbox"  
        wire:click="updateStatus"
        data-coupon-id="{{ $coupon->id }}"
        {{ $coupon->status == 1 ? 'checked' : '' }}
    >
</label>
@else 
    <span class="badge badge-light-danger">expire</span>
@endif