<div>
    @if($isInWishlist)
        <li><a href="javascript:void(0)" wire:click="$emit('removeFromWishlist', {{ $productId }})"> <i class="fa-solid fa-heart me-2" style="color: #ff00008a;"></i>Remove from Wishlist</a></li>
    @else
        <li><a href="javascript:void(0)" wire:click="$emit('get_id', {{ $productId }})"> <i class="fa-regular fa-heart me-2"></i>Add To Wishlist</a></li>
    @endif
    
</div>
