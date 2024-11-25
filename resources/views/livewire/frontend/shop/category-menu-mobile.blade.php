<footer class="mobile-nav-footer">
    <section class="section-b-space footer-1">
        <div class="custom-container">
            <div class="row">
                <div class="col offset-xl-1">
                    <div class="footer-content">
                        <div>
                            <div class="footer-title d-md-block">
                                <a href="{{ route('shop') }}" style="font-weight: 500; font-size: 14px;" 
                                   class="{{ request()->fullUrlIs(route('shop')) ? 'active' : '' }}">
                                   All Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="footer-content">
                        <div>
                            @foreach($categories as $category)
                                @php
                                    $currentCategoryId = request()->input('categories')[0] ?? null;
                                    $isOpen = $currentCategoryId == $category->id || $category->subcategories->contains('id', $currentCategoryId);
                                @endphp
                                <div class="footer-title d-md-block {{ $isOpen ? 'open' : '' }}">
                                    @if($category->subcategories->count() > 0)
                                        <h5 class="{{ $currentCategoryId == $category->id ? 'active' : '' }}">{{ $category->name }}</h5>
                                    @else
                                        <a class="cat-title {{ $currentCategoryId == $category->id ? 'active' : '' }}" 
                                        href="{{ url('/shop') }}?categories[0]={{ $category->id }}">
                                            {{ $category->name }}
                                        </a>
                                    @endif
                                    <ul class="footer-details accordion-hidden">
                                        @if($category->subcategories->count() > 0)
                                            <li>
                                                <a class="nav {{ $currentCategoryId == $category->id ? 'active' : '' }}" 
                                                href="{{ url('/shop') }}?categories[0]={{ $category->id }}">
                                                    Show all
                                                </a>
                                            </li>
                                        @endif
                                        @foreach($category->subcategories as $subcategory)
                                            <li>
                                                <a class="nav {{ $currentCategoryId == $subcategory->id ? 'active' : '' }}" 
                                                href="{{ url('/shop') }}?categories[0]={{ $subcategory->id }}">
                                                    {{ $subcategory->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>
