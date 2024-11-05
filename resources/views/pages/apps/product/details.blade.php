<x-default-layout>

    @section('title') {{ $product->name }} @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('product') }}
    @endsection

    <!-- font awsome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- produc details section start -->

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="" id="kt_app_content_container">
            <div class="card mb-4" style="border: none !important;">
                <div class="px-7 info">
                    <div class="row">
                        <div class="col-md-4 p-0">
                            <div class="product-images">
                                <div class="thumb-img pt-8">
                                    @php
                                        $imagePath = $product->thumb_image ?? 'uploads/blank-image.svg';
                                        $imageUrl = $imagePath;
                                    @endphp
                                    <img src="{{ asset($imageUrl) }}" alt="">
                                </div>
                                <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-4 pb-3 mx-5" style="overflow: hidden;">
                                    @if( $product->galleryImages->count() > 4 )
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">
                                                @foreach ($product->galleryImages ?? [] as $gallery)
                                                    <div class="swiper-slide">
                                                        <img src="{{ asset($gallery->image) }}" width="70" height="70" class="border rounded cursor-pointer" alt="" style="object-fit: cover;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($product->galleryImages ?? [] as $gallery)
                                            <div class="col">
                                                <img src="{{ asset($gallery->image) }}" width="70" height="70" class="border rounded cursor-pointer" alt="">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 p-0">
                            <div class="product-information pt-8">
                                <h2>{{ $product->name }}</h2>
                                <div class="rating my-4">
                                    <div class="rating-label checked">
                                        <i class="ki-duotone ki-star fs-6"></i>
                                    </div>
                                    <div class="rating-label checked">
                                        <i class="ki-duotone ki-star fs-6"></i>
                                    </div>
                                    <div class="rating-label checked">
                                        <i class="ki-duotone ki-star fs-6"></i>
                                    </div>
                                    <div class="rating-label">
                                        <i class="ki-duotone ki-star fs-6"></i>
                                    </div>
                                    <div class="rating-label">
                                        <i class="ki-duotone ki-star fs-6"></i>
                                    </div>
                                    <span>0 reviews</span>
                                </div>
                                <div class="order-info mb-2">
                                    <ul>
                                        <li>
                                            0 Orders
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                            0 Wishlist
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                            0 Cart
                                            <i class="bi bi-bag-check-fill"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-price">
                                    <h4>
                                        @if( !is_null($product->offer_price) )
                                            ৳{{ $product->offer_price }}
                                            <span class="text-danger" style="font-weight: 600;">
                                                <del>৳{{ formatPrice($product->base_price) }}</del>
                                                {{ formatPrice($product->discount_percentage_or_flat_amount) }}{{ $product->discount_option == 2 ? '%' : '' }} off
                                            </span>
                                        @endif
                                    </h4>
                                </div>
                                
                                <div class="short-description mb-3">
                                    @if( !is_null( $product->short_description) && ( $product->short_description != '<p><br></p>') )
                                        {!! $product->short_description !!}
                                    @endif
                                </div>
                                
                                <div class="product-details">
                                    <h3>General Information</h3>
                                    <dl class="row">
                                        <dt class="col-sm-3">Sku code:</dt>
                                        <dd class="col-sm-9">{{ $product->sku_code }}</dd>
                                    
                                        <dt class="col-sm-3">Category:</dt>
                                        <dd class="col-sm-9">
                                            @if ($product->category)
                                                {!! $product->category->name !!}
                                                @if ($product->subcategory)
                                                    -> {!! $product->subcategory->name !!}
                                                    @if ($product->subsubcategory)
                                                        -> {!! $product->subsubcategory->name !!}
                                                    @endif
                                                @endif
                                            @else
                                                <span class="no">Uncategorized</span>
                                            @endif
                                        </dd>


                                    
                                        <dt class="col-sm-3">Brand:</dt>
                                        <dd class="col-sm-9">{{ $product->brand->name ?? 'N/A' }}</dd>
                                
                                        <dt class="col-sm-3">Quantity:</dt>
                                        <dd class="col-sm-9">
                                            @if ($product->quantity > 0)
                                                <span class="text-success">{{ $product->quantity }} pcs</span>
                                            @else
                                                <span class="text-danger p-0">Out of stock!</span>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>       
                                                
                                <div class="product-variant mb-8">
                                    @php 
                                        $productStocks = $product->productStock ?? collect(); 
                                        $attributesList = $attributes->keyBy('id'); 
                                        $attributesValuesList = $attributesValues->keyBy('id'); 
                                        $groupedAttributes = []; 
                                    @endphp

                                    @if($productStocks->isNotEmpty())
                                        <h3>Product Variant</h3>

                                        <dl class="row align-items-center">
                                            @foreach ($productStocks as $productStock)
                                                @php 
                                                     $attributeOptions = $productStock->attributeOptions; 
                                                @endphp

                                                @foreach ($attributeOptions as $attributeOption)
                                                    @php
                                                        $groupedAttributes[$attributeOption->attribute_id][] = $attributesValuesList[$attributeOption->attribute_value_id]->attr_value ?? '';
                                                    @endphp
                                                @endforeach
                                            @endforeach

                                            @foreach ($groupedAttributes as $attribute_id => $attributeValues)
                                                <dt class="col-sm-3">
                                                    {{ $attributesList[$attribute_id]->attr_name ?? '' }}:
                                                </dt>
                                                <dd class="col-sm-9">
                                                    @php
                                                        $wrappedAttributeValues = array_map(function($value) {
                                                            return "<span>$value</span>";
                                                        }, array_unique($attributeValues));
                                                    @endphp
                                                    {!! implode('', $wrappedAttributeValues) !!}
                                                </dd>
                                            @endforeach
                                        </dl>
                                    @else
                                        <span class="text-danger p-0" style="font-style: italic;font-weight: 600;">No variant found in this product.</span>
                                    @endif

                                </div>

                                 {{-- <div class="color-indigator-item bg-primary" style="background-color: #000 !important"></div>  --}}
                                <div class="d-flex justify-content-center btn-item">
                                    
                                        <a href="" class="btn btn-light-primary me-2" target="_blank">
                                            <i class="fa fa-globe" aria-hidden="true" style="font-size: 15px;"></i>
                                            View Main
                                        </a>
                                        <a href="{{route('product-management.edit', $product->id)}}" class="btn btn-primary">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            Edit
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- product status -->
                 <div class="status">
                    <span class="badge badge-light-{{ $product->status == 1 ? 'success' : 'danger'}}">{{ $product->status == 1 ? 'Active' : 'Inactive'}}</span>
                 </div>

                <!-- tab -->
                <div class="mb-5 tab-section">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                <i class="bi bi-chat-left-text"></i>
                                Product Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                <i class="bi bi-bookmark-check"></i>
                                Tags
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                <i class="bi bi-star"></i>
                                Reviews
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @if( !is_null( $product->long_description) && ( $product->long_description != '<p><br></p>') )
                                {!! $product->long_description !!}
                            @else
                                <span class="no">No description found in this product.</span>
                            @endif
                        </div>
                        <div class="tab-pane tags fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @if($product->tags->count() > 0)
                                <dd class="col-sm-9">
                                    @foreach($product->tags ?? [] as $tag)
                                        <span>{{ $tag->name }}</span>
                                    @endforeach
                                </dd>
                            
                            @else
                                <div class="no">No tags found in this product!</div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="allReview">
                                <ul>
                                    <li>
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png" alt="">
                                    </li>
                                    <li class="messageItem">
                                        <span>Rahin Ahmed</span>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, at.</p>
                                        <div class="rating">
                                            <div class="rating-label checked">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                            <div class="rating-label checked">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                            <div class="rating-label checked">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                            <div class="rating-label">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                            <div class="rating-label">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                        </div>
                                        <div class="date">
                                            Jul-31,2024
                                        </div>
                                     </li>
                                </ul>
                            </div>
                            <div class="allReview">
                                <ul>
                                    <li>
                                        <img src="https://avatars.githubusercontent.com/u/22705639?v=4" alt="">
                                    </li>
                                    <li class="messageItem">
                                        <span>Md Khairul Uddin</span>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, at.</p>
                                        <div class="rating">
                                            <div class="rating-label checked">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                            <div class="rating-label checked">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                            <div class="rating-label checked">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                            <div class="rating-label">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                            <div class="rating-label">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                        </div>
                                        <div class="date">
                                            Jul-31,2019
                                        </div>
                                     </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- produc details section end -->
    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 4, // Show 4 images at a time
                spaceBetween: 1, // Space between slides
                loop: false, // Disable looping
            });
            $('.d-flex.align-items-center.gap-2.gap-lg-3').html(`<a href="{{ route('product-management.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left fs-2"></i>
                    All Product
                </a>`)
        </script>
    @endpush
</x-default-layout>