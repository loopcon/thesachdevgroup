<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showroom_facility_customer_gallery extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'showroom_id',
        'facility_image',
        'customer_gallery_image',
    ];

    public function showroom(){
        return $this->belongsTo(Showroom::class,'showroom_id');
    }
}
