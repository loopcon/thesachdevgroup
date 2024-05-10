<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewCar;
use App\Models\Brand;
use App\Models\Car;

class NewCarsController extends Controller
{
    public function newCars()
    {
        $has_permission = hasPermission('New Cars');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('New Cars');
                $return_data['brands'] = Brand::select('id','name')->get();
                $return_data['cars'] = Car::select('id','name')->get();
                $return_data['record'] = NewCar::first();
                return view("admin.new_car.index",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function newCarsUpdate(Request $request)
    {
        $has_permission = hasPermission('New Cars');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $request->validate([
                    'banner_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'title' => 'required',
                ]);
                $new_car = NewCar::first();
                if(isset($new_car->id) && $new_car->id)
                {
                    $id = $new_car->id;
                    $new_car = NewCar::find($id);
                    $fields = array('title','title_color','title_font_size','title_font_family');
                    foreach($fields as $field)
                    {
                        $new_car->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }
                    // $new_car->brand_id = json_encode($request->brand_id);
                    // $new_car->car_id = json_encode($request->car_id);
                    if($request->hasFile('banner_image')) {
                        $oldimage = $new_car->banner_image;
                        if($oldimage)
                        {
                            removeFile('uploads/new_car'.$oldimage);
                        }
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/new_car');
                        $new_car->banner_image = $banner_image;
                    }

                    if($request->hasFile('used_car_banner_image')) {
                        $oldimage = $new_car->used_car_banner_image;
                        if($oldimage)
                        {
                            removeFile('uploads/new_car'.$oldimage);
                        }
                        $used_car_banner_image = fileUpload($request, 'used_car_banner_image', 'uploads/usedCar');
                        $new_car->used_car_banner_image = $used_car_banner_image;
                    }

                    $new_car->save();
                }else{

                    $new_car = new NewCar();
                    $fields = array('title','title_color','title_font_size','title_font_family');
                    foreach($fields as $field)
                    {
                        $new_car->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }
                    $new_car->brand_id = json_encode($request->brand_id);
                    $new_car->car_id = json_encode($request->car_id);
                    if($request->hasFile('banner_image')) {
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/new_car');
                        $new_car->banner_image = $banner_image;
                    }

                    if($request->hasFile('used_car_banner_image')) {
                        $used_car_banner_image = fileUpload($request, 'used_car_banner_image', 'uploads/usedCar');
                        $new_car->used_car_banner_image = $used_car_banner_image;
                    }
                    $new_car->save();
                }
                if($new_car)
                {
                    return redirect()->back()->with('success', trans('New Cars update successfully.'));
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
