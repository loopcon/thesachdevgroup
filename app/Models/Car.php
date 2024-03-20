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
    ];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
