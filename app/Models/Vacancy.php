<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'vacancies';
    protected $fields = ['business_id', 'name', 'name_font_color', 'name_font_size', 'name_font_family', 'description', 'description_front_color', 'description_font_family', 'description_font_size', 'icon', 'image', 'experience', 'work_level', 'employee_type', 'offer_salary'];

    public function businessDetail()
    {
        return $this->belongsTo(OurBusiness::class, 'business_id');
    }
}
