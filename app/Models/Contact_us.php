<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact_us extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'title_color',
        'title_font_size',
        'title_font_family',
        'sub_title',
        'sub_title_color',
        'sub_title_font_size',
        'sub_title_font_family',
        'form_title',
        'form_title_color',
        'form_title_font_size',
        'form_title_font_family',
        'form_sub_title',
        'form_sub_title_color',
        'form_sub_title_font_size',
        'form_sub_title_font_family',
    ];
}
