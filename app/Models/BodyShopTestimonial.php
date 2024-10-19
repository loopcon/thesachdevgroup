<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyShopTestimonial extends Model
{
    use HasFactory;
    protected $table = 'body_shop_testimonial';
    protected $fields = ['body_shop_id','name','name_font_size','name_font_family','name_font_color','name_background_color','description','description_text_size','description_text_color','description_font_family','image'];

    public function bodyShopDetail()
    {
        return $this->belongsTo(Body_shop::class,'body_shop_id');
    }
}
