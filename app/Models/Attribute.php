<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['attr_name', 'status'];

    public function AttributeValue(){
        return $this->hasMany(AttributeValue::class, 'attr_id');
    }

    // Add a model event to handle related records on deletion
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($attribute) {
            // Soft delete related attribute values
            $attribute->AttributeValue()->delete();
        });

        // Restore related attribute values when an attribute is restored
        static::restoring(function ($attribute) {
            $attribute->values()->AttributeValue()->restore();
        });
    }
}
