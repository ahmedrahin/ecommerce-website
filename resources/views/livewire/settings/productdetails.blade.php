<div>
    <form wire:submit.prevent="update" id="kt_ecommerce_settings_general_customers" class="form">
        <!--begin::Heading-->
        <div class="row mb-7">
            <div class="col-md-9 offset-md-3">
                <h4>User Settings</h4>
            </div>
        </div>
       
    
        <div class="row fv-row mb-7">
            <div class="col-md-3 text-md-end">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span>Order Count</span>
                    <span class="ms-1" data-bs-toggle="tooltip"
                        title="Do you show how much order and wishlist has this product!">
                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </span>
                </label>
                <!--end::Label-->
            </div>
            <div class="col-md-9">
                <div class="d-flex mt-3">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="radio" value="1"
                            wire:model="show_order_count"
                            id="show_order_count" />
                        <label class="form-check-label"
                            for="show_order_count">Yes</label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" value="0"
                            id="show_order_count_no" wire:model="show_order_count" />
                        <label class="form-check-label"
                            for="show_order_count_no">No</label>
                    </div>
                    <!--end::Radio-->
                </div>
            </div>
        </div>

        <div class="row fv-row mb-7">
            <div class="col-md-3 text-md-end">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mt-3">
                    <span>Show Size Chart</span>
                    <span class="ms-1" data-bs-toggle="tooltip"
                        title="Do you show size chart!">
                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </span>
                </label>
                <!--end::Label-->
            </div>
            <div class="col-md-9">
                <div class="d-flex mt-3">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="radio" value="1"
                            wire:model="show_order_count"
                            id="show_order_count" />
                        <label class="form-check-label"
                            for="show_order_count">Yes</label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" value="0"
                            id="show_order_count_no" wire:model="show_order_count" />
                        <label class="form-check-label"
                            for="show_order_count_no">No</label>
                    </div>
                    <!--end::Radio-->
                </div>
            </div>
        </div>

       
        <div class="row py-5">
            <div class="col-md-9 offset-md-3">
                <div class="card-footer d-flex justify-content-end py-0" style="border: none;">
                    <button type="submit" class="btn btn-primary" data-kt-brand-modal-action="submit"
                        style="width: 200px !important;">
                        <span class="indicator-label" wire:loading.remove wire:target="update">Save Changes</span>
                        <span class="indicator-progress" wire:loading wire:target="update">
                            Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <!--end::Action buttons-->
    </form>
</div>
