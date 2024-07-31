<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearLocation extends Model
{
    use HasFactory;
    protected $table = "near_location";

    public $timestamps = false;
}
