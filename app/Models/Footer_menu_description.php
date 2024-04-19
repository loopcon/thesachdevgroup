<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Footer_menu_description extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'description',
        'description_color',
        'description_font_size',
        'description_font_family',
    ];
}
