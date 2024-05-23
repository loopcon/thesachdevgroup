<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuickContactUs extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'quick_contact_us';
    protected $fields = ['brand_id','first_name','phone','email','location','description'];
}
