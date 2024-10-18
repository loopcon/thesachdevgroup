<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCarTestimonial extends Model
{
    use HasFactory;
    protected $table = 'used_car_testimonial';
    protected $fields = ['used_car_id','name','name_font_size','name_font_family','name_font_color','name_background_color','description','description_text_size','description_text_color','description_font_family','image'];

    public function usedCarDetail()
    {
        return $this->belongsTo(Used_car::class,'used_car_id');
    }
}
