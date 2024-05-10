<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'our_business_id',
        'brand_id',
        'image',
        'name',
        'price',
        'link',
        'name_color',
        'price_color',
        'name_font_size',
        'price_font_size',
        'name_font_family',
        'price_font_family',
        'driven',
        'driven_color',
        'driven_font_size',
        'driven_font_family',
        'fuel_type',
        'fuel_type_color',
        'fuel_type_font_size',
        'fuel_type_font_family',
        'year',
        'year_color',
        'year_font_size',
        'year_font_family',
        'body_style',
        'body_style_color',
        'body_style_font_size',
        'body_style_font_family',
    ];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function our_business(){
        return $this->belongsTo(OurBusiness::class,'our_business_id');
    }
}
