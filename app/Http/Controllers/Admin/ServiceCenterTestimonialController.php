<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenterTestimonial;
use App\Models\ServiceCenter;
use DataTables;
use File;
use Auth;

class ServiceCenterTestimonialController extends Controller
{
    public function serviceCeterTestimonialList()
    {
        $has_permission = hasPermission('Service Center Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Service Center Testimonial');
                return view("admin.service_center_testimonial.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterTestimonialCreate(Request $request)
    {
        $has_permission = hasPermission('Service Center Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Service Center Testimonial Create');
                $return_data['service_center'] = ServiceCenter::select('id', 'name')->get();
                return view("admin.service_center_testimonial.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterTestimonialStore(Request $request)
    {
        $has_permission = hasPermission('Service Center Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'service_center_id' => 'required',
                    'name' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,webp',
                ]);
                $service_center_testimonial = new ServiceCenterTestimonial();
                $fields = array('service_center_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family');
                foreach($fields as $field)
                {
                    $service_center_testimonial->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $image = fileUpload($request, 'image', 'uploads/service_center_testimonial');
                    $service_center_testimonial->image = $image;
                }

                $service_center_testimonial->save();

                if($service_center_testimonial)
                {
                    return redirect()->route('service-center-testimonial')->with('success', 'Service Center Testimonial insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterTestimonialDatatable(Request $request)
    {
        if($request->ajax()){
            $query = ServiceCenterTestimonial::with('serviceCenterDetail')->select('id', 'service_center_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family', 'image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $image = $list->image ? asset('uploads/service_center_testimonial/'.$list->image) : '';
                    return '<img src="' . $image . '" alt="" width="50">';
                })
                ->addColumn('service_center_id', function($list){
                    $service_center_id = isset($list->serviceCenterDetail->name) && $list->serviceCenterDetail->name ? $list->serviceCenterDetail->name : NULL;
                    return $service_center_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Service Center Testimonial');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('service-center-testimonial-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('service-center-testimonial-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function serviceCenterTestimonialEdit($id)
    {
        $has_permission = hasPermission('Service Center Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Service Center Testimonial Edit');
                $service = ServiceCenterTestimonial::find($id);
                $return_data['record'] = $service;
                $return_data['service_center'] = ServiceCenter::select('id', 'name')->get();
                return view("admin.service_center_testimonial.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function serviceCenterTestimonialUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Service Center Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'service_center_id' => 'required',
                    'name' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $service_center_testimonial = ServiceCenterTestimonial::find($id);
                $fields = array('service_center_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family');
                foreach($fields as $field)
                {
                    $service_center_testimonial->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $oldimage = $service_center_testimonial->image;
                    if($oldimage)
                    {
                        removeFile('uploads/service_center_testimonial/'.$oldimage);
                    }
                    $image = fileUpload($request, 'image', 'uploads/service_center_testimonial');
                    $service_center_testimonial->image = $image;
                }

                $service_center_testimonial->save();

                if($service_center_testimonial)
                {
                    return redirect()->route('service-center-testimonial')->with('success', 'Service Center Testimonial update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterTestimonialDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Service Center Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $service_center_testimonial = ServiceCenterTestimonial::find($id);
                if($service_center_testimonial->image != NULL)
                {
                    $image = $service_center_testimonial->image;
                    if($image)
                    {
                        removeFile('uploads/service_center_testimonial/'.$image);
                    }
                }
                $service_center_testimonial = ServiceCenterTestimonial::where('id',$id)->delete();
                if($service_center_testimonial)
                {
                    return redirect()->route('service-center-testimonial')->with('success', 'Service Center Testimonial deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
