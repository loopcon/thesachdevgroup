<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CareerForm extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'career_form';
    protected $fields = ['first_name','last_name','email','contact_no','post_apply_for','resume'];
}
