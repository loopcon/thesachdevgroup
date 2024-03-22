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
        'description',
        'our_story_image',
        'our_story_title',
        'our_story_description',
        'our_mission_title',
        'our_mission_description',
        'our_vision_title',
        'our_vision_description',
        'color',
        'font_size',
        'font_family',
        'icon',
        'amount',
        'name',
        'count_amount_color',
        'count_name_color',
        'count_background_color',
        'count_amount_font_size',
        'count_name_font_size',
        'count_amount_font_family',
        'count_name_font_family',
    ];
}
