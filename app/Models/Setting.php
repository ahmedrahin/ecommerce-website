<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'fav_icon', 'site_title', 'number1', 'number2', 'email', 'state', 'address', 'facebook', 'instagram', 'youtube', 'whatsapp'];
}
