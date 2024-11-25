<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Select Products</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0 pb-2">
        <div class="d-flex flex-column gap-8">
            <!--begin::Input group-->
            <div>
                
                <!--begin::Label-->
                <label class="form-label">Add products to this order</label>
                <!--end::Label-->
                <!--begin::Selected products-->
                <div class="row row-cols-1 row-cols-xl-3 row-cols-md-2 border border-dashed rounded pt-3 pb-0 px-2 mb-5 mh-300px overflow-scroll" id="cart-items">
                    <!--begin::Empty message-->
                    @if(count($selectedProducts) == 0)
                        <span class="w-100 text-muted">Select one or more products from the list below by ticking the checkbox.</span>
                    @else
                        @foreach($products->whereIn('id', $selectedProducts) as $product)
                            <div class="col my-2">
                                <div class="d-flex align-items-center border border-dashed rounded p-3 bg-body position-relative">
                                    @if (!is_null($product->thumb_image))
                                        <img src="{{ asset($product->thumb_image) }}" width="60" height="60" class="table-product-image" style="object-fit: cover; margin-right: 10px;">
                                    @else
                                        <img src="{{ asset('uploads/blank-image.svg') }}" width="60" height="60" class="table-product-image" style="object-fit: cover; margin-right: 10px;">
                                    @endif
                    
                                    <div class="ms-1">
                                        <a href="{{ route('product-management.show', $product->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $product->name }}</a>
                                        <div class="fw-semibold fs-7">Price: {{ $product->discount_option != 1 ? $product->offer_price : $product->base_price }}৳</div>
                                        <div class="text-muted fs-7">Qty: {{ $quantities[$product->id] }}</div>
                                    </div>
                                    <button type="button" class="btn" style="position: absolute; right: 4px;top: -6px;" wire:click="removeProduct({{ $product->id }})">
                                        <i class="ki-duotone ki-cross-circle fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                {{-- <button type="button" wire:click="clearSessionData">click</button> --}}
                <div class="fw-bold fs-4" style="font-size: 1.2rem !important;">Total Qty: 
                    <span id="kt_ecommerce_edit_order_total_qty">{{ $totalQuantity }}</span></div>
                <div class="fw-bold fs-4" style="font-size: 1.2rem !important;">Total Cost:
                <span id="kt_ecommerce_edit_order_total_price">{{ number_format($totalCost, 2) }}৳</span></div>
            </div>
            <div class="separator"></div>
            <div class="d-flex justify-content-between align-items-center">
                <!-- Search bar on the left -->
                <div class="position-relative" style="width: 30%;">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4" style="top: 28%;">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" class="form-control form-control-solid ps-12" placeholder="Search Products" wire:model="search" />
                </div>
            
                <!-- Category dropdown on the right -->
                <div class="w-25">
                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Category" wire:model="selectedCategory" id="categorySelect">
                        <option></option>
                        <option value="all">All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!--end::Search products-->
            
            <!--begin::Table-->
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_order_product_table" style="margin-top: -10px;">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-25px pe-2"></th>
                            <th class="min-w-200px">Product</th>
                            <th class="min-w-200px text-center">Qty</th>
                            <th class="min-w-100px text-end pe-5">Qty Remaining</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @if ($products->isNotEmpty())
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="{{ $product->id }}" wire:model="selectedProducts" 
                                                onchange="handleCheckboxChange(this, '{{ $product->name }}')"
                                                @if(in_array($product->id, $selectedProducts)) checked @endif
                                                />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if(!is_null($product->thumb_image))
                                                <a href="{{ route('product-management.show', $product->id) }}" class="symbol symbol-50px">
                                                    <span class="symbol-label" style="background-image:url({{ asset($product->thumb_image) }});"></span>
                                                </a>
                                            @else
                                                <img src="{{ asset('uploads/blank-image.svg') }}" width="60" height="60" class="table-product-image" style="object-fit: cover; margin-right: 10px;">
                                            @endif
                                            <div class="ms-5">
                                                <a href="{{ route('product-management.show', $product->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $product->name }}</a>
                                                <div class="fw-semibold fs-7">Price: {{ $product->discount_option != 1 ? $product->offer_price : $product->base_price }}৳</div>
                                                <div class="text-muted fs-7">SKU: {{ $product->sku_code }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="position-relative d-flex align-items-center justify-content-center">
                                            <button type="button" class="btn btn-icon btn-sm btn-light btn-icon-gray-500"
                                            onclick="decreaseQuantity({{ $product->id }})">
                                                <i class="ki-duotone ki-minus fs-1x"></i>
                                            </button>
                    
                                            @if(in_array($product->id, $selectedProducts))
                                                <input type="text" class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px"
                                                id="quantity_{{ $product->id }}" 
                                                value="{{ $quantities[$product->id] ?? 1 }}" 
                                                readonly
                                                wire:model.lazy="quantities.{{ $product->id }}" 
                                                onblur="validateQuantity({{ $product->id }})">
                                            @else
                                                <input type="text" class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px"
                                                id="quantity_{{ $product->id }}" 
                                                value="1" 
                                                readonly
                                                onblur="validateQuantity({{ $product->id }})">
                                            @endif
                    
                                            <button type="button" class="btn btn-icon btn-sm btn-light btn-icon-gray-500"
                                            onclick="increaseQuantity({{ $product->id }}, {{ $product->quantity }})">
                                                <i class="ki-duotone ki-plus fs-1x"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end pe-5">
                                        @if ($product->quantity == 0)
                                            <span class="badge badge-light-danger">Sold out</span>
                                        @elseif ($product->quantity > 0 && $product->quantity <= 5)
                                            <span class="badge badge-light-warning">Low stock: {{ $product->quantity }}</span>
                                        @else
                                            <span class="badge badge-light-primary">{{ $product->quantity }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="dataTables_empty mt-8"> No products found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
</div>

@push('scripts')

    <script>
        document.addEventListener('livewire:load', function () {
            // Initialize Select2 on load
            $('#categorySelect').select2({
                placeholder: "Select Category",
                allowClear: false
            });

            // Update Livewire model on selection
            $('#categorySelect').on('change', function (e) {
                @this.set('selectedCategory', $(this).val());
            });
        });

        document.addEventListener('livewire:update', function () {
            // Reinitialize Select2 after Livewire update
            $('#categorySelect').select2({
                placeholder: "Select Category",
                allowClear: false
            });
        });

        // Function to decrease quantity
        function decreaseQuantity(productId) {
            const input = document.getElementById(`quantity_${productId}`);
            let quantity = parseInt(input.value);

            if (quantity > 1) {
                quantity--;
                input.value = quantity;
                // Update the Livewire component with the new quantity
                @this.set(`quantities.${productId}`, quantity);
            } else {
                toastr.warning('Quantity cannot be less than 1.');
            }
        }

        // Function to increase quantity
        function increaseQuantity(productId, maxQuantity) {
            const input = document.getElementById(`quantity_${productId}`);
            let quantity = parseInt(input.value);

            if (quantity < maxQuantity) {
                quantity++;
                input.value = quantity;
                // Update the Livewire component with the new quantity
                @this.set(`quantities.${productId}`, quantity);
            } else {
                toastr.warning('You cannot exceed the available quantity.');
            }
        }

        // Validate the input quantity
        function validateQuantity(productId) {
            const input = document.getElementById(`quantity_${productId}`);
            let quantity = input.value;

            // Check if the input is a valid number
            if (isNaN(quantity) || quantity <= 0) {
                toastr.warning('Please enter a valid quantity.');
                input.value = 1; // Reset to 1 if invalid
                // Update the Livewire component with the default value (1)
                @this.set(`quantities.${productId}`, 1);
            } else {
                // Parse the quantity to a number
                quantity = parseInt(quantity);

                // Reset to 1 if less than 1
                if (quantity < 1) {
                    toastr.warning('Quantity cannot be less than 1.');
                    input.value = 1;
                    @this.set(`quantities.${productId}`, 1);
                } else {
                    // Update the Livewire component with the valid quantity
                    @this.set(`quantities.${productId}`, quantity);
                }
            }
        }
        
        // window.addEventListener('beforeunload', function (event) {
        //     @this.call('clearSessionDataOnLeave');
        // });
    </script>

@endpush


