<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'career';
    protected $fields = ['banner_image', 'offer_main_title', 'offer_main_title_color', 'offer_main_title_font_size', 'offer_main_title_font_family', 'offer_first_icon', 'offer_first_title', 'offer_first_title_color', 'offer_first_title_font_size', 'offer_first_title_font_family', 'offer_first_description', 'offer_first_description_font_size', 'offer_first_description_font_family', 'offer_first_description_font_color', 'offer_second_icon', 'offer_second_title', 'offer_second_title_color', 'offer_second_title_font_size', 'offer_second_title_font_family', 'offer_second_description', 'offer_second_description_font_color', 'offer_second_description_font_size', 'offer_second_description_font_family', 'offer_third_icon', 'offer_third_title', 'offer_third_title_color', 'offer_third_title_font_size', 'offer_third_title_font_family', 'offer_third_description', 'offer_third_description_font_color', 'offer_third_description_font_size', 'offer_third_description_font_family', 'vacancy_title', 'vacancy_title_color', 'vacancy_title_font_size', 'vacancy_title_font_family', 'vacancy_sub_title', 'vacancy_sub_title_color', 'vacancy_sub_title_font_size', 'vacancy_sub_title_font_family'];
}
