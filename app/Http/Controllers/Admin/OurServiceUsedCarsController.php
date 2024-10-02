<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurServiceUsedCars;

class OurServiceUsedCarsController extends Controller
{
    public function usedCars()
    {
        $has_permission = hasPermission('Used Cars');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Used Cars');
                $return_data['record'] = OurServiceUsedCars::first();
                return view("admin.our_service_used_cars.index",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function usedCarsUpdate(Request $request)
    {
        $has_permission = hasPermission('Used Cars');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {

                $usedcar = OurServiceUsedCars::first();
                if(isset($usedcar->id) && $usedcar->id)
                {
                    $id = $usedcar->id;
                    $request->validate([
                        'banner_image' => 'image|mimes:jpg,jpeg,png,webp,svg',
                    ]);
    
                    $usedcar = OurServiceUsedCars::find($id);
                    $usedcar->meta_title = $request->meta_title;
                    $usedcar->meta_keyword = $request->meta_keyword;
                    $usedcar->meta_description = $request->meta_description;

                    if($request->hasFile('banner_image'))
                    {
                        $old_image = $usedcar->banner_image;
                        if($old_image)
                        {
                            removeFile('uploads/usedCar'.$old_image);
                        }
                        $banner_image = fileUpload($request,'banner_image','uploads/usedCar');
                        $usedcar->banner_image = $banner_image;
                    }
                    $usedcar->save();

                }else{
                    $usedcar = new OurServiceUsedCars();
                    $usedcar->meta_title = $request->meta_title;
                    $usedcar->meta_keyword = $request->meta_keyword;
                    $usedcar->meta_description = $request->meta_description;

                    if($request->hasFile('banner_image'))
                    {
                        $banner_image = fileUpload($request,'banner_image','uploads/usedCar');
                        $usedcar->banner_image = $banner_image;
                    }
                    $usedcar->save();
                }

                if($usedcar)
                {
                    return redirect()->back()->with('success',trans('Used Car update successfully.'));
                }else{
                    return redirect()->back()->with('error', trans('something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
