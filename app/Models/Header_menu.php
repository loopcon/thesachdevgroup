<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header_menu extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'menu_name',
        'name',
    ];
}
