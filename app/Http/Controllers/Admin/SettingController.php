<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;
use File;

class SettingController extends Controller
{
    //setting
    public function setting(Request $request){
        $settings = Setting::get();
        return view("admin.setting.form",compact('settings')); 
    }

    
    public function setting_insert(Request $request){
        
        $setting = Setting::find(1);

        if($setting) {
            $setting = $setting;
    
            if($request->hasFile('logo'))
            {
                $oldlogo = $setting->logo;
                if($oldlogo) {
                    $oldlogoPath = public_path('logo/') . $oldlogo;
                    if(File::exists($oldlogoPath)) {
                        File::delete($oldlogoPath);
                    }
                }
            }

        } else {
            $setting = new Setting();
        }
     
        if($file = $request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time(). '.' . $extension;
    
            $destinationPath = public_path().'/logo' ;
            $file->move($destinationPath,$fileName);
            $setting->logo = $fileName;
        }
    
        $setting->email = $request->email;
        $setting->mobile_number = $request->mobile_number;
        $setting->time = $request->time;
        $setting->twitter_link = $request->twitter_link;
        $setting->linkedin_link = $request->linkedin_link;
        $setting->facebook_link = $request->facebook_link;
        $setting->address = $request->address;
        $setting->footer_description = $request->footer_description;
        $setting->save();
    
        return redirect()->route('setting')->with('message', 'Setting inserted successfully');
    }
}
