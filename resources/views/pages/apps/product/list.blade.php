<x-default-layout>

    @section('title') Product List @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('product') }}
    @endsection
    <link rel="stylesheet" href="{{asset('sass/_tooltips.scss')}}">
    <style>
        .thumbnail-img {
            width: 80%;
        }
    </style>

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" 
                        class="form-control form-control-solid w-250px ps-13" placeholder="Search product"
                        id="mySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                @include('pages.apps.product.buttons')
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <livewire:product.product-action></livewire:product.product-action>

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    <!-- DataTables Buttons JS -->
    
    @push('scripts')
    @if(Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    {{ $dataTable->scripts() }}
        <script>
            // Initialize DataTable and event listeners when the document is ready
            $(document).ready(function() {
                var table = $('#product-table').DataTable();
                
                // Event listener for the search input field
                document.getElementById('mySearchInput').addEventListener('keyup', function() {
                    window.LaravelDataTables['product-table'].search(this.value).draw();
                });

   
                // Livewire success event handler
                document.addEventListener('livewire:load', function() {
                    Livewire.on('success', function() {
                        window.LaravelDataTables['product-table'].ajax.reload();
                    });
                });
        
                // Event listener for export buttons
                $('[data-kt-export]').on('click', function(e) {
                    e.preventDefault();
                    handleExport($(this).data('kt-export'));
                });
        
                // Handle DataTable export actions
                function handleExport(exportType) {
                    switch (exportType) {
                        case 'copy':
                            table.button('.buttons-copy').trigger();
                            break;
                        case 'excel':
                            table.button('.buttons-excel').trigger();
                            break;
                        case 'csv':
                            table.button('.buttons-csv').trigger();
                            break;
                        case 'pdf':
                            table.button('.buttons-pdf').trigger();
                            break;
                        default:
                            console.error('Unknown export type:', exportType);
                    }
                }
        
                // Parse formatted numbers to float
                function parseNumber(value) {
                    return parseFloat(value.replace(/,/g, '')) || 0;
                }
        
                // Calculate the grand total for a specific column
                function calculateGrandTotal(columnIndex) {
                    var total = 0;
                    table.column(columnIndex, { search: 'applied' }).data().each(function(value) {
                        total += parseNumber(value);
                    });
                    return total;
                }
        
                // Format numbers with a specific locale and precision
                function formatNumber(value) {
                    return new Intl.NumberFormat('en-US', {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 2
                    }).format(value);
                }
        
                // Update the table footer with grand totals
                function updateFooter() {
                    // var totalBasePrice = calculateGrandTotal(2);
                    // var totalOfferPrice = calculateGrandTotal(3);
                    // var totalStockQuantity = calculateGrandTotal(4);
        
                    // if ($('#product-table tfoot').length === 0) {
                    //     $('#product-table').append('<tfoot></tfoot>');
                    // }
        
                    // $('#product-table tfoot tr.grand-total-row').remove();
        
                    // $('#product-table tfoot').append(
                    //     '<tr class="grand-total-row">' +
                    //         '<td colspan="2" class="text-end">Total</td>' +
                    //         '<td>' + formatNumber(totalBasePrice) + '</td>' +
                    //         '<td>' + formatNumber(totalOfferPrice) + '</td>' +
                    //         '<td class="text-center">' + formatNumber(totalStockQuantity) + '</td>' +
                    //     '</tr>'
                    // );
                }
        
                // Call the updateFooter function after the table is drawn
                table.on('draw', updateFooter);
                updateFooter();
            });
        </script>    
    @endpush

</x-default-layout>