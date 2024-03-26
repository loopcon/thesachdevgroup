<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Home_slider extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'title_color',
        'title_font_size',
        'title_font_family',
        'sub_title_color',
        'sub_title_font_size',
        'sub_title_font_family',
        'text_position',
    ];
}
