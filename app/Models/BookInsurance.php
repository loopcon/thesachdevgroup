<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookInsurance extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'book_insurance';
    protected $fields = ['brand_id', 'first_name', 'phone', 'email'];

    public function brandDetail()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
