<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurServiceUsedCars extends Model
{
    use HasFactory;
    protected $table = 'our_service_used_cars';
    protected $fields = ['banner_image', 'meta_title', 'meta_keyword', 'meta_description'];
}
