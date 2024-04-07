<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'service';
    protected $fields = ['service_center_id', 'business_id', 'icon', 'slug', 'name', 'name_font_color', 'name_font_size', 'name_font_family', 'url'];

    public function serviceCenterDetail()
    {
        return $this->belongsTo(ServiceCenter::class, 'service_center_id');
    }
}
