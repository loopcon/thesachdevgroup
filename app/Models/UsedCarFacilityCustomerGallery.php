<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCarFacilityCustomerGallery extends Model
{
    use HasFactory;
    protected $table = 'used_car_facilities_and_customer_gallery';
    protected $fields = ['used_car_id','facility_image','customer_gallery_image'];

    public function usedCarDetail()
    {
        return $this->belongsTo(Used_car::class,'used_car_id');
    }
}
