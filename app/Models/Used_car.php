<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Used_car extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'slug',
        'name_color',
        'name_font_size',
        'name_font_family',
        'link',
        'rating',
        'number_of_rating',
    ];
}
