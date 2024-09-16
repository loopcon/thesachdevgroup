<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayUs extends Model
{
    use HasFactory;
    protected $table = "pay_us";
    public $timestamps = false;

    public function nearLocation()
    {
        return $this->hasOne(NearLocation::class, 'id', 'loc_id');
    }

    public function showrooms()
    {
        return $this->hasMany(Showroom::class, 'our_business_id', 'loc_id');
    }

    public function bodyShops()
    {
        return $this->hasMany(Body_shop::class, 'business_id', 'loc_id');
    }

    public function usedCars()
    {
        return $this->hasMany(Used_car::class, 'business_id', 'loc_id');
    }

    public function serviceCenters()
    {
        return $this->hasMany(ServiceCenter::class, 'business_id', 'loc_id');
    }

    public function businessInsurance()
    {
        return $this->hasMany(OurBusinessInsurance::class, 'business_id', 'loc_id');
    }
}
