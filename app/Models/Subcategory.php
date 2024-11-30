<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'category_id', 'slug', 'description', 'status', 'image'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($subcategory) {
            // Soft delete related category
            $subcategory->subsubcategories()->delete();
        });

        // Restore related subcategory when an attribute is restored
        static::restoring(function ($subcategory) {
            $subcategory->subsubcategories()->restore();
        });

        // Before saving the category, generate the slug if the name has changed
        static::saving(function ($subcategory) {
            if ($subcategory->isDirty('name')) {
                $subcategory->slug = $subcategory->generateUniqueSlug($subcategory->name, $subcategory->id);
            }
        });
    }

    private function generateUniqueSlug($name, $id = 0)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Subcategory::where('slug', $slug)->where('id', '!=', $id )->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    
    /**
     * Get the category that owns the subcategory.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the subsubcategories for the subcategory.
     */
    public function subsubcategories()
    {
        return $this->hasMany(Subsubcategory::class);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

}
