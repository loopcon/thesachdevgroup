<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarInsurance;
use App\Models\Brand;

class CarInsuranceController extends Controller
{
    public function carInsurance()
    {
        $has_permission = hasPermission('Car Insurance');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Car Insurance');
                $return_data['brands'] = Brand::select('id','name')->get();
                $return_data['record'] = CarInsurance::first();

                return view("admin.car_insurance.index",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function carInsuranceUpdate(Request $request)
    {
        $has_permission = hasPermission('Car Insurance');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $request->validate([
                    'banner_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'title' => 'required',
                ]);
                $car_insurance = CarInsurance::first();
                if(isset($car_insurance->id) && $car_insurance->id)
                {
                    $id = $car_insurance->id;
                    $car_insurance = CarInsurance::find($id);
                    $fields = array('title','title_color','title_font_size','title_font_family','insurance_form_title','insurance_form_title_color','insurance_form_title_font_size','insurance_form_title_font_family','description','description_font_color','description_font_size','description_font_family');
                    foreach($fields as $field)
                    {
                        $car_insurance->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }
                    $car_insurance->brand_id = json_encode($request->brand_id);
                    if($request->hasFile('banner_image')) {
                        $oldimage = $car_insurance->banner_image;
                        if($oldimage)
                        {
                            removeFile('uploads/carInsurance'.$oldimage);
                        }
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/carInsurance');
                        $car_insurance->banner_image = $banner_image;
                    }

                    $car_insurance->save();
                }else{

                    $request->validate([
                        'banner_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    ]);
                    $car_insurance = new CarInsurance();
                    $fields = array('title','title_color','title_font_size','title_font_family','insurance_form_title','insurance_form_title_color','insurance_form_title_font_size','insurance_form_title_font_family','description','description_font_color','description_font_size','description_font_family');
                    foreach($fields as $field)
                    {
                        $car_insurance->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }
                    $car_insurance->brand_id = json_encode($request->brand_id);
                    if($request->hasFile('banner_image')) {
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/carInsurance');
                        $car_insurance->banner_image = $banner_image;
                    }
                    $car_insurance->save();
                }
                if($car_insurance)
                {
                    return redirect()->back()->with('success', trans('Car Insurance update successfully.'));
                }else{
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
