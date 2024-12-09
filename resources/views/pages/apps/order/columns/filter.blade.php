<script>
    $(document).ready(function () {
        let productTable = window.LaravelDataTables['order-table'];
        setInterval(function () {
            if (productTable) {
                productTable.draw(false); 
            }
        }, 20000);
    });

    function dateRemove(){
            $('#kt_daterangepicker_4').val('');
        }
    $(document).ready(function () {
        var table = window.LaravelDataTables['order-table'];
        // Initialize Date Range Picker
        $("#kt_daterangepicker_4").daterangepicker({
            autoApply: false,
            timePicker: true,
            timePicker24Hour: false,
            timePickerSeconds: false, 
            locale: {
                format: "YYYY-MM-DD", 
                applyLabel: 'Apply', 
                cancelLabel: 'Clear', 
            },
            ranges: {
                "Today": [moment().startOf('day'), moment().endOf('day')],
                "Yesterday": [moment().subtract(1, "days").startOf('day'), moment().subtract(1, "days").endOf('day')],
                "Last 7 Days": [moment().subtract(6, "days").startOf('day'), moment().endOf('day')],
                "Last 30 Days": [moment().subtract(29, "days").startOf('day'), moment().endOf('day')],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            }
        });

        $('#kt_daterangepicker_4').val('');
        $('.ki-cross').hide();
        $('#kt_daterangepicker_4').on('change keyup', function () {
            if ($(this).val()) {
                $('.ki-cross').show();
            } else {
                $('.ki-cross').hide();
            }
        });
        

        // Apply Filter
        $('#apply').on('click', function () {
            var selectedRange = $('#kt_daterangepicker_4').val();
            var viewedStatus = $('input[name="viewed-status"]:checked').val();
            var typeStatus = $('input[name="type-status"]:checked').val();

            if (selectedRange) {
                table.column(7)
                    .search(selectedRange)
                    .draw();
            }

            table.column(8) 
                .search(viewedStatus || "")
                .draw();

            table.column(3) 
            .search(typeStatus || "")
            .draw();
        });

        // Reset Filter
        $('button[type="reset"]').on('click', function () {
            $('#kt_daterangepicker_4').val(''); 
            $('.ki-cross').hide();
            $('input[name="viewed-status"]').prop('checked', false);
            $('input[name="type-status"]').prop('checked', false);
            window.LaravelDataTables['order-table']
                .search('')
                .columns().search('')
                .draw();
        });
    });

</script>

{{-- <script>
    
    $(document).ready(function () {

        window.triggerReset = function () {
            $('button[type="reset"]').trigger('click');
        };


        const filters = {
            categories: [],
            ratings: [],
            selling: '',
            offer: '',
            createdAt: '',
            expire: ''
        };

        function updateSelectBoxes() {
            $('#category-select').val(filters.categories).trigger('change'); 
            $('#rating-select').val(filters.ratings).trigger('change'); 
            $('#selling-select').val(filters.selling).trigger('change');
            $('#offer-select').val(filters.offer).trigger('change'); 
            $('#created_at_filter').val(filters.createdAt); 
            $('#expire').val(filters.expire); 
        }

        // Update filters and display tags
        function updateFiltersDisplay() {
            const $filterContainer = $('#active-filters');
            const $resetFilterButton = $('#resetFilter');

            let hasActiveFilters = false;

            $filterContainer.empty(); // Clear existing tags

            // Generate tags for each active filter and set `hasActiveFilters` if applicable
            if (filters.categories && filters.categories.length) {
                $filterContainer.append(createTag('Category'));
                hasActiveFilters = true;
            }

            if (filters.ratings && filters.ratings.length) {
                $filterContainer.append(createTag('Rating'));
                hasActiveFilters = true;
            }

            if (filters.selling) {
                $filterContainer.append(createTag('Selling'));
                hasActiveFilters = true;
            }

            if (filters.offer) {
                $filterContainer.append(createTag('Offer'));
                hasActiveFilters = true;
            }

            if (filters.createdAt) {
                $filterContainer.append(createTag('Created At'));
                hasActiveFilters = true;
            }

            if (filters.expire) {
                $filterContainer.append(createTag('Expire'));
                hasActiveFilters = true;
            }

            // Show or hide the reset filter button based on active filters
            if (hasActiveFilters) {
                $resetFilterButton.show();
            } else {
                $resetFilterButton.hide();
            }
        }


        // Create a tag element
        function createTag(label,) {
            return $(`
                <span class="filter-tag badge badge-light-primary mx-1">
                    ${label}
                </span>
                
            `);
        }

        // Handle tag removal
        $('#active-filters').on('click', '.filter-tag i', function () {
            const $tag = $(this).parent();
            const filterType = $tag.data('filter-type');
            const filterValue = $tag.data('filter-value');

            // Remove the filter value
            if (Array.isArray(filters[filterType])) {
                filters[filterType] = filters[filterType].filter(val => val !== filterValue);
            } else {
                filters[filterType] = '';
            }

            // Update session storage and table
            sessionStorage.setItem('filters', JSON.stringify(filters));
            applyFilters(filters);
            updateFiltersDisplay();
            updateSelectBoxes();
        });

        // Update and save filters on change
        function onFilterChange() {
            filters.categories = $('#category-select').val() || [];
            filters.ratings = $('#rating-select').val() || [];
            filters.selling = $('#selling-select').val() || '';
            filters.offer = $('#offer-select').val() || '';
            filters.createdAt = $('#created_at_filter').val() || '';
            filters.expire = $('#expire').val() || '';

            sessionStorage.setItem('filters', JSON.stringify(filters));
            updateFiltersDisplay();
        }

        // Apply filters to the DataTable
        function applyFilters(filters) {
            const table = window.LaravelDataTables['product-table'];

            table.column('category_id:name').search(filters.categories.join('|'), true, false).draw();
            table.column('rating:name').search(filters.ratings.join('|'), true, false).draw();
            table.column('selling:name').search(filters.selling).draw();
            table.column('base_price:name').search(filters.offer).draw();
            table.column('created_at:name').search(filters.createdAt).draw();
            table.column('expire_date:name').search(filters.expire).draw();
        }

        // Initialize filters from session storage
        const storedFilters = JSON.parse(sessionStorage.getItem('filters'));
        if (storedFilters) {
            Object.assign(filters, storedFilters);
            updateFiltersDisplay();
            updateSelectBoxes(); // Sync select boxes
            applyFilters(filters);
        }

        // Listen to filter changes
        $('#category-select, #rating-select, #selling-select, #offer-select, #created_at_filter, #expire').on('change', onFilterChange);

        // Reset filters
        $('button[type="reset"]').on('click', function () {
            $('#category-select').val(null).trigger('change'); 
            $('#rating-select').val(null).trigger('change'); 
            $('#selling-select').val(null).trigger('change'); 
            $('#offer-select').val(null).trigger('change'); 
            $('#created_at_filter').val('');
            // $('.form-check-input').prop('checked', false); 
            const flatpickrInstance = $('#created_at_filter').flatpickr();
            flatpickrInstance.clear();

            window.LaravelDataTables['product-table']
                .search('')
                .columns().search('')
                .draw();

            Object.keys(filters).forEach(key => {
                if (Array.isArray(filters[key])) {
                    filters[key] = [];
                } else {
                    filters[key] = '';
                }
            });

            sessionStorage.removeItem('filters');
            updateFiltersDisplay();
            updateSelectBoxes();
            applyFilters(filters);
        });
    });


</script> --}}