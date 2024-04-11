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
    $module_permission = '';
    if(isset($modules) && $modules)
    {
        $module_permission = App\Models\ModulePermission::select('id' ,'module_id', 'read_permission', 'full_permission')->where([['module_id',$modules->id],['role_id',$role_id]])->first();
    }

    return $module_permission;
}

function removeFile($path){
    $filePath = public_path($path);
    File::delete($filePath);
}

function slugify($text){
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, '-');
    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // lowercase
    $text = strtolower($text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}
    
function fontSize(){
    return array(
        'start' => 24,
        'end'=> 50,
        'range' => 2
    );
}

function fontFamily(){
    return array(
        array('key'=>'poppins', 'value'=>'Poppins'),
        array('key'=>'sans-serif', 'value'=>'Sans Serif')
    );
}

function position(){
    return array(
        array('key'=>'left', 'value'=>'Left'),
        array('key'=>'right', 'value'=>'Right')
    );
}

function getSettingDetail(){
    $settings = App\Models\Setting::select('id', 'logo','payment_button_text','mobile_number','email',
    'email_icon','call_icon','address','address_icon')->first();
    // $settings = array();
    // if (count($AdminSetting_list) != 0) {
    //     foreach ($AdminSetting_list as $item) {
    //         $settings[$item->label] = $item->value;
    //     }
    // }

    return $settings;
}

