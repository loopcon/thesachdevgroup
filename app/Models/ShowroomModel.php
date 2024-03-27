<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowroomModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'showroom_model';
    protected $fields = ['showroom_id', 'title', 'slug', 'image', 'title_text_size','title_text_color','title_font_family','image_size'];

    public function showroomDetail()
    {
        return $this->belongsTo(Showroom::class, 'showroom_id');
    }
}
