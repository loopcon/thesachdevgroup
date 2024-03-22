<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
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
    ];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
