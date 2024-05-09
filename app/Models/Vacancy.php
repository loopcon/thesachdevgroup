<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'vacancies';
    protected $fields = ['business_id', 'showroom_id', 'service_center_id', 'body_shop_id', 'used_car_id', 'name', 'name_font_color', 'name_font_size', 'name_font_family', 'description', 'description_front_color', 'description_font_family', 'description_font_size', 'icon', 'image', 'experience', 'work_level', 'employee_type', 'offer_salary','icon_background_color'];

    public function businessDetail()
    {
        return $this->belongsTo(OurBusiness::class, 'business_id');
    }

    public function showroomDetail()
    {
        return $this->belongsTo(Showroom::class, 'showroom_id');
    }

    public function serviceCenterDetail()
    {
        return $this->belongsTo(ServiceCenter::class, 'service_center_id');
    }

    public function bodyShopDetail()
    {
        return $this->belongsTo(Body_shop::class, 'body_shop_id');
    }

    public function usedCarDetail()
    {
        return $this->belongsTo(Used_car::class, 'used_car_id');
    }
}
