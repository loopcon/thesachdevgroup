<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayUsLog extends Model
{
    use HasFactory;
    protected $table = "pay_us_logs";
    public $timestamps = false;

    public function nearLocation()
    {
        return $this->hasOne(NearLocation::class, 'id', 'loc_id');
    }

    public function showrooms()
    {
        // return $this->hasMany(Showroom::class, 'our_business_id', 'loc_id');
        return $this->hasMany(Showroom::class, 'id', 'loc_id');
    }

    public function bodyShops()
    {
        // return $this->hasMany(Body_shop::class, 'business_id', 'loc_id');
        return $this->hasMany(Body_shop::class, 'id', 'loc_id');
    }

    public function usedCars()
    {
        return $this->hasMany(Used_car::class, 'id', 'loc_id');
        // return $this->hasMany(Used_car::class, 'business_id', 'loc_id');
    }

    public function serviceCenters()
    {
        return $this->hasMany(ServiceCenter::class, 'id', 'loc_id');
        // return $this->hasMany(ServiceCenter::class, 'business_id', 'loc_id');
    }

    public function businessInsurance()
    {
        return $this->hasMany(OurBusinessInsurance::class, 'id', 'loc_id');
        // return $this->hasMany(OurBusinessInsurance::class, 'business_id', 'loc_id');
    }

}
