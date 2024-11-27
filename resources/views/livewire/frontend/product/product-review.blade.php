<div class="row gy-4" wire:poll.visible.15000ms>
    <div class="col-lg-4">
      <div class="review-right">
        <div class="customer-rating">
         @if( $reviews->count() > 0 )
          <div class="global-rating">
              <div>
                <h5>
                    {{ceil($reviews->avg('rating'))}}
                </h5>
              </div>
              <div>
                <h6>Average Ratings</h6>
                @php
                    $averageRating = round($reviews->avg('rating'), 1);
                    $fullStars = floor($averageRating);
                    $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar; 
                @endphp

                <ul class="rating p-0 mb">
                    <!-- Full stars -->
                    @for ($i = 0; $i < $fullStars; $i++)
                        <li><i class="fa-solid fa-star"></i></li>
                    @endfor

                    <!-- Half star if needed -->
                    @if ($halfStar)
                        <li><i class="fa-solid fa-star-half-alt"></i></li>
                    @endif

                    <!-- Empty stars -->
                    @for ($i = 0; $i < $emptyStars; $i++)
                        <li><i class="fa-regular fa-star"></i></li>
                    @endfor

                    <!-- Review count -->
                    <li><span>({{ $reviews->count() }})</span></li>
                </ul>

              </div>
            </div>
          @else
            <div class="global-rating">
              <div>
                <h5>0</h5>
              </div>
              <div>
                <h6>Average Ratings</h6>
                <ul class="rating p-0 mb">
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><span>(0)</span></li>
                </ul>
              </div>
            </div>
         @endif
         @if(Auth::check() && $userReview)
            <div class="submited-review">
                <h4>You already submitted your review for this product</h4>
                <ul>
                    <li class="d-flex gap-1">
                        <label>Your rating:</label>
                        <ul class="rating p-0 mb">
                            @for ($i = 1; $i <= 5; $i++)
                                <li>
                                    <i class="{{ $i <= $userReview->rating ? 'fa-solid fa-star' : 'fa-regular fa-star' }}"></i>
                                </li>
                            @endfor
                            <li><span>({{ $userReview->rating }})</span></li>
                        </ul>
                    </li>
                    <li>
                        <label class="mb-0">Your comment:</label>
                        <p>{{ $userReview->comment }}</p>
                    </li>
                </ul>
                <button wire:click="delete({{$userReview->id}})" class="delete-review">
                  <i class="bi bi-trash3"></i>
                </button>
            </div>
        @else
            @if( config('website_settings.allow_guest_reviews') == true )
              <button class="btn reviews-modal" data-bs-toggle="modal" data-bs-target="#Reviews-modal" title="Write your review" tabindex="0">Write a review</button>
            @elseif( !Auth::check() )
              <div class="alert alert-danger mt-3">
                <a href="{{route('user.login')}}" style="text-decoration: underline;">Log in</a> at first to write a review
              </div>
            @else
              <button class="btn reviews-modal" data-bs-toggle="modal" data-bs-target="#Reviews-modal" title="Write your review" tabindex="0">Write a review</button>
            @endif
        @endif
        </div>
      </div>
    </div>
    <div class="col-lg-8"> 
      <div class="comments-box"> 
        <h5>Comments ({{ $reviews->count() }}) </h5>
        <ul class="theme-scrollbar"> 
          @if( $reviews->count() > 0 )
            @foreach( $reviews as $review )
              <li style="width: 90%;"> 
                <div class="comment-items"> 
                  @php
                    
                    $imgUrl = !is_null($review->user_id) && !is_null($review->user->avatar) ? $review->user->avatar : 'uploads/user.png';
                    $rating = $review->rating;
                    $fullStars = floor($rating); 
                    $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0; 
                    $emptyStars = 5 - $fullStars - $halfStar; 
                  @endphp
                  <div class="user-img"> <img src="{{asset($imgUrl)}}" alt=""></div>
                  <div class="user-content"> 
                    <div class="user-info"> 
                      <div class="d-flex justify-content-between gap-3"> 
                        <h6> <i class="iconsax" data-icon="user-1"></i>{{$review->name}}</h6>
                        <span>
                            <i class="iconsax" data-icon="clock"></i>
                            @if ($review->created_at->diffInDays() > 10)
                                {{ $review->created_at->format('M d, Y') }}
                            @else
                                {{ $review->created_at->diffForHumans() }}
                            @endif
                        </span>
                      
                      </div>
                      <ul class="rating p-0 mb">
                       <!-- Full stars -->
                        @for ($i = 0; $i < $fullStars; $i++)
                          <li><i class="fa-solid fa-star"></i></li>
                        @endfor

                        <!-- Half star -->
                        @if ($halfStar)
                            <li><i class="fa-solid fa-star-half-alt"></i></li>
                        @endif

                        <!-- Empty stars -->
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <li><i class="fa-regular fa-star"></i></li>
                        @endfor

                      </ul>
                    </div>
                    <p>{{$review->comment}}</p>
                  </div>
                </div>
              </li>
            @endforeach
          @else 
              <span style="color: #ff6b6b;font-weight: 700;font-size: 15px;font-style: italic;">No comment found in this product!</span>
          @endif
        </ul>
      </div>
    </div>

    {{-- modal --}}
    <div class="customer-reviews-modal modal theme-modal fade" id="Reviews-modal" tabindex="-1" role="dialog" aria-modal="true" wire:ignore.self>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Write A Review</h4>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

              <div class="modal-body pt-0">
                
                <form wire:submit.prevent="submit">
                  <div class="row g-3">
                    <div class="col-12"> 
                      <div class="reviews-product"> 
                        <div> <img src="{{asset($product->thumb_image)}}" alt="">
                          <div> 
                            <h5>{{$product->name}}</h5>
                            <p>
                              {{$product->offer_price}}৳
                              @if( $product->discount_option == 2 || $product->discount_option == 3 )
                                <del class="text-danger">{{$product->base_price}}৳</del>
                              @endif
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12"> 
                      <div class="customer-rating">
                        <label class="form-label">Rating :</label>
                        
                        <div class="selectrating" id="star-rating">
                          <input type="radio" name="rating" id="r5" value="5" wire:model="rating">
                          <label for="r5" onclick="setRating(5)"></label>
                      
                          <input type="radio" name="rating" id="r4" value="4" wire:model="rating">
                          <label for="r4" onclick="setRating(4)"></label>
                      
                          <input type="radio" name="rating" id="r3" value="3" wire:model="rating">
                          <label for="r3" onclick="setRating(3)"></label>
                      
                          <input type="radio" name="rating" id="r2" value="2" wire:model="rating">
                          <label for="r2" onclick="setRating(2)"></label>
                      
                          <input type="radio" name="rating" id="r1" value="1" wire:model="rating">
                          <label for="r1" onclick="setRating(1)"></label>
                      </div>
                        @error('rating')
                          <div class="text-danger mt-1">{{$message}}</div>
                        @enderror
  
                      </div>
                    </div>

                    <div class="row g-3" style="{{ Auth::check() ? 'display:none;' : '' }} margin-top:-15px;">
                      <div class="col-md-6">
                        <div class="from-group"> 
                          <label class="form-label">Name :</label>
                          <input type="text" class="form-control @error('name') error-border @enderror" name="name" placeholder="Your name" wire:model="name">
                          @error('name')
                            <div class="text-danger mt-1">{{$message}}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="from-group"> 
                          <label class="form-label">Email :</label>
                          <input type="text" class="form-control @error('email') error-border @enderror" name="name" placeholder="Enter email" wire:model="email">
                          @error('email')
                            <div class="text-danger mt-1">{{$message}}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-12 mt-2">    
                      <div class="from-group"> 
                        <label class="form-label">Review Content :</label>
                        <textarea class="form-control @error('comment') error-border @enderror" id="comment" cols="30" rows="4" placeholder="Write your comments here..." wire:model="comment"></textarea>
                        @error('comment')
                          <div class="text-danger mt-1">{{$message}}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="modal-button-group">
                      <button class="btn btn-cancel cancel-modal-review" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                      <button class="btn btn-submit" type="submit">
                        <span wire:loading.remove wire:target="submit">Submit</span>
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </span>
                    </button>
                    </div>
                  </div>
                </form>

              </div>
            
          </div>
        </div>
      </div>
</div>
