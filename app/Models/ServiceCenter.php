<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCenter extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'service_center';
    protected $fields = ['service_id', 'business_id', 'name', 'name_color', 'name_font_size'. 'name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_icon', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_icon', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_icon', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_icon', 'email_font_size', 'email_font_family', 'email_font_color'];

    public function serviceDetail()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function businessDetail()
    {
        return $this->belongsTo(OurBusiness::class, 'business_id');
    }
}
