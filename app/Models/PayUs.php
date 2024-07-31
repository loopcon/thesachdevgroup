<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayUs extends Model
{
    use HasFactory;
    protected $table = "pay_us";
    public $timestamps = false;
}
