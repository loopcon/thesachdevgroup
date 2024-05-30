<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Our_location;
use File;

class OurLocationController extends Controller
{
    //our_location
    public function our_location(Request $request){
        $has_permission = hasPermission('Our Locations');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Our Locations');
                $our_location = Our_location::first();
                $return_data['record'] = $our_location;
                return view("admin.our_location.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function our_location_insert(Request $request)
    {
        $has_permission = hasPermission('Our Locations');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'title' => 'required',
                    'image'  => 'required',
                ]);
                $existing_data = Our_location::find(1);

                if($existing_data) {
                    $our_location = $existing_data;
            
                    if($request->hasFile('image'))
                    {
                        $oldImage = $our_location->image;
                        if($oldImage) {
                            $oldImagePath = public_path('our_location/') . $oldImage;
                            if(File::exists($oldImagePath)) {
                                File::delete($oldImagePath);
                            }
                        }
                    }
                    if(!$our_location->slug){
                        $our_location->slug = slugify($request->title);
                    }

                } else {
                    $our_location = new Our_location();
                    $request->validate([
                        'title' => 'required',
                        'image'  => 'required',
                    ]);
                    $our_location->slug = slugify($request->title);
                }
            
                if($file = $request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/our_location' ;
                    $file->move($destinationPath,$fileName);
                    $our_location->image = $fileName;
                }

                $our_location->title = $request->title;
                $our_location->title_color = $request->title_color;
                $our_location->title_font_size = $request->title_font_size;
                $our_location->title_font_family = $request->title_font_family;

                $our_location->save();
            
                return redirect()->route('our_location')->with('success','Our Locations update successfully.');
   
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
