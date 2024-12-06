<div class="card-body pt-0">
    <label class="fw-semibold fs-6 mb-2 mt-5">Delivery Status</label>
    <select wire:model="delivery_status" id="status"
        class="form-select form-select-solid " data-control="select2" >
       <option value="pending">Pending</option>
       <option value="shipped">Shipped</option>
       <option value="delivered">Delivered</option>
       <option value="canceled">Canceled</option>
       <option value="completed">Completed</option>
    </select>

    @if( !is_null($order->note) )
        <label class="fw-semibold fs-6 mb-2 mt-5">Note:</label>
        <p>{{$order->note}}</p>
    @endif

    <script>
        document.addEventListener('livewire:load', function () {
                initializeSelect2();
            });

            function initializeSelect2() {
                $('#status').select2({
                    placeholder: "Select a status",
                    minimumResultsForSearch: -1 
                }).on('change', function (e) {
                    let value = $(this).val();
                    @this.set('delivery_status', value); 
                });
            }

            document.addEventListener('livewire:update', function () {
                initializeSelect2(); 
            });
    </script>
</div>


