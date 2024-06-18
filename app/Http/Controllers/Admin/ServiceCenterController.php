<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use App\Models\Service;
use App\Models\OurBusiness;
use App\Models\ServiceCenterContactQuery;
use App\Models\Header_menu;
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
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
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
                $return_data['business'] = OurBusiness::select('id', 'title')->get();
                $return_data['services'] = Service::select('id','name')->get();
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
                    'business_id' => 'required',
                    'service_id' => 'required',
                    'address' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                    'contact_number' => 'required|numeric',
                    'rating' => 'required|numeric|max:5',
                    'number_of_rating' => 'required',
                ]);
                $service_center = new ServiceCenter();
                $fields = array('business_id', 'name', 'name_color', 'name_font_size','name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_font_size', 'email_font_family', 'email_font_color', 'rating', 'number_of_rating', 'slider_service_center_name', 'slider_service_center_name_color', 'slider_service_center_name_size', 'slider_service_center_name_font_family','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size', 'email_title_font_family','map_link');
                foreach($fields as $field)
                {
                    $service_center->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                $service_center->slug = $request->name ? slugify($request->name) : NULL;
                $service_center->service_id = json_encode($request->service_id);
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

                if($request->hasFile('slider_image')) {
                    $slider_image = fileUpload($request, 'slider_image', 'uploads/service_center/slider_image');
                    $service_center->slider_image = $slider_image;
                }

                if($request->hasFile('lets_connect_image')) {
                    $lets_connect_image = fileUpload($request, 'lets_connect_image', 'uploads/service_center/lets_connect_image');
                    $service_center->lets_connect_image = $lets_connect_image;
                }

                // if($request->hasFile('facility_image')) {
                //     $facility_image = fileUpload($request, 'facility_image', 'uploads/service_center_facility_image');
                //     $service_center->facility_image = $facility_image;
                // }

                // if($request->hasFile('customer_gallery_image')) {
                //     $customer_gallery_image = fileUpload($request, 'customer_gallery_image', 'uploads/service_center_customer_gallery_image');
                //     $service_center->customer_gallery_image = $customer_gallery_image;
                // }

                $service_center->save();

                if($service_center)
                {
                    return redirect()->route('service-center')->with('success', 'Service Center insert successfully.');
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
            $query = ServiceCenter::with('service', 'businessDetail')->select('id', 'service_id', 'business_id', 'name','name_color', 'name_font_size', 'name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_icon', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_icon', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_icon', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_icon', 'email_font_size', 'email_font_family', 'email_font_color')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $imageSrc = $list->image ? asset('uploads/service_center/'.$list->image) : '';
                    return '<img src="' . $imageSrc . '" alt="" width="100">';
                })
                ->addColumn('address_icon', function($list){
                    $address_icon = $list->address_icon ? asset('uploads/address_icon/'.$list->address_icon) : '';
                    return '<img src="' . $address_icon . '" alt="" width="50">';
                })
                ->addColumn('working_hours_icon', function($list){
                    $working_hours_icon = $list->working_hours_icon ? asset('uploads/working_hours_icon/'.$list->working_hours_icon) : '';
                    return '<img src="' . $working_hours_icon . '" alt="" width="50">';
                })
                ->addColumn('contact_icon', function($list){
                    $contact_icon = $list->contact_icon ? asset('uploads/contact_icon/'.$list->contact_icon) : '';
                    return '<img src="' . $contact_icon . '" alt="" width="50">';
                })
                ->addColumn('email_icon', function($list){
                    $email_icon = $list->email_icon ? asset('uploads/email_icon/'.$list->email_icon) : '';
                    return '<img src="' . $email_icon . '" alt="" width="50">';
                })
                ->addColumn('service_id', function($list){
                    $service_id = json_decode($list->service_id); 
                    $service_names = isset($service_id) && $service_id ? Service::whereIn('id', $service_id)->pluck('name')->implode(', ') : ''; 
                    return $service_names;
                })
                ->addColumn('business_id', function($list){
                    $business_id = isset($list->businessDetail->title) && $list->businessDetail->title ? $list->businessDetail->title : NULL;
                    return $business_id;
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
            return redirect()->back()->with('error','something went wrong');
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
                $return_data['business'] = OurBusiness::select('id', 'title')->get();
                $return_data['services'] = Service::select('id','name')->get();
                return view("admin.service_center.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function servicecenterUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Service Center');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'business_id' => 'required',
                    'service_id' => 'required',
                    'address' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                    'contact_number' => 'required|numeric',
                    'rating' => 'required|numeric|max:5',
                    'number_of_rating' => 'required',
                ]);
                $service_center = ServiceCenter::find($id);
                $fields = array('business_id', 'name', 'name_color', 'name_font_size','name_font_family', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_font_size', 'email_font_family', 'email_font_color', 'rating', 'number_of_rating','slider_service_center_name','slider_service_center_name_color', 'slider_service_center_name_size', 'slider_service_center_name_font_family','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size', 'email_title_font_family', 'map_link');
                foreach($fields as $field)
                {
                    $service_center->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                $service_center->slug = $request->name ? slugify($request->name) : NULL;
                $service_center->service_id = json_encode($request->service_id);
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

                if($request->hasFile('slider_image')) {
                    $oldimage = $service_center->slider_image;
                    if($oldimage)
                    {
                        removeFile('uploads/service_center/slider_image/'.$oldimage);
                    }
                    $slider_image = fileUpload($request, 'slider_image', 'uploads/service_center/slider_image');
                    $service_center->slider_image = $slider_image;
                }

                if($request->hasFile('lets_connect_image')) {
                    $oldimage = $service_center->lets_connect_image;
                    if($oldimage)
                    {
                        removeFile('uploads/service_center/lets_connect_image/'.$oldimage);
                    }
                    $lets_connect_image = fileUpload($request, 'lets_connect_image', 'uploads/service_center/lets_connect_image');
                    $service_center->lets_connect_image = $lets_connect_image;
                }

                // if($request->hasFile('facility_image')) {
                //     $oldimage = $service_center->facility_image;
                //     if($oldimage)
                //     {
                //         removeFile('uploads/service_center_facility_image/'.$oldimage);
                //     }
                //     $facility_image = fileUpload($request, 'facility_image', 'uploads/service_center_facility_image');
                //     $service_center->facility_image = $facility_image;
                // }

                // if($request->hasFile('customer_gallery_image')) {
                //     $oldimage = $service_center->customer_gallery_image;
                //     if($oldimage)
                //     {
                //         removeFile('uploads/service_center_customer_gallery_image/'.$oldimage);
                //     }
                //     $customer_gallery_image = fileUpload($request, 'customer_gallery_image', 'uploads/service_center_customer_gallery_image');
                //     $service_center->customer_gallery_image = $customer_gallery_image;
                // }
                // print_r($service_center);exit;

                $service_center->save();

                if($service_center)
                {
                    return redirect()->route('service-center')->with('success', 'Service Center update successfully.');
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

                if($service_center->slider_image != NULL)
                {
                    $slider_image = $service_center->slider_image;
                    if($slider_image)
                    {
                        removeFile('uploads/service_center/slider_image/'.$slider_image);
                    }
                }

                if($service_center->lets_connect_image != NULL)
                {
                    $lets_connect_image = $service_center->lets_connect_image;
                    if($lets_connect_image)
                    {
                        removeFile('uploads/service_center/lets_connect_image/'.$lets_connect_image);
                    }
                }

                $service_center = ServiceCenter::where('id',$id)->delete();
                if($service_center)
                {
                    return redirect()->route('service-center')->with('success', 'Service Center deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function serviceCenterContactQueryList(Request $request)
    {
        $has_permission = hasPermission('Service Center Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Service Center Contact Query');
                return view("admin.service_center_contact_query.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }

    }

    public function serviceCenterContactQueryDatatable(Request $request)
    {
        if($request->ajax()){
            $query = ServiceCenterContactQuery::with('ourService')->select('id', 'first_name','phone','email','our_service')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('our_service', function($list){
                    $our_service = isset($list->ourService->name) && $list->ourService->name ? $list->ourService->name : NULL;
                    return $our_service;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Service Center Contact Query');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $html .= "<span class='text-nowrap'>";
                            $html .= "<a href='".url('service-center-contact-query-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                            $html .= "<a href='javascript:void(0);' data-href='".route('service-center-contact-query-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function serviceCenterContactQueryEdit($id)
    {
        $has_permission = hasPermission('Service Center Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $return_data = array();
                $return_data['site_title'] = trans('Service Center Contact Query Edit');
                $return_data['our_services'] = Header_menu::where('menu_name','Our Services')->get();
                $return_data['record'] = ServiceCenterContactQuery::find($id);

                return view('admin.service_center_contact_query.form',array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterContactQueryUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Service Center Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'first_name' => 'required',
                    'email' => 'required',
                    'phone' => 'required|numeric',
                ]);

                $service_center_contact_query = ServiceCenterContactQuery::find($id);
                $service_center_contact_query->first_name = $request->first_name;
                $service_center_contact_query->email = $request->email;
                $service_center_contact_query->phone = $request->phone;
                $service_center_contact_query->our_service = $request->our_service;
                $service_center_contact_query->description = $request->description;
                $service_center_contact_query->save();

                if($service_center_contact_query)
                {
                    return redirect()->route('service-center-contact-query')->with('success','Service Center Contact Query update successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong, please try again later!');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterContactQueryDestroy($id)
    {
        $has_permission = hasPermission('Service Center Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $service_center_contact_query = ServiceCenterContactQuery::where('id',$id)->delete();

                if($service_center_contact_query)
                {
                    return redirect()->back()->with('success','Service Center Contact Query deleted successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong, please try again later!');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }

    }
}
