<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Body_shop extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'business_id',
        'image',
        'name',
        'slug',
        'name_color',
        'name_font_size',
        'name_font_family',
        'link',
        'rating',
        'number_of_rating',
        'address',
        'address_font_size',
        'address_font_family',
        'address_font_color',
        'email',
        'email_font_size',
        'email_font_family',
        'email_font_color',
        'contact_number',
        'contact_font_size',
        'contact_font_family',
        'contact_font_color',
        'map_link',
    ];
}
