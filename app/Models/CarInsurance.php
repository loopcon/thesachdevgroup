<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInsurance extends Model
{
    use HasFactory;
    protected $table = 'car_insurance';
    protected $fields = ['banner_image','title','title_color','title_font_size','title_font_family','brand_id','insurance_form_title','insurance_form_title_color','insurance_form_title_font_size','insurance_form_title_font_family','description','description_font_color','description_font_size','description_font_family'];
}
