<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission_vision;
use DataTables;
use File;

class MissionVisionController extends Controller
{
    //mission_vision
    public function mission_vision()
    {
        $has_permission = hasPermission('Mission Vision');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Mission Vision');
                return view("admin.mission_vision.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        }
    }

    public function missionVisionCreate()
    {
        $has_permission = hasPermission('Mission Vision');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Mission Vision Create');
                return view("admin.mission_vision.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function mission_vision_insert(Request $request){

        $has_permission = hasPermission('Mission Vision');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
  
                $mission_vision = new Mission_vision();

                if($file = $request->hasFile('icon')) {
                    $file = $request->file('icon') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/mission_vision' ;
                    $file->move($destinationPath,$fileName);
                    $mission_vision->icon = $fileName;
                }

                $mission_vision->icon_name = $request->icon_name;
                $mission_vision->title = $request->title;
                $mission_vision->icon_name_color = $request->icon_name_color;
                $mission_vision->icon_name_font_size = $request->icon_name_font_size;
                $mission_vision->icon_name_font_family = $request->icon_name_font_family;

                $mission_vision->title_color = $request->title_color;
                $mission_vision->title_font_size = $request->title_font_size;
                $mission_vision->title_font_family = $request->title_font_family;

                $mission_vision->description = $request->description;

                $mission_vision->description_color = $request->description_color;
                $mission_vision->description_font_size = $request->description_font_size;
                $mission_vision->description_font_family = $request->description_font_family;
                $mission_vision->save();
        
                return redirect()->route('mission_vision')->with('success','Mission Vision insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function mission_vision_index(Request $request){
        if ($request->ajax()) {
            $mission_vision = Mission_vision::orderBy('id', 'DESC')->get();
            return Datatables::of($mission_vision)
                ->addIndexColumn()
                ->addColumn('action', function($mission_vision){
                    $updateButton = "";
                    $deleteBtn = "";
                    $has_permission = hasPermission('Mission Vision');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $updateButton = "<a href='".route("mission_vision.edit",encrypt($mission_vision->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                            $deleteBtn = "<a href='javascript:void(0);' data-href='".route('mission_vision_destroy',array($mission_vision->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        }
                    }
                return $updateButton . $deleteBtn;
            })

            ->editColumn('icon', function($mission_vision){

                if($mission_vision->icon == NULL){
                    $url= asset('no_image/notImg.png');
                    $image = '<img src="'.$url.'" border="0" width="100">';
                    return $image;

                }else{

                    $url= asset('mission_vision/'.$mission_vision->icon);
                    $image = '<img src="'.$url.'" border="0" width="100">';
                    return $image;
                }
            })

            ->editColumn('description', function($mission_vision){

                $description = $mission_vision->description;
                return $description;
            })

            ->rawColumns(['action','icon','description'])
            ->make(true);
        }
       
        return redirect()->back()->with('message','something went wrong');
    }

    public function mission_vision_edit($id)
    {
        $has_permission = hasPermission('Mission Vision');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Mission Vision Edit');
                $mission_vision = Mission_vision::find($id);
                $return_data['record'] = $mission_vision;
                return view("admin.mission_vision.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    
    public function mission_vision_update(Request $request, $id)
    {

        $has_permission = hasPermission('Mission Vision');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $mission_vision = Mission_vision::find(decrypt($id));

                if($request->hasFile('icon'))
                {
                    $destination = 'public/mission_vision/' . $mission_vision->icon;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('icon');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/mission_vision/', $filename);
                    $mission_vision->icon = $filename;
                }

                $mission_vision->icon_name = $request->icon_name;
                $mission_vision->title = $request->title;
                $mission_vision->icon_name_color = $request->icon_name_color;
                $mission_vision->icon_name_font_size = $request->icon_name_font_size;
                $mission_vision->icon_name_font_family = $request->icon_name_font_family;

                $mission_vision->title_color = $request->title_color;
                $mission_vision->title_font_size = $request->title_font_size;
                $mission_vision->title_font_family = $request->title_font_family;

                $mission_vision->description = $request->description;

                $mission_vision->description_color = $request->description_color;
                $mission_vision->description_font_size = $request->description_font_size;
                $mission_vision->description_font_family = $request->description_font_family;
                $mission_vision->save();

                return redirect()->route('mission_vision')->with('success','Mission Vision update successfully.');
    
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    public function mission_vision_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Mission Vision');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $mission_vision = Mission_vision::find($id);
                if($mission_vision->icon != NULL)
                {
                    $image = public_path("mission_vision/{$mission_vision->icon}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                $mission_vision = Mission_vision::where('id',$id)->delete();
                if($mission_vision)
                {
                    return redirect()->route('mission_vision')->with('message', 'Mission Vision deleted successfully');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }
}
