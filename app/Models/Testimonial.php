<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'testimonials_title',
        'testimonials_title_color',
        'testimonials_title_font_size',
        'testimonials_title_font_family',
        'name',
        'image',
        'name_background_color',
        'name_color',
        'name_font_size',
        'name_font_family',
        'description',
        'description_color',
        'description_font_size',
        'description_font_family',
    ];
}
