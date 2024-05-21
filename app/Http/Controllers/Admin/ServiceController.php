<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCenter;
use App\Models\OurBusiness;
use DataTables;
use File;
use Auth;

class ServiceController extends Controller
{
    public function serviceList()
    {
        $has_permission = hasPermission('Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Services');
                return view("admin.service.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCreate(Request $request)
    {
        $has_permission = hasPermission('Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Service Create');
                $return_data['business'] = OurBusiness::select('id', 'title')->get();
                return view("admin.service.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceStore(Request $request)
    {
        $has_permission = hasPermission('Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    // 'service_center_id' => 'required',
                    // 'business_id' => 'required',
                    'icon' => 'required|image|mimes:jpeg,png,jpg,webp',
                    'url' => 'required|url',
                ]);
                $service = new Service();
                $fields = array('business_id', 'name', 'name_font_color', 'name_font_size', 'name_font_family', 'url');
                foreach($fields as $field)
                {
                    $service->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }
                $service->slug = $request->name ? slugify($request->name) : NULL;
                if($request->hasFile('icon')) {
                    $icon = fileUpload($request, 'icon', 'uploads/service');
                    $service->icon = $icon;
                }

                $service->save();

                if($service)
                {
                    return redirect()->route('service')->with('success', 'Service insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceDatatable(Request $request)
    {
        if($request->ajax()){
            $query = Service::select('id', 'business_id', 'name', 'icon', 'name_font_color', 'name_font_size', 'name_font_family', 'url')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('icon', function($list){
                    $icon = $list->icon ? asset('uploads/service/'.$list->icon) : '';
                    return '<img src="' . $icon . '" alt="" width="100">';
                })

                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Service');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('service-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('service-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['icon', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function serviceEdit($id)
    {
        $has_permission = hasPermission('Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Service Edit');
                $service = Service::find($id);
                $return_data['record'] = $service;
                $return_data['business'] = OurBusiness::select('id', 'title')->get();
                // $return_data['service_center'] = ServiceCenter::select('id', 'name')->get();
                return view("admin.service.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function serviceUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    // 'service_center_id' => 'required',
                    // 'business_id' => 'required',
                    'icon' => 'image|mimes:jpeg,png,jpg,webp',
                    'url' => 'required|url',
                ]);
                $service = Service::find($id);
                $fields = array('business_id', 'name', 'name_font_color', 'name_font_size', 'name_font_family', 'url');
                foreach($fields as $field)
                {
                    $service->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                $service->slug = $request->name ? slugify($request->name) : NULL;
                if($request->hasFile('icon')) {
                    $oldimage = $service->icon;
                    if($oldimage)
                    {
                        removeFile('uploads/service/'.$oldimage);
                    }
                    $icon = fileUpload($request, 'icon', 'uploads/service');
                    $service->icon = $icon;
                }

                $service->save();

                if($service)
                {
                    return redirect()->route('service')->with('success', 'Service update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Service');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $service = Service::find($id);
                if($service->icon != NULL)
                {
                    $icon = $service->icon;
                    if($icon)
                    {
                        removeFile('uploads/service/'.$icon);
                    }
                }
                $service = Service::where('id',$id)->delete();
                if($service)
                {
                    return redirect()->route('service')->with('success', 'Service deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
