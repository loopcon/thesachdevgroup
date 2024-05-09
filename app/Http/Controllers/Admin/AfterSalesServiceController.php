<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AfterSalesService;
use App\Models\Home_our_businesses;
use App\Models\Brand;

class AfterSalesServiceController extends Controller
{
    public function afterSalesService()
    {
        $has_permission = hasPermission('After Sales Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('After Sales Service');
                $return_data['brands'] = Brand::select('id','name')->get();
                $return_data['record'] = AfterSalesService::first();
                return view("admin.after_sales_service.index",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function afterSalesServiceUpdate(Request $request)
    {
        $has_permission = hasPermission('After Sales Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $request->validate([
                    'banner_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'title' => 'required',
                ]);
                $after_sales_service = AfterSalesService::first();
                if(isset($after_sales_service->id) && $after_sales_service->id)
                {
                    $id = $after_sales_service->id;
                    $after_sales_service = AfterSalesService::find($id);
                    $fields = array('title','title_color','title_font_size','title_font_family','book_service_form_title','book_service_form_title_color','book_service_form_title_font_size','book_service_form_title_font_family','description','description_font_color','description_font_size','description_font_family');
                    foreach($fields as $field)
                    {
                        $after_sales_service->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }
                    $after_sales_service->brand_id = json_encode($request->brand_id);
                    if($request->hasFile('banner_image')) {
                        $oldimage = $after_sales_service->banner_image;
                        if($oldimage)
                        {
                            removeFile('uploads/afterSalesService'.$oldimage);
                        }
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/afterSalesService');
                        $after_sales_service->banner_image = $banner_image;
                    }

                    $after_sales_service->save();
                }else{

                    $after_sales_service = new AfterSalesService();
                    $fields = array('title','title_color','title_font_size','title_font_family','book_service_form_title','book_service_form_title_color','book_service_form_title_font_size','book_service_form_title_font_family','description','description_font_color','description_font_size','description_font_family');
                    foreach($fields as $field)
                    {
                        $after_sales_service->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }
                    $after_sales_service->brand_id = json_encode($request->brand_id);
                    if($request->hasFile('banner_image')) {
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/afterSalesService');
                        $after_sales_service->banner_image = $banner_image;
                    }
                    $after_sales_service->save();
                }
                if($after_sales_service)
                {
                    return redirect()->back()->with('success', trans('After Sales Service update successfully.'));
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
