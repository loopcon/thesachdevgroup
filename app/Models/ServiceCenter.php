<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCenter extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'service_center';
    protected $fields = ['service_id', 'business_id', 'name', 'name_color', 'name_font_size'. 'name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_icon', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_icon', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_icon', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_icon', 'email_font_size', 'email_font_family', 'email_font_color', 'rating', 'number_of_rating', 'slider_image', 'slider_service_center_name', 'slider_service_center_name_color', 'slider_service_center_name_size', 'slider_service_center_name_font_family','facility_image','customer_gallery_image', 'slug','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','lets_connect_image','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size', 'email_title_font_family'];

    public function serviceDetail()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function service(){
        return $this->hasMany(Service::class,'id');
    }

    public function businessDetail()
    {
        return $this->belongsTo(OurBusiness::class, 'business_id');
    }
}
