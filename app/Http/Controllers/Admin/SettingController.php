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

            if($request->hasFile('email_icon'))
            {
                $emailicon = $setting->email_icon;
                if($emailicon) {
                    $oldemailiconPath = public_path('email_icon/') . $emailicon;
                    if(File::exists($oldemailiconPath)) {
                        File::delete($oldemailiconPath);
                    }
                }
            }

            if($request->hasFile('call_icon'))
            {
                $call_icon = $setting->call_icon;
                if($call_icon) {
                    $oldcall_iconPath = public_path('call_icon/') . $call_icon;
                    if(File::exists($oldcall_iconPath)) {
                        File::delete($oldcall_iconPath);
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

        if($file = $request->hasFile('email_icon')) {
            $file = $request->file('email_icon');
            $extension = $file->getClientOriginalExtension();
            $IconfileName = time(). '.' . $extension;
    
            $destinationPath = public_path().'/email_icon' ;
            $file->move($destinationPath,$IconfileName);
            $setting->email_icon = $IconfileName;
        }
    
        if($file = $request->hasFile('call_icon')) {
            $file = $request->file('call_icon');
            $extension = $file->getClientOriginalExtension();
            $callfileName = time(). '.' . $extension;
    
            $destinationPath = public_path().'/call_icon' ;
            $file->move($destinationPath,$callfileName);
            $setting->call_icon = $callfileName;
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
