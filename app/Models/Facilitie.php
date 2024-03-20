<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facilitie extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'showroom_id',
        'facilitie_image',
    ];
}
