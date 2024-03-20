<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model
{
    use HasFactory;
    protected $table = 'module_permission';
    protected $fields = ['role_id','module_id','read_permission','full_permission'];
}
