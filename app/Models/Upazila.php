<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upazila extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    
    // district
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}