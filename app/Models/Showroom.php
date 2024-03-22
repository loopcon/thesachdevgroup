<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showroom extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'brand_id',
        'car_id',
        'address',
        'working_hours',
        'contact_number',
        'email',
        'address_color',
        'address_font_size',
        'address_font_family',
        'working_hours_color',
        'working_hours_font_size',
        'working_hours_font_family',
        'contact_number_color',
        'contact_number_font_size',
        'contact_number_font_family',
        'email_color',
        'email_font_size',
        'email_font_family',
    ];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function car(){
        return $this->hasMany(Car::class,'id');
    }

    public function customer_gallery(){
        return $this->hasMany(Customer_gallery::class);
    }

    public function facilitie(){
        return $this->hasMany(Facilitie::class);
    }
}
