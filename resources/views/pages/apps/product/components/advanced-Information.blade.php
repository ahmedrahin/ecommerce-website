<div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Product Inventory</h2>
                </div>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="fv-row">
                    <label class="required form-label">SKU</label>
                    <input type="text" name="sku_code" class="form-control mb-2" placeholder="SKU Number" value="" />
                    <span id="sku_code" class="text-danger"></span>
                </div>
                <div class=" fv-row">
                    <label class="required form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control mb-2" placeholder="Product Quantity" value="" />
                    <span id="quantity" class="text-danger"></span>
                    
                </div>
                <div class=" fv-row">
                    <label class="form-label">Expire Date</label>
                    <input class="form-control" id="kt_ecommerce_add_product_expire_datepicker" placeholder="Pick date & time" name="expire_date" value="{{ old('expire_date') }}" />
                    <span id="expire_date" class="text-danger"></span>
                    
                </div>
            </div>
        </div>
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Product Variations</h2>
                </div>
            </div>

            <div class="card-body pt-0">
                <div id="product-options-container">
                    <div class="product_options mb-6">
                        <div class="row mb-4">
                            @foreach($attributes ?? [] as $attribute)
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">{{ $attribute->attr_name }}</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input attribute_id_item"
                                                   name="attributes[0][{{$loop->index}}][attribute]"
                                                   value="{{ $attribute->id }}" />
                                            </div>
                                        </div>
                                        <div class="attribute_value" style="width: 85%">
                                            <select class="form-select value_id_item"
                                                    name="attributes[0][{{$loop->index}}][attribute_value]"
                                                    data-placeholder="Select a value"
                                                    data-kt-ecommerce-catalog-add-product="product_option"
                                                    >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            
                            <button type="button" data-repeater-delete=""
                                    class="btn btn-sm btn-icon btn-light-danger">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-light-primary" id="addAttr">
                            <i class="ki-duotone ki-plus fs-2"></i>Add another variation
                        </button>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Shipping</h2>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <!-- <div class="fv-row mb-4">
                    <div class="form-check form-check-custom form-check-solid mb-2">
                        <input class="form-check-input" type="checkbox" id="kt_ecommerce_add_product_shipping_checkbox" value="1">
                        <label class="form-check-label">This is a physical product</label>
                    </div>
                    <div class="text-muted fs-7">Set if the product is a physical or digital item. Physical products may require shipping.</div>
                </div> -->
                <!--end::Input group-->
                <div class="fv-row">
                    <!--begin::Input-->
                    <div class="form-check form-check-custom form-check-solid mb-2">
                        <input class="form-check-input" type="checkbox" id="free_shipping" name="free_shipping" value="yes">
                        <label for="free_shipping" class="form-check-label">Free Shipping</label>
                    </div>
                    <!--end::Input-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set if the product is free shipping</div>
                    <!--end::Description-->
                </div>
                <!--begin::Shipping form-->
                <div id="kt_ecommerce_add_product_shipping" class="mt-5">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="form-label">Weight</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <input type="text" name="weight" class="form-control mb-2" placeholder="Product weight" value="">
                        <!--end::Editor-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="form-label">Dimension</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                            <input type="number" name="width" class="form-control mb-2" placeholder="Width (w)" value="">
                            <input type="number" name="height" class="form-control mb-2" placeholder="Height (h)" value="">
                            <input type="number" name="length" class="form-control mb-2" placeholder="Lengtn (l)" value="">
                        </div>
                        <!--end::Input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Shipping form-->
            </div>
            <!--end::Card header-->
        </div>
    </div>
</div>


@push('scripts')

<script>
    
    $(document).ready(function() {
        var KTAppEcommerceSaveProduct = function () {

            // Init condition select2
            const initConditionsSelect2 = () => {
                // Initialize all repeating condition types
                const allConditionTypes = document.querySelectorAll('[data-kt-ecommerce-catalog-add-product="product_option"]');
                allConditionTypes.forEach(type => {
                    if ($(type).hasClass("select2-hidden-accessible")) {
                        return;
                    } else {
                        $(type).select2({
                            minimumResultsForSearch: -1 // Disable search box
                        });
                    }
                });
            }

            // Public methods
            return {
                init: function () {
                    initConditionsSelect2();
                }
            };
        }();

        // Initialize select2 on document ready
        KTUtil.onDOMContentLoaded(function () {
            KTAppEcommerceSaveProduct.init();
        });

        let counter = 1;
        let qtyCounter = 1;

        // Function to attach events to product options
        function attachEvents($container) {
            $container.find(".attribute_id_item").on("change", function() {
                let $checkbox = $(this);
                let attributeId = $checkbox.val();
                let $selectBox = $checkbox.closest('.d-flex').find('.attribute_value select');

                if ($checkbox.is(':checked')) {
                    if (attributeId !== "" && attributeId !== "0") {
                        $.ajax({
                            url: '/get-attribute-value/' + attributeId,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $selectBox.empty();

                                // Check if data is empty (no attribute values)
                                if (data.length === 0) {
                                    // Uncheck the checkbox and show a toastr notification
                                    $checkbox.prop('checked', false);
                                    toastr.warning('No value exists for the selected attribute.');
                                } else {
                                    // Populate the select box with attribute values
                                    $.each(data, function(key, value) {
                                        $selectBox.append('<option value="' + value.id + '">' + value.attr_value + '</option>');
                                    });
                                }
                            },
                            error: function() {
                                toastr.error('An error occurred while fetching attribute values.');
                            }
                        });
                    }
                } else {
                    $selectBox.empty().append('<option></option>');
                }
            });

            // Delete product option
            $container.find("[data-repeater-delete]").on("click", function() {
                let $thisProductOptions = $(this).closest('.product_options');

                $thisProductOptions.fadeOut(300, function() {
                    $(this).slideUp(300, function() {
                        $(this).remove();
                    });
                });
            });
        }

        // Generate new product option HTML
        function generateNewOptionHtml(counter, qtyCounter) {
            return `
                <div class="product_options mb-6" style="padding-top: 20px;border-top: 1px solid #eee;">
                    <div class="row mb-4">
                        @foreach($attributes ?? [] as $attribute)
                            <div class="col-md-6 mb-1">
                                <label class="form-label">{{ $attribute->attr_name }}</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input attribute_id_item"
                                                name="attributes[${counter}][{{$loop->index}}][attribute]"
                                                value="{{ $attribute->id }}" />
                                        </div>
                                    </div>
                                    <div class="attribute_value" style="width: 85%">
                                        <select class="form-select value_id_item"
                                                name="attributes[${counter}][{{$loop->index}}][attribute_value]"
                                                data-placeholder="Select a variation"
                                                data-kt-ecommerce-catalog-add-product="product_option">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex align-items-center gap-4">
                      
                        <button type="button" data-repeater-delete=""
                                class="btn btn-sm btn-icon btn-light-danger">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                    </div>
                </div>`;
        }

        // Initially attach events to existing product options
        attachEvents($("#product-options-container"));

        // Add a new product option on button click
        $("#addAttr").on("click", function() {
            counter++;
            qtyCounter++;
            let $newProductOptions = $(generateNewOptionHtml(counter, qtyCounter));
            $newProductOptions.hide().insertBefore($(this).closest('.form-group')).slideDown('slow');
            
            // Re-attach events to the new option and reinitialize select2
            attachEvents($newProductOptions);
            KTAppEcommerceSaveProduct.init(); // Re-initialize select2 for new select elements
        });
    });

</script>
@endpush