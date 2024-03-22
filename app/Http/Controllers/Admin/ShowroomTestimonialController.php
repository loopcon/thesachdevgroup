<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showroom;
use App\Models\ShowroomTestimonial;
use DataTables;
use File;

class ShowroomTestimonialController extends Controller
{
    public function showroomTestimonialList()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Showroom Testimonial');
        return view("admin.showroom_testimonial.list",array_merge($return_data));
    }

    public function showroomTestimonialCreate()
    {
        $return_data = array();
        $return_data['showrooms'] = Showroom::select('id', 'name')->get();
        $return_data['site_title'] = trans('Showroom Testimonial Create');
        return view("admin.showroom_testimonial.form",array_merge($return_data));
    }

    public function showroomTestimonialStore(Request $request)
    {
        $request->validate([
            'showroom_id' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|required',
        ]);
        $showroom_testimonial = new ShowroomTestimonial();
        $showroom_testimonial->showroom_id = $request->showroom_id ? $request->showroom_id : NULL;
        $showroom_testimonial->name = $request->name ? $request->name : NULL;
        $showroom_testimonial->description = $request->description ? $request->description : NULL;

        if($request->hasFile('image')) {
            $newName = fileUpload($request, 'image', 'uploads/showroom_testimonial');
            $showroom_testimonial->image = $newName;
        }
        $showroom_testimonial->save();

        if($showroom_testimonial)
        {
            return redirect()->route('showroom-testimonial')->with('message', 'Showroom testimonial insert succesfully');
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
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='".url('showroom-testimonial-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                    $html .= "<a href='javascript:void(0);' data-href='".route('showroom-testimonial-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['image','showroom','action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function showroomTestimonialEdit($id)
    {
        $return_data = array();
        $id = decrypt($id);
        $return_data['site_title'] = trans('Showrrom Testimonial Edit');
        $return_data['showrooms'] = Showroom::select('id', 'name')->get();
        $showroom_testimonial = ShowroomTestimonial::find($id);
        $return_data['record'] = $showroom_testimonial;
        return view("admin.showroom_testimonial.form",array_merge($return_data));
    }

    public function showroomTestimonialUpdate(Request $request,$id)
    {
        $id = decrypt($id);
        $request->validate([
            'showroom_id' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|required',
        ]);
        $showroom_testimonial = ShowroomTestimonial::find($id);
        $showroom_testimonial->showroom_id = $request->showroom_id ? $request->showroom_id : NULL;
        $showroom_testimonial->name = $request->name ? $request->name : NULL;
        $showroom_testimonial->description = $request->description ? $request->description : NULL;

        if($request->hasFile('image')) {
            $newName = fileUpload($request, 'image', 'uploads/showroom_testimonial');
            $showroom_testimonial->image = $newName;
        }
        $showroom_testimonial->save();

        if($showroom_testimonial)
        {
            return redirect()->route('showroom-testimonial')->with('message', 'Showroom testimonial updated succesfully');
        }
    }

    public function showroomTestimonialDestroy(Request $request, $id)
    {
        $id = decrypt($id);
        $showroom_testimonial = ShowroomTestimonial::where('id',$id)->delete();
        if($showroom_testimonial)
        {
            return redirect()->route('showroom-testimonial')->with('message', 'Showroom testimonial deleted succesfully');
        }
    }
}
