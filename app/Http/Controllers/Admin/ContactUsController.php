<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact_us;
use File;

class ContactUsController extends Controller
{
    //contact_us

    public function contact_us()
    {
        $has_permission = hasPermission('Contact Us');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Contact Us');
                $contact_us = Contact_us::first();
                $return_data['record'] = $contact_us;
                return view("admin.contact_us.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function contact_us_insert(Request $request){

        $has_permission = hasPermission('Contact Us');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $existing_data = Contact_us::find(1);

                if($existing_data) {
                    $contact_us = $existing_data;
            
                    if($request->hasFile('image'))
                    {
                        $oldImage = $contact_us->image;
                        if($oldImage) {
                            $oldImagePath = public_path('contact_us/') . $oldImage;
                            if(File::exists($oldImagePath)) {
                                File::delete($oldImagePath);
                            }
                        }
                    }
                    if(!$contact_us->slug){
                        $contact_us->slug = slugify($request->title);
                    }

                } else {
                    $contact_us = new Contact_us();

                    $contact_us->slug = slugify($request->title);
                }
            
                if($file = $request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/contact_us' ;
                    $file->move($destinationPath,$fileName);
                    $contact_us->image = $fileName;
                }

                $contact_us->title = $request->title;
                $contact_us->title_color = $request->title_color;
                $contact_us->title_font_size = $request->title_font_size;
                $contact_us->title_font_family = $request->title_font_family;


                $contact_us->sub_title = $request->sub_title;
                $contact_us->sub_title_color = $request->sub_title_color;
                $contact_us->sub_title_font_size = $request->sub_title_font_size;
                $contact_us->sub_title_font_family = $request->sub_title_font_family;

                $contact_us->form_title = $request->form_title;
                $contact_us->form_title_color = $request->form_title_color;
                $contact_us->form_title_font_size = $request->form_title_font_size;
                $contact_us->form_title_font_family = $request->form_title_font_family;

                $contact_us->form_sub_title = $request->form_sub_title;
                $contact_us->form_sub_title_color = $request->form_sub_title_color;
                $contact_us->form_sub_title_font_size = $request->form_sub_title_font_size;
                $contact_us->form_sub_title_font_family = $request->form_sub_title_font_family;

                $contact_us->map_link = $request->map_link;


                $contact_us->save();
            
                return redirect()->route('contact_us')->with('success','Contact Us update successfully.');
   
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }
}
