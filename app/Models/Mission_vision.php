<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mission_vision extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'icon',
        'icon_name',
        'slug',
        'title',
        'icon_name_color',
        'icon_name_font_size',
        'icon_name_font_family',
        'title_color',
        'title_font_size',
        'title_font_family',
        'description',
        'description_color',
        'description_font_size',
        'description_font_family',
    ];
}
