<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurBusinessInsurance extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'our_business_insurance';
    protected $fields = ['business_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'icon', 'url'];
}
