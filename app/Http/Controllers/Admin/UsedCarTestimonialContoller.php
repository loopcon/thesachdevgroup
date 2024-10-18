<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Used_car;
use App\Models\UsedCarTestimonial;
use App\Models\ModulePermission;
use DataTables;
use File;
use Auth;

class UsedCarTestimonialContoller extends Controller
{
    public function usedCarTestimonialList()
    {
        $has_permission = hasPermission('Used Car Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Used Car Testimonial');
                return view("admin.used_car_testimonial.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function usedCarTestimonialCreate(Request $request)
    {
        $has_permission = hasPermission('Used Car Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Used Car Testimonial Create');
                $return_data['used_car'] = Used_car::select('id', 'name')->get();
                return view("admin.used_car_testimonial.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function usedCarTestimonialStore(Request $request)
    {
        $has_permission = hasPermission('Used Car Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'used_car_id' => 'required',
                    'name' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,webp',
                ]);
                $used_car_testimonial = new UsedCarTestimonial();
                $fields = array('used_car_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family');
                foreach($fields as $field)
                {
                    $used_car_testimonial->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $image = fileUpload($request, 'image', 'uploads/used_car_testimonial');
                    $used_car_testimonial->image = $image;
                }

                $used_car_testimonial->save();

                if($used_car_testimonial)
                {
                    return redirect()->route('used-car-testimonial')->with('success', 'Used Car Testimonial insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function usedCarTestimonialDatatable(Request $request)
    {
        if($request->ajax()){
            $query = UsedCarTestimonial::with('usedCarDetail')->select('id', 'used_car_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family', 'image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $image = $list->image ? asset('uploads/used_car_testimonial/'.$list->image) : '';
                    return '<img src="' . $image . '" alt="" width="50">';
                })
                ->addColumn('used_car_id', function($list){
                    $used_car_id = isset($list->usedCarDetail->name) && $list->usedCarDetail->name ? $list->usedCarDetail->name : NULL;
                    return $used_car_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Used Car Testimonial');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('used-car-testimonial-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('used-car-testimonial-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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

    public function usedCarTestimonialEdit($id)
    {
        $has_permission = hasPermission('Used Car Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Used Car Testimonial Edit');
                $service = UsedCarTestimonial::find($id);
                $return_data['record'] = $service;
                $return_data['used_car'] = Used_car::select('id', 'name')->get();
                return view("admin.used_car_testimonial.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function usedCarTestimonialUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Used Car Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            $id = decrypt($id);
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'used_car_id' => 'required',
                    'name' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $used_car_testimonial = UsedCarTestimonial::find($id);
                $fields = array('used_car_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family');
                foreach($fields as $field)
                {
                    $used_car_testimonial->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $oldimage = $used_car_testimonial->image;
                    if($oldimage)
                    {
                        removeFile('uploads/used_car_testimonial/'.$oldimage);
                    }
                    $image = fileUpload($request, 'image', 'uploads/used_car_testimonial');
                    $used_car_testimonial->image = $image;
                }

                $used_car_testimonial->save();

                if($used_car_testimonial)
                {
                    return redirect()->route('used-car-testimonial')->with('success', 'Used Car Testimonial insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function usedCarTestimonialDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Used Car Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $used_car_testimonial = UsedCarTestimonial::find($id);
                if($used_car_testimonial->image != NULL)
                {
                    $image = $used_car_testimonial->image;
                    if($image)
                    {
                        removeFile('uploads/used_car_testimonial/'.$image);
                    }
                }
                $used_car_testimonial = UsedCarTestimonial::where('id',$id)->delete();
                if($used_car_testimonial)
                {
                    return redirect()->route('used-car-testimonial')->with('success', 'Used Car Testimonial deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
