<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowroomTestimonial extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'showroom_testimonial';
    protected $fields = ['image', 'name', 'showroom_id', 'description'];

    public function showroomDetail()
    {
        return $this->belongsTo(Showroom::class, 'showroom_id');
    }
}
