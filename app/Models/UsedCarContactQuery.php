<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCarContactQuery extends Model
{
    use HasFactory;
    protected $table = 'used_car_contact_query';
    protected $fields =['first_name','email','phone','our_service','description'];

    public function ourService()
    {
        return $this->belongsTo(Header_menu::class,'our_service');
    }
}
