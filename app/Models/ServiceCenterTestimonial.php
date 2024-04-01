<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCenterTestimonial extends Model
{
    use HasFactory;
    protected $table = 'service_center_testimonial';
    protected $field = ['service_center_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'image', 'description_font_family'];

    public function serviceCenterDetail()
    {
        return $this->belongsTo(ServiceCenter::class, 'service_center_id');
    }
}
