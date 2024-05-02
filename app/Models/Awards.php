<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Awards extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'award_and_recognition';
    protected $fields = ['business_id', 'name', 'image'];

    public function businessdDetail()
    {
        return $this->belongsTo(OurBusiness::class, 'business_id');
    }
}
