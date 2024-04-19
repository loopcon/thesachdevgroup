<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Home_detail extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'title',
        'sub_title',
        'title_color',
        'title_font_size',
        'title_font_family',
        'sub_title_color',
        'sub_title_font_size',
        'sub_title_font_family',
        'description',
        'description_color',
        'description_font_size',
        'description_font_family',
    ];
}
