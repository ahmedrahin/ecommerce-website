<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

   
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function subsubcategory()
    {
        return $this->belongsTo(Subsubcategory::class);
    }

    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function productStock()
    {
        return $this->hasMany(ProductStock::class);
    }

    
    
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public static function boot()
    {
        parent::boot();

        // Before saving the product, generate the slug if the name has changed
        static::saving(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = $product->generateUniqueSlug($product->name, $product->id);
            }
        });

        // Before deleting the product, delete related product options
        static::deleting(function ($product) {
            $product->productStock()->delete();
        });
    }

    private function generateUniqueSlug($name, $id = 0)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Product::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        
        return $slug;
    }

    public function scopeActiveProducts($query)
    {
        return $query->whereIn('status', [1, 3])
                     ->where(function ($query) {
                         $query->whereNull('publish_at')
                               ->orWhere('publish_at', '<=', Carbon::now());
                     })
                     ->where(function ($query) {
                         $query->whereNull('expire_date')
                               ->orWhere('expire_date', '>', Carbon::now());
                     });
    }
}