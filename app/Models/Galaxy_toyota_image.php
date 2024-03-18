<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galaxy_toyota_image extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'name',
    ];
}
