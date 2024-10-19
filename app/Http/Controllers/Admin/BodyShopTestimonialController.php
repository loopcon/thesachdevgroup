<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Body_shop;
use App\Models\BodyShopTestimonial;
use App\Models\ModulePermission;
use DataTables;
use File;
use Auth;

class BodyShopTestimonialController extends Controller
{
    public function bodyShopTestimonialList()
    {
        $has_permission = hasPermission('Body Shop Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop Testimonial');
                return view("admin.body_shop_testimonial.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function bodyShopTestimonialCreate(Request $request)
    {
        $has_permission = hasPermission('Body Shop Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop Testimonial Create');
                $return_data['body_shop'] = Body_shop::select('id', 'name')->get();
                return view("admin.body_shop_testimonial.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function bodyShopTestimonialStore(Request $request)
    {
        $has_permission = hasPermission('Body Shop Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'body_shop_id' => 'required',
                    'name' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,webp',
                ]);
                $body_shop_testimonial = new BodyShopTestimonial();
                $fields = array('body_shop_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family');
                foreach($fields as $field)
                {
                    $body_shop_testimonial->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $image = fileUpload($request, 'image', 'uploads/body_shop_testimonial');
                    $body_shop_testimonial->image = $image;
                }

                $body_shop_testimonial->save();

                if($body_shop_testimonial)
                {
                    return redirect()->route('body-shop-testimonial')->with('success', 'Body Shop Testimonial insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function bodyShopTestimonialDatatable(Request $request)
    {
        if($request->ajax()){
            $query = BodyShopTestimonial::with('bodyShopDetail')->select('id', 'body_shop_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family', 'image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $image = $list->image ? asset('uploads/body_shop_testimonial/'.$list->image) : '';
                    return '<img src="' . $image . '" alt="" width="50">';
                })
                ->addColumn('body_shop_id', function($list){
                    $body_shop_id = isset($list->bodyShopDetail->name) && $list->bodyShopDetail->name ? $list->bodyShopDetail->name : NULL;
                    return $body_shop_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Body Shop Testimonial');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('body-shop-testimonial-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('body-shop-testimonial-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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

    public function bodyShopTestimonialEdit($id)
    {
        $has_permission = hasPermission('Body Shop Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Body Shop Testimonial Edit');
                $service = BodyShopTestimonial::find($id);
                $return_data['record'] = $service;
                $return_data['body_shop'] = Body_shop::select('id', 'name')->get();
                return view("admin.body_shop_testimonial.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function bodyShopTestimonialUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Body Shop Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            $id = decrypt($id);
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'body_shop_id' => 'required',
                    'name' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $body_shop_testimonial = BodyShopTestimonial::find($id);
                $fields = array('body_shop_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'name_background_color', 'description', 'description_text_size', 'description_text_color', 'description_font_family');
                foreach($fields as $field)
                {
                    $body_shop_testimonial->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $oldimage = $body_shop_testimonial->image;
                    if($oldimage)
                    {
                        removeFile('uploads/body_shop_testimonial/'.$oldimage);
                    }
                    $image = fileUpload($request, 'image', 'uploads/body_shop_testimonial');
                    $body_shop_testimonial->image = $image;
                }

                $body_shop_testimonial->save();

                if($body_shop_testimonial)
                {
                    return redirect()->route('body-shop-testimonial')->with('success', 'Body Shop Testimonial insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function bodyShopTestimonialDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Body Shop Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $body_shop_testimonial = BodyShopTestimonial::find($id);
                if($body_shop_testimonial->image != NULL)
                {
                    $image = $body_shop_testimonial->image;
                    if($image)
                    {
                        removeFile('uploads/body_shop_testimonial/'.$image);
                    }
                }
                $body_shop_testimonial = BodyShopTestimonial::where('id',$id)->delete();
                if($body_shop_testimonial)
                {
                    return redirect()->route('body-shop-testimonial')->with('success', 'Body Shop Testimonial deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
