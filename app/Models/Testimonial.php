<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'name_color',
        'name_font_size',
        'name_font_family',
        'name_background_color',
        'description',
        'description_color',
        'description_font_size',
        'description_font_family',
    ];
}
