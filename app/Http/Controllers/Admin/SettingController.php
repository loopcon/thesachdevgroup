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
        $has_permission = hasPermission('Setting');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $settings = Setting::get();
                return view("admin.setting.form",compact('settings')); 
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function setting_insert(Request $request)
    {
        $has_permission = hasPermission('Setting');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

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

                    if($request->hasFile('address_icon'))
                    {
                        $address_icon = $setting->address_icon;
                        if($address_icon) {
                            $oldaddress_iconPath = public_path('address_icon/') . $address_icon;
                            if(File::exists($oldaddress_iconPath)) {
                                File::delete($oldaddress_iconPath);
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

                if($file = $request->hasFile('address_icon')) {
                    $file = $request->file('address_icon');
                    $extension = $file->getClientOriginalExtension();
                    $addressiconfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/address_icon' ;
                    $file->move($destinationPath,$addressiconfileName);
                    $setting->address_icon = $addressiconfileName;
                }

                $setting->email = $request->email;
        
                $setting->email_color = $request->email_color;
                $setting->email_font_size = $request->email_font_size;
                $setting->email_font_family = $request->email_font_family;

                $setting->mobile_number = $request->mobile_number;

                $setting->mobile_number_color = $request->mobile_number_color;
                $setting->mobile_number_font_size = $request->mobile_number_font_size;
                $setting->mobile_number_font_family = $request->mobile_number_font_family;

                $setting->time = $request->time;

                $setting->time_color = $request->time_color;
                $setting->time_font_size = $request->time_font_size;
                $setting->time_font_family = $request->time_font_family;

                $setting->address = $request->address;
                
                $setting->address_color = $request->address_color;
                $setting->address_font_size = $request->address_font_size;
                $setting->address_font_family = $request->address_font_family;

                $setting->payment_button_text = $request->payment_button_text;
                $setting->payment_button_text_color = $request->payment_button_text_color;
                $setting->payment_button_font_size = $request->payment_button_font_size;
                $setting->payment_button_font_family = $request->payment_button_font_family;
                $setting->payment_button_color = $request->payment_button_color;
 
                $setting->save();
            
                return redirect()->route('setting')->with('success','Setting update successfully.');
    
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }
}
