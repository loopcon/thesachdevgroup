<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Count;
use DataTables;
use File;

class CountController extends Controller
{
    
    //count
    public function count(Request $request){
        $has_permission = hasPermission('Count');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Count');
                return view("admin.count.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function countCreate()
    {
        $has_permission = hasPermission('Count');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Count Create');
                return view("admin.count.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function count_insert(Request $request){

        $has_permission = hasPermission('Count');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $count = new Count();

                if($file = $request->hasFile('icon')) {
                    $file = $request->file('icon') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/count_icon' ;
                    $file->move($destinationPath,$fileName);
                    $count->icon = $fileName;
                }

                $count->amount = $request->amount;

                $count->amount_color = $request->amount_color;
                $count->amount_font_size = $request->amount_font_size;
                $count->amount_font_family = $request->amount_font_family;

                $count->name = $request->name;

                $count->name_color = $request->name_color;
                $count->name_font_size = $request->name_font_size;
                $count->name_font_family = $request->name_font_family;

                $count->background_color = $request->background_color;
                $count->save();
        
                return redirect()->route('count')->with('success','Count insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function count_index(Request $request){
        if ($request->ajax()) {
            $count = Count::orderBy('id', 'DESC')->get();
            return Datatables::of($count)
                ->addIndexColumn()
                ->addColumn('action', function($count){
                    $updateButton = "";
                    $deleteBtn = "";
                    $has_permission = hasPermission('Count');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $updateButton = "<a href='".route("count.edit",encrypt($count->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                            $deleteBtn = "<a href='javascript:void(0);' data-href='".route('count_destroy',array($count->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        }
                    }
                return $updateButton . $deleteBtn;
            })

            ->editColumn('icon', function($count){

                if(isset($count->icon) && isset($count->icon)){
                    $url= asset('count_icon/'.$count->icon);
                    $image = '<img src="'.$url.'" border="0" width="100">';
                    return $image;
                }
            })

            ->rawColumns(['action','icon'])
            ->make(true);
        }
       
        return redirect()->back()->with('message','something went wrong');
    }

    public function count_edit($id)
    {
        $has_permission = hasPermission('Count');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Count Edit');
                $count = Count::find($id);
                $return_data['record'] = $count;
                return view("admin.count.form",array_merge($return_data));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function count_update(Request $request, $id)
    {

        $has_permission = hasPermission('Count');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $count = Count::find(decrypt($id));

                if($request->hasFile('icon'))
                {
                    $destination = 'public/count_icon/' . $count->icon;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('icon');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/count_icon/', $filename);
                    $count->icon = $filename;
                }

                $count->amount = $request->amount;

                $count->amount_color = $request->amount_color;
                $count->amount_font_size = $request->amount_font_size;
                $count->amount_font_family = $request->amount_font_family;

                $count->name = $request->name;

                $count->name_color = $request->name_color;
                $count->name_font_size = $request->name_font_size;
                $count->name_font_family = $request->name_font_family;

                $count->background_color = $request->background_color;
                $count->save();

                return redirect()->route('count')->with('success','Count update successfully.');
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    public function count_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Count');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $count = Count::find($id);
                if($count->icon != NULL)
                {
                    $image = public_path("count_icon/{$count->icon}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                $count = Count::where('id',$id)->delete();
                if($count)
                {
                    return redirect()->route('count')->with('message', 'Count deleted successfully');
                }
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }
}
