<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurBusiness;
use App\Models\OurBusinessInsurance;
use File;
use DataTables;

class OurBusinessInsuranceController extends Controller
{
    public function ourBusinessInsuranceList()
    {
        $has_permission = hasPermission('Business Insurance');
       
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Business Insurance');
                return view("admin.our_business_insurance.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function ourBusinessInsuraceCreate(Request $request)
    {
        $has_permission = hasPermission('Business Insurance');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Business Insurance Create');
                $return_data['business'] = OurBusiness::select('id','title')->get();
                return view("admin.our_business_insurance.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ourBusinessInsuranceStore(Request $request)
    {
        $has_permission = hasPermission('Business Insurance');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'business_id' => 'required',
                    'name' => 'required',
                    'icon' => 'required|image|mimes:jpeg,png,jpg,webp',
                ]);
                $our_business_insurance = new OurBusinessInsurance();
                $fields = array('business_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'url');
                foreach($fields as $field)
                {
                    $our_business_insurance->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('icon')) {
                    $icon = fileUpload($request, 'icon', 'uploads/our_business_insurance');
                    $our_business_insurance->icon = $icon;
                }

                $our_business_insurance->save();

                if($our_business_insurance)
                {
                    return redirect()->route('our-business-insurance')->with('success', 'Business Insurance insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ourBusinessInsuranceDatatable(Request $request)
    {
        if($request->ajax()){
            $query = OurBusinessInsurance::with('businessDetail')->select('id', 'icon', 'business_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'url')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('icon', function($list){
                    $icon = $list->icon ? asset('uploads/our_business_insurance/'.$list->icon) : '';
                    return '<img src="' . $icon . '" alt="" width="50">';
                })
                ->addColumn('business_id', function($list){
                    $business_id = isset($list->businessDetail->title) && $list->businessDetail->title ? $list->businessDetail->title : NULL;
                    return $business_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Business Insurance');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('our-business-insurance-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('our-business-insurance-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['icon', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function ourBusinessInsuranceEdit($id)
    {
        $has_permission = hasPermission('Business Insurance');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Business Insurance Edit');
                $our_business_insurance = OurBusinessInsurance::find($id);
                $return_data['record'] = $our_business_insurance;
                $return_data['business'] = OurBusiness::select('id','title')->get();
                return view("admin.our_business_insurance.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function ourBusinessInsuranceUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Business Insurance');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'business_id' => 'required',
                    'name' => 'required',
                    'icon' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $our_business_insurance = OurBusinessInsurance::find($id);
                $fields = array('business_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'url');
                foreach($fields as $field)
                {
                    $our_business_insurance->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('icon')) {
                    $old_icon = $our_business_insurance->icon;
                    if($old_icon)
                    {
                        removeFile('uploads/our_business_insurance/'.$old_icon);
                    }
                    $icon = fileUpload($request, 'icon', 'uploads/our_business_insurance');
                    $our_business_insurance->icon = $icon;
                }

                $our_business_insurance->save();

                if($our_business_insurance)
                {
                    return redirect()->route('our-business-insurance')->with('success', 'Business Insurance update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ourBusinessInsuranceDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Business Insurance');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $our_business_insurance = OurBusinessInsurance::find($id);
                if($our_business_insurance->icon != NULL)
                {
                    $icon = $our_business_insurance->icon;
                    if($icon)
                    {
                        removeFile('uploads/our_business_insurance/'.$icon);
                    }
                }
                $our_business_insurance = OurBusinessInsurance::where('id',$id)->delete();
                if($our_business_insurance)
                {
                    return redirect()->route('our-business-insurance')->with('success', 'Business insurance deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
