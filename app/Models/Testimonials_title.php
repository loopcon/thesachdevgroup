<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonials_title extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'testimonials_title',
        'testimonials_title_color',
        'testimonials_title_font_size',
        'testimonials_title_font_family',
    ];
}
