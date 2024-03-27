<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShowroomModel;
use App\Models\Showroom;
use DataTables;
use File;

class ShowroomModelController extends Controller
{
    public function showroomModelList()
    {
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Showroom Model');
                return view("admin.showroom_model.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        }
    }

    public function showroomModelCreate()
    {
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['showrooms'] = Showroom::select('id', 'name')->get();
                $return_data['site_title'] = trans('Showroom Model Create');
                return view("admin.showroom_model.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function showroomModelStore(Request $request)
    {
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'showroom_id' => 'required',
                    'title' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,webp',
                ]);
                $showroom_model = new ShowroomModel();
                $fields = array('showroom_id','title','image','title_text_size','title_text_color','title_font_family','image_size');
                foreach($fields as $field)
                {
                    $showroom_model->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                $showroom_model->slug = isset($request->title) && $request->title ? slugify($request->title) : NULL;
                if($request->hasFile('image')) {
                    $newName = fileUpload($request, 'image', 'uploads/showroom_model');
                    $showroom_model->image = $newName;
                }
                $showroom_model->save();

                if($showroom_model)
                {
                    return redirect()->route('showroom-model')->with('message', 'Showroom Model insert succesfully');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function showroomModelDatatable(Request $request)
    {
        if($request->ajax()){
            $query = ShowroomModel::with('showroomDetail')->select('id', 'title', 'showroom_id', 'image', 'title_text_size','title_text_color','title_font_family','image_size')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $imageSrc = $list->image ? asset('uploads/showroom_model/'.$list->image) : '';
                    return '<img src="' . $imageSrc . '" alt="" width="100">';
                })
                ->addColumn('showroom', function($list){
                    $showroom = isset($list->showroomDetail->name) && $list->showroomDetail->name ? $list->showroomDetail->name : NULL;
                    return $showroom;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Showroom');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->read_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('showroom-model-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('showroom-model-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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

    public function showroomModelEdit($id)
    {
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['showrooms'] = Showroom::select('id', 'name')->get();
                $showroom_model = ShowroomModel::find($id);
                $return_data['record'] = $showroom_model;
                $return_data['site_title'] = trans('Showroom Model Edit');
                return view("admin.showroom_model.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function showroomModelUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'showroom_id' => 'required',
                    'title' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,webp',
                ]);
                $showroom_model = ShowroomModel::find($id);
                $fields = array('showroom_id','title','image','title_text_size','title_text_color','title_font_family','image_size');
                foreach($fields as $field)
                {
                    $showroom_model->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL; 
                }

                $showroom_model->slug = isset($request->title) && $request->title ? slugify($request->title) : NULL;
                if($request->hasFile('image')) {
                    $old_image = public_path("uploads/showroom_model/{$showroom_model->image}");
                    if (File::exists($old_image)) {
                        unlink($old_image);
                    }
                    $newName = fileUpload($request, 'image', 'uploads/showroom_model');
                    $showroom_model->image = $newName;
                }
                $showroom_model->save();

                if($showroom_model)
                {
                    return redirect()->route('showroom-model')->with('message', 'Showroom Model Updated succesfully');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function showroomModelDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $showroom_model = ShowroomModel::find($id);
                if($showroom_model->image != NULL)
                {
                    $image = public_path("uploads/showroom_model/{$showroom_model->image}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                $showroom_model = ShowroomModel::where('id',$id)->delete();
                if($showroom_model)
                {
                    return redirect()->route('showroom-model')->with('message', 'Showroom Model deleted succesfully');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
