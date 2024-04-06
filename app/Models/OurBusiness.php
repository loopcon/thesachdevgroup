<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurBusiness extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'our_business';
    protected $fields = ['title', 'slug', 'description', 'banner_image', 'url', 'page_link', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family', 'why_choose_title', 'why_choose_title_color', 'why_choose_title_font_size', 'why_choose_title_font_family', 'why_choose_image', 'why_choose_description', 'why_choose_description_color', 'why_choose_description_font_size', 'why_choose_description_font_family'];
}
