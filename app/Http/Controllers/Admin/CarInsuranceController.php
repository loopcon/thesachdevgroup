<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarInsurance;
use App\Models\Brand;
use App\Models\BookInsurance;
use DataTables;

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
                    $fields = array('title','title_color','title_font_size','title_font_family','insurance_form_title','insurance_form_title_color','insurance_form_title_font_size','insurance_form_title_font_family','description','description_font_color','description_font_size','description_font_family', 'meta_title', 'meta_keyword', 'meta_description');
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
                    $fields = array('title','title_color','title_font_size','title_font_family','insurance_form_title','insurance_form_title_color','insurance_form_title_font_size','insurance_form_title_font_family','description','description_font_color','description_font_size','description_font_family', 'meta_title', 'meta_keyword', 'meta_description');
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

    public function bookedInsurance()
    {
        $has_permission = hasPermission('Car Insurance Query Form');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Car Insurance Query Form');

                return view("admin.booked_insurance.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function bookedInsuranceDatatable(Request $request)
    {
        if($request->ajax()){
            $query = BookInsurance::with('brandDetail')->select('id', 'brand_id', 'first_name', 'phone', 'email')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('brand_id', function($list){
                    $brand_id = isset($list->brandDetail->name) && $list->brandDetail->name ? $list->brandDetail->name : NULL;
                    return $brand_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Car Insurance Query Form');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".route('booked-insurance-edit',array($id))."' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('booked-insurance-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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

    public function bookedInsuranceEdit($id)
    {
        $has_permission = hasPermission('Car Insurance Query Form');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $return_data = array();
                $return_data['site_title'] = trans('Car Insurance Query Form Edit');
                $return_data['brands'] = Brand::select('id','name')->get();
                $return_data['record'] = BookInsurance::find($id);

                return view('admin.booked_insurance.form',array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function bookedInsuranceUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Car Insurance Query Form');
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

                $booked_insurance = BookInsurance::find($id);
                $booked_insurance->first_name = $request->first_name;
                $booked_insurance->phone = $request->phone;
                $booked_insurance->email = $request->email;
                $booked_insurance->brand_id = $request->brand_id;

                $booked_insurance->save();
                if($booked_insurance)
                {
                    return redirect()->route('booked-insurance')->with('success','Car Insurance Query Form update successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong,please try again letter!');
                }

            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function bookedInsuranceDestroy($id)
    {
        $has_permission = hasPermission('Car Insurance Query Form');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $booked_insurance = BookInsurance::where('id',$id)->delete();

                if($booked_insurance)
                {
                    return redirect('booked-insurance')->with('success',trans('Car Insurance Query Form deleted successfully.'));
                }else{
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
