<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqTitle extends Model
{
    use HasFactory;
    protected $table = 'faq_title';
    protected $fields = ['title', 'title_color', 'title_font_size', 'title_font_family'];
}
