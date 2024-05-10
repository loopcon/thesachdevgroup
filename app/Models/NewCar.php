<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewCar extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'new_car';
    protected $fields = ['banner_image','title','title_color','title_font_size','title_font_family','brand_id','car_id','used_car_banner_image'];
}
