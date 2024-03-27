<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showroom;
use App\Models\ShowroomTestimonial;
use App\Models\ModulePermission;
use DataTables;
use File;
use Auth;

class ShowroomTestimonialController extends Controller
{
    public function showroomTestimonialList()
    {
        $has_permission = hasPermission('Showroom Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Showroom Testimonial');
                return view("admin.showroom_testimonial.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function showroomTestimonialCreate()
    {
        $has_permission = hasPermission('Showroom Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['showrooms'] = Showroom::select('id', 'name')->get();
                $return_data['site_title'] = trans('Showroom Testimonial Create');
                return view("admin.showroom_testimonial.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function showroomTestimonialStore(Request $request)
    {
        $has_permission = hasPermission('Showroom Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'showroom_id' => 'required',
                    'name' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,webp',
                ]);
                $showroom_testimonial = new ShowroomTestimonial();
                $fields = array('showroom_id','name','description','name_text_size','name_text_color','name_font_family','name_background_color','description_text_size','description_text_color','description_font_family');
                foreach($fields as $field)
                {
                    $showroom_testimonial->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $newName = fileUpload($request, 'image', 'uploads/showroom_testimonial');
                    $showroom_testimonial->image = $newName;
                }
                $showroom_testimonial->save();

                if($showroom_testimonial)
                {
                    return redirect()->route('showroom-testimonial')->with('message', 'Showroom testimonial insert succesfully');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function showroomTestimonialDatatable(Request $request)
    {
        if($request->ajax()){
            $query = ShowroomTestimonial::with('showroomDetail')->select('id', 'name', 'showroom_id', 'image', 'description')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $imageSrc = $list->image ? asset('uploads/showroom_testimonial/'.$list->image) : '';
                    return '<img src="' . $imageSrc . '" alt="" width="100">';
                })
                ->addColumn('showroom', function($list){
                    $showroom = isset($list->showroomDetail->name) && $list->showroomDetail->name ? $list->showroomDetail->name : NULL;
                    return $showroom;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Showroom Testimonial');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->read_permission == 1)
                        {
                            $html .= "<span class='text-nowrap'>";
                            $html .= "<a href='".url('showroom-testimonial-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                            $html .= "<a href='javascript:void(0);' data-href='".route('showroom-testimonial-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['image','showroom','action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function showroomTestimonialEdit($id)
    {
        $has_permission = hasPermission('Showroom Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Showrrom Testimonial Edit');
                $return_data['showrooms'] = Showroom::select('id', 'name')->get();
                $showroom_testimonial = ShowroomTestimonial::find($id);
                $return_data['record'] = $showroom_testimonial;
                return view("admin.showroom_testimonial.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function showroomTestimonialUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Showroom Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'showroom_id' => 'required',
                    'name' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,webp',
                ]);
                $showroom_testimonial = ShowroomTestimonial::find($id);
                $fields = array('showroom_id','name','description','name_text_size','name_text_color','name_font_family','name_background_color','description_text_size','description_text_color','description_font_family');
                foreach($fields as $field)
                {
                    $showroom_testimonial->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                if($request->hasFile('image')) {
                    $old_image = public_path("uploads/showroom_testimonial/{$showroom_testimonial->image}");
                    if (File::exists($old_image)) {
                        unlink($old_image);
                    }
                    $newName = fileUpload($request, 'image', 'uploads/showroom_testimonial');
                    $showroom_testimonial->image = $newName;
                }
                $showroom_testimonial->save();

                if($showroom_testimonial)
                {
                    return redirect()->route('showroom-testimonial')->with('message', 'Showroom testimonial updated succesfully');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function showroomTestimonialDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Showroom Testimonial');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $showroom_testimonial = ShowroomTestimonial::find($id);
                if($showroom_testimonial->image != NULL)
                {
                    $image = public_path("uploads/showroom_testimonial/{$showroom_testimonial->image}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                $showroom_testimonial = ShowroomTestimonial::where('id',$id)->delete();
                if($showroom_testimonial)
                {
                    return redirect()->route('showroom-testimonial')->with('message', 'Showroom testimonial deleted succesfully');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
