<div class="rating p-0">
    @php
        // Calculate the average rating and prepare star values
        $averageRating = round($reviews->avg('rating'), 1);
        $fullStars = floor($averageRating);
        $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;
    @endphp

    <ul class="">
        <!-- Full stars -->
        @for ($i = 0; $i < $fullStars; $i++)
            <li><i class="fa-solid fa-star"></i></li>
        @endfor

        <!-- Half star if needed -->
        @if ($halfStar)
            <li><i class="fa-solid fa-star-half-stroke"></i></li>
        @endif

        <!-- Empty stars -->
        @for ($i = 0; $i < $emptyStars; $i++)
            <li><i class="fa-regular fa-star"></i></li>
        @endfor

        <!-- Review count -->
        <li><span>({{ $reviews->count() }})</span></li>
    </ul>

</div>
