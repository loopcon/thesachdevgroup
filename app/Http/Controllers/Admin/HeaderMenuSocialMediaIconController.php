<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Header_menu_social_media_icon;
use DataTables;
use File;

class HeaderMenuSocialMediaIconController extends Controller
{
    //header_menu_social_media_icon
    public function header_menu_social_media_icon()
    {
        $has_permission = hasPermission('Header Menu Social Media Icon');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Header Menu Social Media Icon');
                return view("admin.header_menu_social_media_icon.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        }
    }

    public function header_menu_social_media_icon_create()
    {
        $has_permission = hasPermission('Header Menu Social Media Icon');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Header Menu Social Media Icon Create');
                return view("admin.header_menu_social_media_icon.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function header_menu_social_media_icon_insert(Request $request){

        $has_permission = hasPermission('Header Menu Social Media Icon');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $header_menu_social_media_icon = new Header_menu_social_media_icon();

                if($file = $request->hasFile('icon')) {
                    $file = $request->file('icon') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/header_menu_social_media_icon' ;
                    $file->move($destinationPath,$fileName);
                    $header_menu_social_media_icon->icon = $fileName;
                }

                $header_menu_social_media_icon->link = $request->link;
                $header_menu_social_media_icon->save();
        
                return redirect()->route('header_menu_social_media_icon')->with('success','Header Menu Social Media Icon insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function header_menu_social_media_icon_index(Request $request){
        if ($request->ajax()) {
            $header_menu_social_media_icon = Header_menu_social_media_icon::orderBy('id', 'DESC')->get();
            return Datatables::of($header_menu_social_media_icon)
                ->addIndexColumn()
                ->addColumn('action', function($header_menu_social_media_icon){
                    $updateButton = "";
                    $deleteBtn = "";
                    $has_permission = hasPermission('Header Menu Social Media Icon');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $updateButton = "<a href='".route("header_menu_social_media_icon.edit",encrypt($header_menu_social_media_icon->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                            $deleteBtn = "<a href='javascript:void(0);' data-href='".route('header_menu_social_media_icon_destroy',array($header_menu_social_media_icon->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        }
                    }
                return $updateButton . $deleteBtn;
            })

            ->editColumn('icon', function($header_menu_social_media_icon){

                if($header_menu_social_media_icon->icon == NULL){
                    $url= asset('no_image/notImg.png');
                    $image = '<img src="'.$url.'" border="0" width="100">';
                    return $image;

                }else{

                    $url= asset('header_menu_social_media_icon/'.$header_menu_social_media_icon->icon);
                    $image = '<img src="'.$url.'" border="0" width="100">';
                    return $image;
                }
            })

            ->rawColumns(['action','icon'])
            ->make(true);
        }
       
        return redirect()->back()->with('message','something went wrong');
    }

    
    public function header_menu_social_media_icon_edit($id)
    {
        $has_permission = hasPermission('Header Menu Social Media Icon');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Header Menu Social Media Icon Edit');
                $header_menu_social_media_icon = Header_menu_social_media_icon::find($id);
                $return_data['record'] = $header_menu_social_media_icon;
                return view("admin.header_menu_social_media_icon.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    
    public function header_menu_social_media_icon_update(Request $request, $id)
    {

        $has_permission = hasPermission('Header Menu Social Media Icon');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $header_menu_social_media_icon = Header_menu_social_media_icon::find(decrypt($id));

                if($request->hasFile('icon'))
                {
                    $destination = 'public/header_menu_social_media_icon/' . $header_menu_social_media_icon->icon;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('icon');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/header_menu_social_media_icon/', $filename);
                    $header_menu_social_media_icon->icon = $filename;
                }

                $header_menu_social_media_icon->link = $request->link;
                $header_menu_social_media_icon->save();

                return redirect()->route('header_menu_social_media_icon')->with('success','Header Menu Social Media Icon update successfully.');
    
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }
    
    public function header_menu_social_media_icon_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Header Menu Social Media Icon');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $header_menu_social_media_icon = Header_menu_social_media_icon::find($id);
                if($header_menu_social_media_icon->icon != NULL)
                {
                    $image = public_path("header_menu_social_media_icon/{$header_menu_social_media_icon->icon}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                $header_menu_social_media_icon = Header_menu_social_media_icon::where('id',$id)->delete();
                if($header_menu_social_media_icon)
                {
                    return redirect()->route('header_menu_social_media_icon')->with('message', 'Header Menu Social Media Icon deleted successfully');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }
}
