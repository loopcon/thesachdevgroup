<?php

function fileUpload($request, $file, $path){
    $imageName = $request->$file->getClientOriginalName();
    $file_ext = $request->$file->getClientOriginalExtension();
    $fileInfo = pathinfo($imageName);
    $filename = str_replace(' ', '', $fileInfo['filename']);
    $filename = str_replace('(', '', $filename);
    $filename = str_replace(')', '', $filename);
    $newname = $filename.time() . "." . $file_ext;
    $destinationPath1 = public_path($path);
    $request->file($file)->move($destinationPath1, $newname);
    return $newname;
}

function getModules(){
    $main_modules = App\Models\Modules::select('id' ,'module')->get();

    return $main_modules;
}

function hasPermission($module_name)
{
    $role_id = isset(Auth::user()->role_id) && Auth::user()->role_id ? Auth::user()->role_id : NULL;
    $modules = App\Models\Modules::select('id' ,'module')->where('module',$module_name)->first();
    $module_permission = App\Models\ModulePermission::select('id' ,'module_id', 'read_permission', 'full_permission')->where([['module_id',$modules->id],['role_id',$role_id]])->first();

    return $module_permission;
}
    