<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowroomContatQuery extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'showroom_contact_query';
    protected $fields = ['first_name','phone','email','our_service','description'];
}
