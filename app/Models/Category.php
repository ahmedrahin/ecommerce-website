<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'status', 'image'
    ];

    public static function boot()
    {
        parent::boot();

       // Soft delete related subcategories and their sub-subcategories
        static::deleting(function ($category) {
            foreach ($category->subcategories as $subcategory) {
                // Soft delete subcategory's sub-subcategories
                $subcategory->subSubcategories()->delete();

                // Soft delete the subcategory itself
                $subcategory->delete();  
            }
        });

        static::restoring(function ($category) {
            // Loop through each subcategory
            foreach ($category->subcategories()->withTrashed()->get() as $subcategory) {
                // Restore subcategory's sub-subcategories
                $subcategory->subSubcategories()->withTrashed()->restore(); 

                $subcategory->restore(); 
            }
        });

        // Before saving the category, generate the slug if the name has changed
        static::saving(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = $category->generateUniqueSlug($category->name, $category->id);
            }
        });
    }

    private function generateUniqueSlug($name, $id = 0)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Category::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    /**
     * Get the subcategories for the category.
     */
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    // get product summareice
    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
