<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use DataTables;
use File;
use Auth;

class ServiceCenterController extends Controller
{
    public function serviceCenterList()
    {
        $has_permission = hasPermission('Service Center');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Service Center');
                return view("admin.service_center.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterCreate(Request $request)
    {
        $has_permission = hasPermission('Service Center');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Service Center Create');
                return view("admin.service_center.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterStore(Request $request)
    {
        $has_permission = hasPermission('Service Center');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'address' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                    'contact_number' => 'required|numeric',
                ]);
                $service_center = new ServiceCenter();
                $fields = array('name', 'name_color', 'name_font_size','name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_font_size', 'email_font_family', 'email_font_color');
                foreach($fields as $field)
                {
                    $service_center->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $image = fileUpload($request, 'image', 'uploads/service_center');
                    $service_center->image = $image;
                }

                if($request->hasFile('address_icon')) {
                    $address_icon = fileUpload($request, 'address_icon', 'uploads/address_icon');
                    $service_center->address_icon = $address_icon;
                }

                if($request->hasFile('working_hours_icon')) {
                    $working_hours_icon = fileUpload($request, 'working_hours_icon', 'uploads/working_hours_icon');
                    $service_center->working_hours_icon = $working_hours_icon;
                }

                if($request->hasFile('contact_icon')) {
                    $contact_icon = fileUpload($request, 'contact_icon', 'uploads/contact_icon');
                    $service_center->contact_icon = $contact_icon;
                }

                if($request->hasFile('email_icon')) {
                    $email_icon = fileUpload($request, 'email_icon', 'uploads/email_icon');
                    $service_center->email_icon = $email_icon;
                }
                $service_center->save();

                if($service_center)
                {
                    return redirect()->route('service-center')->with('success', 'Service Center insert succesfully');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterDatatable(Request $request)
    {
        if($request->ajax()){
            $query = ServiceCenter::select('id', 'name','name_color', 'name_font_size', 'name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_icon', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_icon', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_icon', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_icon', 'email_font_size', 'email_font_family', 'email_font_color')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $imageSrc = $list->image ? asset('uploads/service_center/'.$list->image) : '';
                    return '<img src="' . $imageSrc . '" alt="" width="100">';
                })
                ->addColumn('address_icon', function($list){
                    $address_icon = $list->address_icon ? asset('uploads/address_icon/'.$list->address_icon) : '';
                    return '<img src="' . $address_icon . '" alt="" width="100">';
                })
                ->addColumn('working_hours_icon', function($list){
                    $working_hours_icon = $list->working_hours_icon ? asset('uploads/working_hours_icon/'.$list->working_hours_icon) : '';
                    return '<img src="' . $working_hours_icon . '" alt="" width="100">';
                })
                ->addColumn('contact_icon', function($list){
                    $contact_icon = $list->contact_icon ? asset('uploads/contact_icon/'.$list->contact_icon) : '';
                    return '<img src="' . $contact_icon . '" alt="" width="100">';
                })
                ->addColumn('email_icon', function($list){
                    $email_icon = $list->email_icon ? asset('uploads/email_icon/'.$list->email_icon) : '';
                    return '<img src="' . $email_icon . '" alt="" width="100">';
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Service Center');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('service-center-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('service-center-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['image', 'address_icon', 'working_hours_icon', 'contact_icon', 'email_icon', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function serviceCenterEdit($id)
    {
        $has_permission = hasPermission('Service Center');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Service Center Edit');
                $service_center = ServiceCenter::find($id);
                $return_data['record'] = $service_center;
                return view("admin.service_center.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function serviCecenterUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Service Center');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'address' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                    'contact_number' => 'required|numeric',
                ]);
                $service_center = ServiceCenter::find($id);
                $fields = array('name', 'name_color', 'name_font_size','name_font_family', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_font_size', 'email_font_family', 'email_font_color');
                foreach($fields as $field)
                {
                    $service_center->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $oldimage = $service_center->image;
                    if($oldimage)
                    {
                        removeFile('uploads/service_center/'.$oldimage);
                    }
                    $image = fileUpload($request, 'image', 'uploads/service_center');
                    $service_center->image = $image;
                }

                if($request->hasFile('address_icon')) {
                    $oldimage = $service_center->address_icon;
                    if($oldimage)
                    {
                        removeFile('uploads/address_icon/'.$oldimage);
                    }
                    $address_icon = fileUpload($request, 'address_icon', 'uploads/address_icon');
                    $service_center->address_icon = $address_icon;
                }

                if($request->hasFile('working_hours_icon')) {
                    $oldimage = $service_center->working_hours_icon;
                    if($oldimage)
                    {
                        removeFile('uploads/working_hours_icon/'.$oldimage);
                    }
                    $working_hours_icon = fileUpload($request, 'working_hours_icon', 'uploads/working_hours_icon');
                    $service_center->working_hours_icon = $working_hours_icon;
                }

                if($request->hasFile('contact_icon')) {
                    $oldimage = $service_center->contact_icon;
                    if($oldimage)
                    {
                        removeFile('uploads/contact_icon/'.$oldimage);
                    }
                    $contact_icon = fileUpload($request, 'contact_icon', 'uploads/contact_icon');
                    $service_center->contact_icon = $contact_icon;
                }

                if($request->hasFile('email_icon')) {
                    $oldimage = $service_center->email_icon;
                    if($oldimage)
                    {
                        removeFile('uploads/email_icon/'.$oldimage);
                    }
                    $email_icon = fileUpload($request, 'email_icon', 'uploads/email_icon');
                    $service_center->email_icon = $email_icon;
                }
                $service_center->save();

                if($service_center)
                {
                    return redirect()->route('service-center')->with('success', 'Service Center update succesfully');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Service Center');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $service_center = ServiceCenter::find($id);
                if($service_center->image != NULL)
                {
                    $service_center_image = $service_center->image;
                    if($service_center_image)
                    {
                        removeFile('uploads/service_center/'.$service_center_image);
                    }
                }

                if($service_center->address_icon != NULL)
                {
                    $address_icon = $service_center->address_icon;
                    if($address_icon)
                    {
                        removeFile('uploads/address_icon/'.$address_icon);
                    }
                }

                if($service_center->working_hours_icon != NULL)
                {
                    $working_hours_icon = $service_center->working_hours_icon;
                    if($working_hours_icon)
                    {
                        removeFile('uploads/working_hours_icon/'.$working_hours_icon);
                    }
                }

                if($service_center->contact_icon != NULL)
                {
                    $contact_icon = $service_center->contact_icon;
                    if($contact_icon)
                    {
                        removeFile('uploads/contact_icon/'.$contact_icon);
                    }
                }

                if($service_center->email_icon != NULL)
                {
                    $email_icon = $service_center->email_icon;
                    if($email_icon)
                    {
                        removeFile('uploads/email_icon/'.$email_icon);
                    }
                }
                $service_center = ServiceCenter::where('id',$id)->delete();
                if($service_center)
                {
                    return redirect()->route('service-center')->with('success', 'Service Center deleted succesfully');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
