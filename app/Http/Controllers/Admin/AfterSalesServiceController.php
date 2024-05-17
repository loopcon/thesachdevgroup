<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AfterSalesService;
use App\Models\Home_our_businesses;
use App\Models\Brand;
use App\Models\BookCarService;
use DataTables;

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

    public function bookedCarService()
    {
        $has_permission = hasPermission('Booked Car Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Booked Car Service');

                return view("admin.booked_car_service.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function bookedCarServiceDatatable(Request $request)
    {
        if($request->ajax()){
            $query = BookCarService::with('brandDetail')->select('id', 'brand_id', 'first_name', 'phone', 'email')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('brand_id', function($list){
                    $brand_id = isset($list->brandDetail->name) && $list->brandDetail->name ? $list->brandDetail->name : NULL;
                    return $brand_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Booked Car Service');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        // $html .= "<a href='javascript:void(0);' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('booked-car-service-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function bookedCarServiceDestroy($id)
    {
        $has_permission = hasPermission('Booked Car Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $booked_service = BookCarService::where('id',$id)->delete();

                if($booked_service)
                {
                    return redirect('booked-car-service')->with('success',trans('Booked Car Service deleted successfully.'));
                }else{
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
