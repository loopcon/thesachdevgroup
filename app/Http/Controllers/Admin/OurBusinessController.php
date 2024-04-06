<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurBusiness;
use App\Models\Header_menu;
use DataTables;
use File;
use Auth;

class OurBusinessController extends Controller
{
    public function ourBusinessList()
    {
        $has_permission = hasPermission('Our Business');
       
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
        $has_permission = hasPermission('Our Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Our Business Create');
                $return_data['our_business'] = Header_menu::select('id','name','menu_name')->where('menu_name','=','our_businesses')->get();
                return view("admin.our_business.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ourBusinessStore(Request $request)
    {
        $has_permission = hasPermission('Our Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'page_link' => 'required',
                    'title' => 'required',
                    'banner_image' => 'required|image|mimes:jpeg,png,jpg,webp',
                ]);
                $our_business = new OurBusiness();
                $fields = array('title', 'slug', 'description', 'page_link', 'url', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family');
                foreach($fields as $field)
                {
                    $our_business->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                $our_business->slug = $request->title ? slugify($request->title) : NULL;
                if($request->hasFile('banner_image')) {
                    $banner_image = fileUpload($request, 'banner_image', 'uploads/our_business');
                    $our_business->banner_image = $banner_image;
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
            $query = OurBusiness::select('id', 'title', 'slug', 'description', 'banner_image', 'url', 'page_link', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('banner_image', function($list){
                    $imageSrc = $list->banner_image ? asset('uploads/our_business/'.$list->banner_image) : '';
                    return '<img src="' . $imageSrc . '" alt="" width="100">';
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Our Business');
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
        $has_permission = hasPermission('Our Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Our Business Edit');
                $our_business = OurBusiness::find($id);
                $return_data['record'] = $our_business;
                $return_data['our_business'] = Header_menu::select('id','name','menu_name')->where('menu_name','=','our_businesses')->get();
                return view("admin.our_business.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function ourBusinessUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Our Business');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'page_link' => 'required',
                    'title' => 'required',
                    'banner_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $our_business = OurBusiness::find($id);
                $fields = array('title', 'slug', 'description', 'page_link', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family');
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
                if($request->hasFile('banner_image')) {
                    $oldimage = $our_business->banner_image;
                    if($oldimage)
                    {
                        removeFile('uploads/our_business'.$oldimage);
                    }
                    $banner_image = fileUpload($request, 'banner_image', 'uploads/our_business');
                    $our_business->banner_image = $banner_image;
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
        $has_permission = hasPermission('Our Business');
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
