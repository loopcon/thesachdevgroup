<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    use HasFactory;
    protected $table = "vehicle_brand";

    public function payment_towards() {
        return $this->hasMany(PaymentToward::class, 'vehicle_brand', 'id');
    }
}
