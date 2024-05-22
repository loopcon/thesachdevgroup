<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCenterContactQuery extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'service_center_contact_query';
    protected $fields = ['first_name','phone','email','our_service','description'];

    public function ourService()
    {
        return $this->belongsTO(Header_menu::class,'our_service');
    }
}
