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
        'our_story_image',
        'our_story_title',
        'our_story_description',
        'our_mission_title',
        'our_mission_description',
        'our_vision_title',
        'our_vision_description',
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
