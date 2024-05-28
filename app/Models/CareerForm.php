<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CareerForm extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'career_form';
    protected $fields = ['business_id','showroom_id','service_center_id','body_shop_id','first_name','last_name','email','contact_no','post_apply_for','resume'];

    public function businessDetail()
    {
        return $this->belongsTo(OurBusiness::class,'business_id');
    }

    public function showroomDetail()
    {
        return $this->belongsTo(Showroom::class,'showroom_id');
    }

    public function serviceCenterDetail()
    {
        return $this->belongsTo(ServiceCenter::class,'service_center_id');
    }

    public function bodyShopDetail()
    {
        return $this->belongsTo(Body_shop::class,'body_shop_id');
    }
}
