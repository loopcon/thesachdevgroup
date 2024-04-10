<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwardBanner extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'award_banner';
    protected $fields = ['award_title', 'award_title_font_size', 'award_title_font_color', 'award_title_font_family', 'banner_image'];
}
