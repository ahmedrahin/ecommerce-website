<div class="d-flex align-items-center">
    <!--begin::Thumbnail-->
    <span class="symbol symbol-50px">
        @php
            $imagePath = $subcategory->image ? $subcategory->image : 'uploads/blank-image.svg'; 
            $imageUrl = asset($imagePath);
        @endphp
        <span class="symbol-label" style="background-image:url({{$imageUrl}});"></span>
    </span>
    <!--end::Thumbnail-->
    <div class="ms-5">
        <!--begin::Title-->
        <span class="text-gray-800 fs-5 fw-bold mb-1">{{$subcategory->name}}</span>
        <!--end::Title-->
        <!--begin::Description-->
        <?php
            $description = trim($subcategory->description);

            if (!empty($description)) {
                $words = explode(' ', $description);
                $limitedDescription = count($words) > 80 
                    ? implode(' ', array_slice($words, 0, 80)) . '...' 
                    : $description;
            } else {
                $limitedDescription = '';
            }
        ?>
        <div class="text-muted fs-7 fw-bold">{!! $limitedDescription !!}</div>
        <!--end::Description-->
    </div>
</div>

<!-- details modal -->

