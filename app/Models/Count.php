<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Count extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'icon',
        'amount',
        'amount_color',
        'amount_font_size',
        'amount_font_family',
        'name',
        'name_color',
        'name_font_size',
        'name_font_family',
        'background_color',
    ];
}
