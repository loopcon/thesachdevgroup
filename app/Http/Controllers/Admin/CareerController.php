<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CareerForm;
use App\Models\ModulePermission;
use App\Models\User;
use App\Models\OurBusiness;
use App\Exports\ExportCareerForm;
use DataTables;
use Excel;
use Constant;
use Auth;

class CareerController extends Controller
{
    public function career()
    {
        $has_permission = hasPermission('Vacancies');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Career');
                $return_data['record'] = Career::first();
                return view("admin.career.index",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function careerUpdate(Request $request)
    {
        $has_permission = hasPermission('Vacancies');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $request->validate([
                    'banner_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'offer_first_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'offer_second_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'offer_third_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'offer_main_title' => 'required',
                ]);
                $career = Career::first();
                if(isset($career->id) && $career->id)
                {
                    $id = $career->id;
                    $career = Career::find($id);
                    $fields = array('offer_main_title', 'offer_main_title_color', 'offer_main_title_font_size', 'offer_main_title_font_family', 'offer_first_title', 'offer_first_title_color', 'offer_first_title_font_size', 'offer_first_title_font_family', 'offer_first_description', 'offer_first_description_font_size', 'offer_first_description_font_family', 'offer_first_description_font_color', 'offer_second_title', 'offer_second_title_color', 'offer_second_title_font_size', 'offer_second_title_font_family', 'offer_second_description', 'offer_second_description_font_color', 'offer_second_description_font_size', 'offer_second_description_font_family', 'offer_third_title', 'offer_third_title_color', 'offer_third_title_font_size', 'offer_third_title_font_family', 'offer_third_description', 'offer_third_description_font_color', 'offer_third_description_font_size', 'offer_third_description_font_family', 'vacancy_title', 'vacancy_title_color', 'vacancy_title_font_size', 'vacancy_title_font_family', 'vacancy_sub_title', 'vacancy_sub_title_color', 'vacancy_sub_title_font_size', 'vacancy_sub_title_font_family');
                    foreach($fields as $field)
                    {
                        $career->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }
                    if($request->hasFile('banner_image')) {
                        $oldimage = $career->banner_image;
                        if($oldimage)
                        {
                            removeFile('uploads/career'.$oldimage);
                        }
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/career');
                        $career->banner_image = $banner_image;
                    }
                    if($request->hasFile('offer_first_icon')) {
                        $oldimage = $career->offer_first_icon;
                        if($oldimage)
                        {
                            removeFile('uploads/career_icon1'.$oldimage);
                        }
                        $offer_first_icon = fileUpload($request, 'offer_first_icon', 'uploads/career_icon1');
                        $career->offer_first_icon = $offer_first_icon;
                    }

                    if($request->hasFile('offer_second_icon')) {
                        $oldimage = $career->offer_second_icon;
                        if($oldimage)
                        {
                            removeFile('uploads/career_icon2'.$oldimage);
                        }
                        $offer_second_icon = fileUpload($request, 'offer_second_icon', 'uploads/career_icon2');
                        $career->offer_second_icon = $offer_second_icon;
                    }

                    if($request->hasFile('offer_third_icon')) {
                        $oldimage = $career->offer_third_icon;
                        if($oldimage)
                        {
                            removeFile('uploads/career_icon3'.$oldimage);
                        }
                        $offer_third_icon = fileUpload($request, 'offer_third_icon', 'uploads/career_icon3');
                        $career->offer_third_icon = $offer_third_icon;
                    }

                    $career->save();
                }else{

                    $request->validate([
                        'banner_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                        'offer_first_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                        'offer_second_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                        'offer_third_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                        'offer_main_title' => 'required',
                    ]);

                    $career = new Career();
                    $fields = array('banner_image', 'offer_main_title', 'offer_main_title_color', 'offer_main_title_font_size', 'offer_main_title_font_family', 'offer_first_icon', 'offer_first_title', 'offer_first_title_color', 'offer_first_title_font_size', 'offer_first_title_font_family', 'offer_first_description', 'offer_first_description_font_size', 'offer_first_description_font_family', 'offer_first_description_font_color', 'offer_second_icon', 'offer_second_title', 'offer_second_title_color', 'offer_second_title_font_size', 'offer_second_title_font_family', 'offer_second_description', 'offer_second_description_font_color', 'offer_second_description_font_size', 'offer_second_description_font_family', 'offer_third_icon', 'offer_third_title', 'offer_third_title_color', 'offer_third_title_font_size', 'offer_third_title_font_family', 'offer_third_description', 'offer_third_description_font_color', 'offer_third_description_font_size', 'offer_third_description_font_family', 'vacancy_title', 'vacancy_title_color', 'vacancy_title_font_size', 'vacancy_title_font_family', 'vacancy_sub_title', 'vacancy_sub_title_color', 'vacancy_sub_title_font_size', 'vacancy_sub_title_font_family');
                    foreach($fields as $field)
                    {
                        $career->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }
                    
                    if($request->hasFile('banner_image')) {
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/career');
                        $career->banner_image = $banner_image;
                    }

                    if($request->hasFile('offer_first_icon')) {
                        $offer_first_icon = fileUpload($request, 'offer_first_icon', 'uploads/career_icon1');
                        $career->offer_first_icon = $offer_first_icon;
                    }

                    if($request->hasFile('offer_second_icon')) {
                        $offer_second_icon = fileUpload($request, 'offer_second_icon', 'uploads/career_icon2');
                        $career->offer_second_icon = $offer_second_icon;
                    }

                    if($request->hasFile('offer_third_icon')) {
                        $offer_third_icon = fileUpload($request, 'offer_third_icon', 'uploads/career_icon3');
                        $career->offer_third_icon = $offer_third_icon;
                    }

                    $career->save();
                }
                if($career)
                {
                    return redirect()->back()->with('success', trans('Career update successfully.'));
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

    public function careerFormList()
    {
        $has_permission = hasPermission('Career Form');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Career Form');

                return view("admin.career_form.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function careerFormDataTable(Request $request)
    {
        $user_role_id = User::select('id','role_id','business_id','showroom_id','service_center_id','body_shop_id','used_car_id')->where([['id',Auth::user()->id],['role_id',Auth::user()->role_id]])->first();
        if($user_role_id->role_id == constant::HR)
        {
            if($request->ajax()){
                $query = CareerForm::with('businessDetail','showroomDetail','serviceCenterDetail','bodyShopDetail','usedCarDetail')->where([['business_id',$user_role_id->business_id],['service_center_id',$user_role_id->service_center_id],['showroom_id',$user_role_id->showroom_id],['body_shop_id',$user_role_id->body_shop_id],['used_car_id',$user_role_id->used_car_id]])->select('id', 'business_id', 'showroom_id', 'service_center_id', 'body_shop_id', 'used_car_id', 'first_name', 'last_name', 'contact_no', 'post_apply_for', 'resume', 'email')->orderBy('id', 'DESC');

                $list = $query->get();
                return DataTables::of($list)
                ->addColumn('business_id', function($list){
                    $business_id = isset($list->businessDetail->title) && $list->businessDetail->title ? $list->businessDetail->title : NULL;
                    return $business_id;
                })
                ->addColumn('showroom_id', function($list){
                    $showroom_id = isset($list->showroomDetail->name) && $list->showroomDetail->name ? $list->showroomDetail->name : NULL;
                    return $showroom_id;
                })
                ->addColumn('service_center_id', function($list){
                    $service_center_id = isset($list->serviceCenterDetail->name) && $list->serviceCenterDetail->name ? $list->serviceCenterDetail->name : NULL;
                    return $service_center_id;
                })
                ->addColumn('body_shop_id', function($list){
                    $body_shop_id = isset($list->bodyShopDetail->name) && $list->bodyShopDetail->name ? $list->bodyShopDetail->name : NULL;
                    return $body_shop_id;
                })
                ->addColumn('used_car_id', function($list){
                    $used_car_id = isset($list->usedCarDetail->name) && $list->usedCarDetail->name ? $list->usedCarDetail->name : NULL;
                    return $used_car_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Career Form');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".route('career-form-edit',array($id))."' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('career-form-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "<a href='".url('public/uploads/career/resume/'.$list->resume)."' rel='tooltip' title='".trans('Pdf')."' class='btn btn-secondary btn-sm'download><i class='fa fa-file-pdf'>&nbsp;</i></a>&nbsp";
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

        if($request->ajax()){
            $query = CareerForm::with('businessDetail','showroomDetail','serviceCenterDetail','bodyShopDetail','usedCarDetail')->select('id', 'business_id', 'showroom_id', 'service_center_id', 'body_shop_id', 'used_car_id', 'first_name', 'last_name', 'contact_no', 'post_apply_for', 'resume', 'email')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('business_id', function($list){
                    $business_id = isset($list->businessDetail->title) && $list->businessDetail->title ? $list->businessDetail->title : NULL;
                    return $business_id;
                })
                ->addColumn('showroom_id', function($list){
                    $showroom_id = isset($list->showroomDetail->name) && $list->showroomDetail->name ? $list->showroomDetail->name : NULL;
                    return $showroom_id;
                })
                ->addColumn('service_center_id', function($list){
                    $service_center_id = isset($list->serviceCenterDetail->name) && $list->serviceCenterDetail->name ? $list->serviceCenterDetail->name : NULL;
                    return $service_center_id;
                })
                ->addColumn('body_shop_id', function($list){
                    $body_shop_id = isset($list->bodyShopDetail->name) && $list->bodyShopDetail->name ? $list->bodyShopDetail->name : NULL;
                    return $body_shop_id;
                })
                ->addColumn('used_car_id', function($list){
                    $used_car_id = isset($list->usedCarDetail->name) && $list->usedCarDetail->name ? $list->usedCarDetail->name : NULL;
                    return $used_car_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Career Form');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".route('career-form-edit',array($id))."' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('career-form-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        if($list->resume)
                        {
                            $html .= "<a href='".url('public/uploads/career/resume/'.$list->resume)."' rel='tooltip' title='".trans('Pdf')."' class='btn btn-secondary btn-sm' download><i class='fa fa-file-pdf'>&nbsp;</i></a>&nbsp";
                        }
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

    public function careerFormEdit($id)
    {
        $has_permission = hasPermission('Career Form');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $return_data = array();
                $return_data['site_title'] = trans('Career Form Edit');
                $return_data['record'] = CareerForm::find($id);
                
                return view('admin.career_form.form',array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function careerFormUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Career Form');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'first_name' => 'required',
                    'email' => 'required',
                    'contact_no' => 'required|numeric',
                    'resume' => 'mimes:pdf,docx,jpg,png,jpeg,webp',
                ]);

                $career_form = CareerForm::find($id);
                $career_form->first_name = $request->first_name;
                $career_form->last_name = $request->last_name;
                $career_form->email = $request->email;
                $career_form->contact_no = $request->contact_no;
                $career_form->post_apply_for = $request->post_apply_for;
                if($request->hasFile('resume'))
                {
                    $oldimage = $career_form->resume;
                    if($oldimage)
                    {
                        removeFile('uploads/career/resume'.$oldimage);
                    }
                    $resume = fileUpload($request, 'resume', 'uploads/career/resume');
                    $career_form->resume = $resume;
                }
                
                $career_form->save();
                if($career_form)
                {
                    return redirect()->route('career-form')->with('success','Career Form update successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong,please try again letter.');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function careerFormDestroy($id)
    {
        $has_permission = hasPermission('Career Form');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $career_form = CareerForm::where('id',$id)->delete();

                if($career_form)
                {
                    return redirect('career-form')->with('success',trans('Career Form deleted successfully.'));
                }else{
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function export()
    {
        return Excel::download(new ExportCareerForm, 'careerFrom.xlsx');
    }
}
