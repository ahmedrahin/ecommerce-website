<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Product Details</h2>
        </div>
    </div>
    <div class="card-body pt-0">
        <label class="form-label">Brand</label>
        <select name="brand_id" data-control="select2" class="form-select form-select-solid mb-5" data-placeholder="Select a brand" data-allow-clear="true">
            <option value="">Select a brand</option>
            @foreach($brands ?? [] as $brand)
                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }} >{{ $brand->name }}</option>
            @endforeach
        </select>
        <span id="brand_id" class="text-danger"></span>
    
        <label class="form-label">Category</label>
        <select name="category_id" id="category_id_item" data-control="select2" class="form-select form-select-solid mb-5" data-placeholder="Select a category">
            <option></option>
            @foreach($categories ?? [] as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
            @endforeach
        </select>
        <span id="category_id" class="text-danger"></span>

        <label class="form-label">Subcategory</label>
        <select name="subcategory_id" id="subcategory_id_item" data-control="select2" class="form-select form-select-solid mb-5" data-placeholder="Select a subcategory" data-allow-clear="true">
            <option></option>
        </select>
        <span id="subcategory_id" class="text-danger"></span>

        <label class="form-label">Subsubcategory</label>
        <select name="subsubcategory_id" id="subsubcategory_id_item" data-control="select2" class="form-select form-select-solid mb-5" data-placeholder="Select a subsubcategory" data-allow-clear="true">
            <option></option>
        </select>
        <span id="subsubcategory_id" class="text-danger"></span>

        <label class="form-label">Product Status</label>
        <select class="form-select form-select-solid" 
        id="product_status" 
        name="status"
        data-control="select2"
        data-placeholder="Select a status">
            <option></option>
            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        <span id="status" class="text-danger"></span>
        
        <label class="form-label d-block">Tags</label>
        <input id="kt_tagify_for_product" class="form-control mb-2" value="{{ json_encode($tagItem) }}" />
        <span id="tags" class="text-danger"></span>
        <h2></h2>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        const selectElements = ['#product_status', '#discount_type'];

        selectElements.forEach(selector => {
            $(selector).select2({
                minimumResultsForSearch: Infinity
            });
        });
        
        var selectedCategoryId = $('#category_id_item').val();
        var selectedSubcategoryId = "{{ $product->subcategory_id }}";
        var selectedSubsubcategoryId = "{{ $product->subsubcategory_id }}";

        // If there's a selected category, fetch subcategories
        if (selectedCategoryId) {
            updateSelectOptions(selectedCategoryId, '#subcategory_id_item', '/get-subcategories/', function() {
                $('#subcategory_id_item').val(selectedSubcategoryId).trigger('change');
            });
        }

        // Event listener for when the category selection changes
        $('#category_id_item').on('change', function() {
            var categoryId = $(this).val();
            updateSelectOptions(categoryId, '#subcategory_id_item', '/get-subcategories/', function() {
                $('#subcategory_id_item').trigger('change');
            });
        });

        // Event listener for when the subcategory selection changes
        $('#subcategory_id_item').on('change', function() {
            var subcategoryId = $(this).val();
            updateSelectOptions(subcategoryId, '#subsubcategory_id_item', '/get-subsubcategories/', function() {
                $('#subsubcategory_id_item').val(selectedSubsubcategoryId).trigger('change');
            });
        });

        // If there's a selected subcategory, fetch subsubcategories
        if (selectedSubcategoryId) {
            updateSelectOptions(selectedSubcategoryId, '#subsubcategory_id_item', '/get-subsubcategories/', function() {
                $('#subsubcategory_id_item').val(selectedSubsubcategoryId).trigger('change');
            });
        }

        // Initialize Tagify script on the above inputs
        var input = document.querySelector("#kt_tagify_for_product");
        
        input.addEventListener('change', function(){
            this.setAttribute('name', 'tags');
        })
        
        new Tagify(input, {
            whitelist: @json($tags),
            maxTags: 10,
            dropdown: {
                maxItems: 20,
                classname: "tagify__inline__suggestions",
                enabled: 0,
                closeOnSelect: false
            }
        });
    });
    
    // Function to update the options of a select element based on an ID and a URL
    function updateSelectOptions(id, selectElementId, url, callback) {
        if (id) {
            $.ajax({
                url: url + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var $select = $(selectElementId);
                    $select.empty().append('<option></option>');
                    $.each(data, function(key, value) {
                        $select.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    if (callback) callback();
                }
            });
        } else {
            $(selectElementId).empty();
        }
    }
</script>
@endpush