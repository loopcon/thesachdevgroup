<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Our_location extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'title_color',
        'title_font_size',
        'title_font_family',
    ];
}
