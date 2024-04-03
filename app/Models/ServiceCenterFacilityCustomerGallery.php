<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCenterFacilityCustomerGallery extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'service_center_facilities_and_customer_gallery';
    protected $fields = ['service_center_id', 'facility_image', 'customer_gallery_image'];

    public function serviceCenterDetail()
    {
        return $this->belongsTo(ServiceCenter::class, 'service_center_id');
    }
}
