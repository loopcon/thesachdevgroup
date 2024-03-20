<?php

function getModules(){
    $main_modules = App\Models\Modules::select('id' ,'module')->get();
   
    return $main_modules;
}

function hasPermission($module_name)
{
    $role_id = Auth::user()->role_id;
    $modules = App\Models\Modules::select('id' ,'module')->where('module',$module_name)->first();
    $module_permission = App\Models\ModulePermission::select('id' ,'module_id', 'read_permission', 'full_permission')->where([['module_id',$modules->id],['role_id',$role_id]])->first();

    return $module_permission;
}
    