<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\OurBusiness;
use File;
use DataTables;
use Auth;

class VacancyController extends Controller
{
    public function vacancyList()
    {
        $has_permission = hasPermission('Vacancies');
       
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Vacancies');
                return view("admin.vacancy.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function vacancyCreate(Request $request)
    {
        $has_permission = hasPermission('Vacancies');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Vacancies Create');
                $return_data['business'] = OurBusiness::select('id', 'title')->get();
                return view("admin.vacancy.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function vacancyStore(Request $request)
    {
        $has_permission = hasPermission('Vacancies');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'business_id' => 'required',
                    'name' => 'required',
                ]);
                $vacancy = new Vacancy();
                $fields = array('business_id', 'showroom_id', 'service_center_id', 'body_shop_id', 'used_car_id', 'name', 'name_font_color', 'name_font_size', 'name_font_family', 'description', 'description_font_color', 'description_font_family', 'description_font_size', 'experience', 'work_level', 'employee_type', 'offer_salary', 'icon_background_color');
                foreach($fields as $field)
                {
                    $vacancy->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $image = fileUpload($request, 'image', 'uploads/vacancy');
                    $vacancy->image = $image;
                }

                if($request->hasFile('icon')) {
                    $icon = fileUpload($request, 'icon', 'uploads/vacancy_icon');
                    $vacancy->icon = $icon;
                }
                $vacancy->save();

                if($vacancy)
                {
                    return redirect()->route('vacancies')->with('success', 'vacancy insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function vacancyDatatable(Request $request)
    {
        if($request->ajax()){
            $query = Vacancy::with('businessDetail')->select('id', 'business_id', 'showroom_id', 'service_center_id', 'body_shop_id', 'used_car_id', 'name','name_font_color', 'name_font_size', 'name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'icon', 'image', 'experience', 'work_level', 'employee_type', 'offer_salary')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $imageSrc = $list->image ? asset('uploads/vacancy/'.$list->image) : '';
                    return '<img src="' . $imageSrc . '" alt="" width="100">';
                })
                ->addColumn('icon', function($list){
                    $icon = $list->icon ? asset('uploads/vacancy_icon/'.$list->icon) : '';
                    return '<img src="' . $icon . '" alt="" width="100">';
                })
                ->addColumn('business_id', function($list){
                    $business_id = isset($list->businessDetail->title) && $list->businessDetail->title ? $list->businessDetail->title : NULL;
                    return $business_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('vacancies');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('vacancy-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('vacancy-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['image', 'icon', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function vacancyEdit(Request $request,$id)
    {
        $has_permission = hasPermission('Vacancies');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Vacancies Edit');
                $id = decrypt($id);
                $vacancy = Vacancy::find($id);
                $return_data['record'] = $vacancy;
                $return_data['business'] = OurBusiness::select('id', 'title')->get();
                return view("admin.vacancy.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function vacancyUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Vacancies');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'business_id' => 'required',
                    'name' => 'required',
                ]);
                $vacancy = Vacancy::find($id);
                $fields = array('business_id', 'name', 'name_font_color', 'name_font_size', 'name_font_family', 'description', 'description_font_color', 'description_font_family', 'description_font_size', 'experience', 'work_level', 'employee_type', 'offer_salary', 'icon_background_color');
                foreach($fields as $field)
                {
                    $vacancy->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                $vacancy->showroom_id = $request->showroom_id ? $request->showroom_id : NULL;
                $vacancy->service_center_id = $request->service_center_id ? $request->service_center_id : NULL;
                $vacancy->body_shop_id = $request->body_shop_id ? $request->body_shop_id : NULL;
                $vacancy->used_car_id = $request->used_car_id ? $request->used_car_id : NULL;

                if($request->hasFile('image')) {
                    $oldimage = $vacancy->image;
                    if($oldimage)
                    {
                        removeFile('uploads/vacancy'.$oldimage);
                    }
                    $image = fileUpload($request, 'image', 'uploads/vacancy');
                    $vacancy->image = $image;
                }

                if($request->hasFile('icon')) {
                    $oldicon = $vacancy->icon;
                    if($oldicon)
                    {
                        removeFile('uploads/vacancy_icon'.$oldicon);
                    }
                    $icon = fileUpload($request, 'icon', 'uploads/vacancy_icon');
                    $vacancy->icon = $icon;
                }
                $vacancy->save();

                if($vacancy)
                {
                    return redirect()->route('vacancies')->with('success', 'vacancy update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function vacancyDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Vacancies');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $vacancy = Vacancy::find($id);
                if($vacancy->image != NULL)
                {
                    $vacancy_image = $vacancy->image;
                    if($vacancy_image)
                    {
                        removeFile('uploads/vacancy/'.$vacancy_image);
                    }
                }

                if($vacancy->icon != NULL)
                {
                    $icon = $vacancy->icon;
                    if($icon)
                    {
                        removeFile('uploads/vacancy_icon/'.$icon);
                    }
                }
                $vacancy = Vacancy::where('id',$id)->delete();
                if($vacancy)
                {
                    return redirect()->route('vacancies')->with('success', 'Vacancy deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
