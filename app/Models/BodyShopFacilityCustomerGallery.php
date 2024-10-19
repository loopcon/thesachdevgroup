<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyShopFacilityCustomerGallery extends Model
{
    use HasFactory;
    protected $table = 'body_shop_facilities_and_customer_gallery';
    protected $fields = ['body_shop_id','facility_image','customer_gallery_image'];

    public function bodyShopDetail()
    {
        return $this->belongsTo(Body_shop::class,'body_shop_id');
    }
}
