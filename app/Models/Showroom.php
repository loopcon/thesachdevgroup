<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showroom extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'our_business_id',
        'slider_image',
        'slider_showroom_name',
        'slider_showroom_name_color',
        'slider_showroom_name_font_size',
        'slider_showroom_name_font_family',
        'image',
        'name',
        'name_color',
        'name_font_size',
        'name_font_family',
        'brand_id',
        'car_id',
        'address',
        'working_hours',
        'contact_number',
        'email',
        'address_color',
        'address_font_size',
        'address_font_family',
        'address_icon',
        'working_hours_color',
        'working_hours_font_size',
        'working_hours_font_family',
        'working_hours_icon',
        'contact_number_color',
        'contact_number_font_size',
        'contact_number_font_family',
        'contact_number_icon',
        'email_color',
        'email_font_size',
        'email_font_family',
        'email_icon',
        'rating',
        'number_of_rating',
        'description',
        'description_color',
        'description_font_size',
        'description_font_family',
    ];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function car(){
        return $this->hasMany(Car::class,'id');
    }

    public function our_business(){
        return $this->belongsTo(OurBusiness::class,'our_business_id');
    }
}
