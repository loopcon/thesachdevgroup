<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowroomTestimonial extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'showroom_testimonial';
    protected $fields = ['image', 'name', 'showroom_id', 'description','name_text_size','name_text_color','name_font_family','name_background_color','description_text_size','description_text_color','description_font_family'];

    public function showroomDetail()
    {
        return $this->belongsTo(Showroom::class, 'showroom_id');
    }
}
