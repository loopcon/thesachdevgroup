<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Awards;
use App\Models\Showroom;
use DataTables;
use File;

class AwardsController extends Controller
{
    public function awardList()
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Awards');
                return view("admin.award.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function ajaxAwardHtml(request $request)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                if($request->ajax()){
                    $id = $request->id;
                    $id = $id ? decrypt($id) : NULL;
                    $record = $id ? Awards::find($id) : NULL;
                    $showrooms = Showroom::select('id', 'name')->get();
                    $html = view('admin.award.ajax_form', array('record' => $record, 'showrooms' => $showrooms))->render();
                    $return = array();
                    $return['html'] = $html;
                    echo json_encode($return);
                } else {
                    return redirect('dashboard');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardStore(Request $request)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'showroom_id' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);

                $award = new Awards();
                $award->showroom_id = $request->showroom_id ? $request->showroom_id : NULL;
                $award->name = $request->name ? $request->name : NULL;
                if($request->hasFile('image')) {
                    $image = fileUpload($request, 'image', 'uploads/award');
                    $award->image = $image;
                }
                $award->save();

                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardDatatable(Request $request)
    {
        if($request->ajax()){
            $query = Awards::with('showroomdDetail')->select('id', 'showroom_id', 'name', 'image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $image = $list->image ? asset('uploads/award/'.$list->image) : '';
                    return '<img src="' . $image . '" alt="" width="100">';
                }) 
                ->addColumn('showroom_id', function($list){
                    $showroom_id = isset($list->showroomdDetail->name) && $list->showroomdDetail->name ? $list->showroomdDetail->name : NULL;
                    return $showroom_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Awards');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='javascript:void(0);' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('award-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['image', 'showroom_id', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function awardUpdate(Request $request, $id)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'showroom_id' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $award = Awards::find($id);
                $award->showroom_id = $request->showroom_id ? $request->showroom_id : NULL;
                $award->name = $request->name ? $request->name : NULL;

                if($request->hasFile('image')) {
                    $oldimg = $award->image;
                    if($oldimg)
                    {
                        removeFile('uploads/award/'.$oldimg);
                    }
                    $image = fileUpload($request, 'image', 'uploads/award');
                    $award->image = $image;
                }
                $award->save();

                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $award = Awards::find($id);
                if($award->image != NULL)
                {
                    $image = $award->image;
                    if($image)
                    {
                        removeFile('uploads/award/'.$image);
                    }
                }
                $award = Awards::where('id',$id)->delete();
                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
