<div class="modal fade" id="kt_modal_add_state" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_state_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">
                    {{ $edit_mode ? 'Update State' : 'Add New State' }}
                </h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form wire:submit.prevent="submit">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_state_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_state_header" data-kt-scroll-wrappers="#kt_modal_add_state_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">State Name</label>
                            <input type="text" wire:model.defer="name" name="name" class="form-control form-control-solid mb-3 mb-lg-0 @error('name') is_valid @enderror" placeholder="State name" />
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- district list -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">District</label>
                            <select name="district_id" wire:model="district_id" id="district_id"
                                class="form-select form-select-solid @error('district_id') is_valid @enderror" data-placeholder="Select a district">
                                <option></option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                            </select>

                            @error('district_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if($edit_mode)
                            <input type="hidden" wire:model.defer="state_id" name="state_id" />
                        @endif
                    </div>
                    <div class="text-center pt-3">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close"
                            >Cancel</button>
                        <button type="submit" class="btn btn-primary" data-kt-brand-modal-action="submit" style="width: 200px !important;">
                            @if( !$edit_mode )
                                <span class="indicator-label" wire:loading.remove wire:target="submit">Save State</span>
                            @else
                                <span class="indicator-label" wire:loading.remove wire:target="submit">Save Changes</span>
                            @endif
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            // const modal = document.querySelector('#kt_modal_add_state');
            // modal.addEventListener('show.bs.modal', (e) => {
            //     const districtId = e.relatedTarget.getAttribute('data-district-id');
            //     const stateId = e.relatedTarget.getAttribute('data-state-id');
            //     // Livewire.emit('modal.show.state', stateId);
            //     Livewire.emit('modal.show.`districtId`', districtId);
            //     // Emit the Livewire event to reset the form
            //     Livewire.emit('open_add_modal');
            // });

            Livewire.hook('message.processed', (message, component) => {
                if (component.el.id === 'kt_modal_add_state') {
                    const selectElement = $('#district_id');
                    selectElement.select2({
                        placeholder: "Select a district",
                        allowClear: false,
                        dropdownParent: $("#kt_modal_add_state"),
                    });
                    
                    // Attach event handler only once
                    selectElement.on('change', function (e) {
                        Livewire.find(component.id).set('district_id', e.target.value);
                    });
                }
            });
        });

        const modal = document.querySelector('#kt_modal_add_state');
        modal.addEventListener('show.bs.modal', (e) => {
            // Livewire.emit('modal.show.state', e.relatedTarget.getAttribute('data-state-id'));
            // Emit the Livewire event to reset the form
            Livewire.emit('open_add_modal');
        });
    </script>
@endpush
