<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayUsLog extends Model
{
    use HasFactory;
    protected $table = "pay_us_logs";
    public $timestamps = false;
}
