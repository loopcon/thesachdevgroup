<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModulePermission;
use App\Constant;
use DataTables;
use File;
use Auth;

class RolePermissionController extends Controller
{
    public function index($role_id = null) 
    {
        $constant_superadmin = Constant::SUPERADMIN;
        $constant_hr = Constant::HR;
        $constant_manager = Constant::MANAGER;
        $module_permission = array();
        if($role_id){
            $permissions = ModulePermission::where('role_id',$role_id)->get();
            foreach($permissions as $permission)
            {
                $module_permission[$permission->module_id]['read'] = $permission->read_permission;
                $module_permission[$permission->module_id]['full'] = $permission->full_permission;
            }
        }
        return view("admin.role_permission.index",compact('module_permission','role_id','constant_superadmin','constant_hr','constant_manager')); 
    }

    public function store(Request $request)
    {
        $role_id = $request->role_id;
        //delete all permission of selected role
        ModulePermission::where('role_id', $role_id)->delete();

        //set role permission
        if($request->module_permission && count($request->module_permission) > 0){
            foreach ($request->module_permission as $key => $value) {
                $permission = new ModulePermission();
                $permission->role_id = $role_id;
                $permission->module_id = $key;
                $permission->read_permission = isset($value['read']) && $value['read'] ? $value['read'] : 0;
                $permission->full_permission = isset($value['full']) && $value['full'] ? $value['full'] : 0;
                $permission->save();
            }
         }
        return redirect()->back()->with('message', 'Role permission updated successfully.');
    }

}
