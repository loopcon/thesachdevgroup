<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCsr extends Model
{
    use HasFactory;
    protected $table = 'company_csr';
    protected $fields = ['banner_image','title','title_color','title_font_size','title_font_family','description','description_font_color','description_font_size','description_font_family','left_title','left_title_color','left_title_font_size','left_title_font_family','left_description','left_description_font_color','left_description_font_size','left_description_font_family','image'];
}
