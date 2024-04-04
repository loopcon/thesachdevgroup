<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Home_our_businesses extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'businesses_title',
        'businesses_title_color',
        'businesses_title_font_size',
        'businesses_title_font_family',
        'link',
        'background_color',
    ];
}
