<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurBusiness;
use App\Models\Header_menu;
use App\Models\Car;
use App\Models\Service;
use DataTables;
use File;
use Auth;

class OurBusinessController extends Controller
{
    public function ourBusinessList()
    {
        $has_permission = hasPermission('Business');
       
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Our Business');
                return view("admin.our_business.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function ourBusinessCreate(Request $request)
    {
        $has_permission = hasPermission('Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Our Business Create');
                $return_data['our_business'] = Header_menu::select('id','name','menu_name')->where('menu_name','=','Our Businesses')->get();
                $return_data['cars'] = Car::select('id','name')->get();
                $return_data['services'] = Service::select('id','name')->get();

                return view("admin.our_business.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ourBusinessStore(Request $request)
    {
        $has_permission = hasPermission('Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'page_link' => 'required',
                    'title' => 'required|unique:our_business',
                    'banner_image' => 'image|mimes:jpeg,png,jpg,webp',
                    'why_choose_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $our_business = new OurBusiness();
                $fields = array('title', 'slug', 'description', 'page_link', 'url', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family', 'why_choose_title', 'why_choose_title_color', 'why_choose_title_font_size', 'why_choose_title_font_family', 'why_choose_description', 'why_choose_description_color', 'why_choose_description_font_size', 'why_choose_description_font_family','showroom_title', 'showroom_title_color', 'showroom_title_font_size', 'showroom_title_font_family', 'service_center_title', 'service_center_title_color', 'service_center_title_font_size', 'service_center_title_font_family', 'body_shop_title', 'body_shop_title_color', 'body_shop_title_font_size', 'body_shop_title_font_family', 'insurance_title', 'insurance_title_color', 'insurance_title_font_size', 'insurance_title_font_family','used_car_title', 'used_car_title_color', 'used_car_title_font_size', 'used_car_title_font_family');
                foreach($fields as $field)
                {
                    $our_business->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                $our_business->slug = $request->title ? slugify($request->title) : NULL;
                $our_business->car_id = isset($request->car_id) && $request->car_id ? json_encode($request->car_id) : NULL;
                $our_business->service_id = isset($request->service_id) && $request->service_id ? json_encode($request->service_id) : NULL;

                if($request->hasFile('banner_image')) {
                    $banner_image = fileUpload($request, 'banner_image', 'uploads/our_business');
                    $our_business->banner_image = $banner_image;
                }

                if($request->hasFile('why_choose_image')) {
                    $why_choose_image = fileUpload($request, 'why_choose_image', 'uploads/our_business_why_choose');
                    $our_business->why_choose_image = $why_choose_image;
                }

                $our_business->save();

                if($our_business)
                {
                    return redirect()->route('our-business')->with('success', 'Our Business insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ourBusinessDatatable(Request $request)
    {
        if($request->ajax()){
            $query = OurBusiness::with('carDetail','serviceDetail')->select('id', 'car_id', 'service_id', 'title', 'slug', 'description', 'banner_image', 'url', 'page_link', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('banner_image', function($list){
                    $imageSrc = $list->banner_image ? asset('uploads/our_business/'.$list->banner_image) : '';
                    return '<img src="' . $imageSrc . '" alt="" width="100">';
                })
                ->addColumn('car_id', function($list){
                    $car_id = json_decode($list->car_id); 
                    $car_names = isset($car_id) && $car_id ? Car::whereIn('id', $car_id)->pluck('name')->implode(', ') : ''; 
                    return $car_names;
                })
                ->addColumn('service_id', function($list){
                    $service_id = json_decode($list->service_id); 
                    $service = isset($service_id) && $service_id ? Service::whereIn('id', $service_id)->pluck('name')->implode(', ') : ''; 
                    return $service;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Business');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('our-business-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('our-business-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['banner_image', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function ourBusinessEdit($id)
    {
        $has_permission = hasPermission('Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Our Business Edit');
                $our_business = OurBusiness::find($id);
                $return_data['record'] = $our_business;
                $return_data['our_business'] = Header_menu::select('id','name','menu_name')->where('menu_name','=','Our Businesses')->get();
                $return_data['cars'] = Car::select('id','name')->get();
                $return_data['services'] = Service::select('id','name')->get();
                return view("admin.our_business.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function ourBusinessUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'page_link' => 'required',
                    'title' => 'required|unique:our_business,title,'.$id,
                    'banner_image' => 'image|mimes:jpeg,png,jpg,webp',
                    'why_choose_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $our_business = OurBusiness::find($id);
                $fields = array('title', 'slug', 'description', 'page_link', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family', 'why_choose_title', 'why_choose_title_color', 'why_choose_title_font_size', 'why_choose_title_font_family', 'why_choose_description', 'why_choose_description_color', 'why_choose_description_font_size', 'why_choose_description_font_family','showroom_title', 'showroom_title_color', 'showroom_title_font_size', 'showroom_title_font_family', 'service_center_title', 'service_center_title_color', 'service_center_title_font_size', 'service_center_title_font_family', 'body_shop_title', 'body_shop_title_color', 'body_shop_title_font_size', 'body_shop_title_font_family', 'insurance_title', 'insurance_title_color', 'insurance_title_font_size', 'insurance_title_font_family','used_car_title', 'used_car_title_color', 'used_car_title_font_size', 'used_car_title_font_family');
                foreach($fields as $field)
                {
                    $our_business->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->page_link == 0)
                {
                    $our_business->url = $request->url;
                }else{
                    $our_business->url = NULL;
                }
                $our_business->slug = $request->title ? slugify($request->title) : NULL;
                $our_business->car_id = isset($request->car_id) && $request->car_id ? json_encode($request->car_id) : NULL;
                $our_business->service_id = isset($request->service_id) && $request->service_id ? json_encode($request->service_id) : NULL;

                if($request->hasFile('banner_image')) {
                    $oldimage = $our_business->banner_image;
                    if($oldimage)
                    {
                        removeFile('uploads/our_business'.$oldimage);
                    }
                    $banner_image = fileUpload($request, 'banner_image', 'uploads/our_business');
                    $our_business->banner_image = $banner_image;
                }

                if($request->hasFile('why_choose_image')) {
                    $oldimage = $our_business->why_choose_image;
                    if($oldimage)
                    {
                        removeFile('uploads/our_business_why_choose'.$oldimage);
                    }
                    $why_choose_image = fileUpload($request, 'why_choose_image', 'uploads/our_business_why_choose');
                    $our_business->why_choose_image = $why_choose_image;
                }

                $our_business->save();

                if($our_business)
                {
                    return redirect()->route('our-business')->with('success', 'Our Business update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ourBusinessDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $our_business = OurBusiness::find($id);
                if($our_business->banner_image != NULL)
                {
                    $our_business_image = $our_business->banner_image;
                    if($our_business_image)
                    {
                        removeFile('uploads/our_business/'.$our_business_image);
                    }
                }

                if($our_business->why_choose_image != NULL)
                {
                    $why_choose_image = $our_business->why_choose_image;
                    if($why_choose_image)
                    {
                        removeFile('uploads/our_business_why_choose/'.$why_choose_image);
                    }
                }
                $our_business = OurBusiness::where('id',$id)->delete();
                if($our_business)
                {
                    return redirect()->route('our-business')->with('success', 'Our Business deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
