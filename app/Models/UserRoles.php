<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    use HasFactory;
    protected $table = 'user_role_permission';
    protected $fields = ['user_type_id', 'module_permission_id'];
}
