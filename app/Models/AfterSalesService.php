<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AfterSalesService extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'after_sales_service';
    protected $fields = ['brand_id','banner_image','title','title_color','title_font_size','title_font_family','book_service_form_title','book_service_form_title_color','book_service_form_title_font_size','book_service_form_title_font_family','description','description_font_color','description_font_size','description_font_family'];
}
