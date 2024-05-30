<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Showroom;
use App\Models\Showroom_facility_customer_gallery;
use DataTables;
use File;

class ShowroomFacilityCustomerGalleryController extends Controller
{
    //showroom_facility_customer_gallery
    public function showroom_facility_customer_gallery()
    {
        $has_permission = hasPermission('Showroom Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Showroom Facility Customer Gallery');
                return view("admin.showroom_facility_customer_gallery.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function showroom_facility_customer_gallery_insert(Request $request){

        $has_permission = hasPermission('Showroom Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
  
                $showroom_facility_customer_gallery = new Showroom_facility_customer_gallery();
                $showroom_facility_customer_gallery->showroom_id = $request->showroom_id;

                if($file = $request->hasFile('facility_image')) {
                    $file = $request->file('facility_image') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/showroom_facility_image' ;
                    $file->move($destinationPath,$fileName);
                    $showroom_facility_customer_gallery->facility_image = $fileName;
                }

                if($file = $request->hasFile('customer_gallery_image')) {
                    $file = $request->file('customer_gallery_image') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/showroom_customer_gallery_image' ;
                    $file->move($destinationPath,$fileName);
                    $showroom_facility_customer_gallery->customer_gallery_image = $fileName;
                }

                $showroom_facility_customer_gallery->save();
        
                return redirect()->route('showroom_list')->with('success','Showroom Facility Customer Gallery insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    
    public function showroom_facility_customer_gallery_index(Request $request){
        if ($request->ajax()) {

            $showroom_facility_customer_gallery = Showroom_facility_customer_gallery::orderBy('id', 'DESC')->get();
            return Datatables::of($showroom_facility_customer_gallery)
                ->addIndexColumn()
                ->addColumn('action', function($showroom_facility_customer_gallery){
                    $updateButton = "";
                    $deleteBtn = "";
                    $has_permission = hasPermission('Showroom Facility Customer Gallery');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $updateButton = "<a rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm edit' data-id='".$showroom_facility_customer_gallery->id."' data-toggle='modal' data-target='#FacilityCustomerGalleryEditModal'><i class='fas fa-pencil-alt'></i></a>&nbsp";       
                            $deleteBtn = "<a href='javascript:void(0);' data-href='".route('showroom_facility_customer_gallery_destroy',array($showroom_facility_customer_gallery->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm showroom_facility_customer_gallery_delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        }
                    }
                return $updateButton . $deleteBtn;
            })

            ->editColumn('showroom', function($showroom){
                $showroom_name = isset($showroom->showroom->name) && $showroom->showroom->name ? $showroom->showroom->name: NULL;
                return $showroom_name;
            })

            ->editColumn('facility_image', function($showroom_facility_customer_gallery){

                if(isset($showroom_facility_customer_gallery->facility_image) && isset($showroom_facility_customer_gallery->facility_image)){
                    $url= asset('showroom_facility_image/'.$showroom_facility_customer_gallery->facility_image);
                    $image = '<img src="'.$url.'" border="0" width="100">';
                    return $image;
                }
            })

            ->editColumn('customer_gallery_image', function($showroom_facility_customer_gallery){

                if(isset($showroom_facility_customer_gallery->customer_gallery_image) && isset($showroom_facility_customer_gallery->customer_gallery_image)){
                    $url= asset('showroom_customer_gallery_image/'.$showroom_facility_customer_gallery->customer_gallery_image);
                    $image = '<img src="'.$url.'" border="0" width="100">';
                    return $image;
                }
            })

            ->rawColumns(['action','facility_image','customer_gallery_image'])
            ->make(true);
        }
       
        return redirect()->back()->with('error','something went wrong');
    }

    public function showroom_facility_customer_gallery_edit(Request $request){

        $has_permission = hasPermission('Showroom Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $showroom_facility_customer_gallery = Showroom_facility_customer_gallery::find($request->id);
                $return_data['record'] = $showroom_facility_customer_gallery;
                return response()->json($return_data);
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    
    public function showroom_facility_customer_gallery_update(Request $request){

        $has_permission = hasPermission('Showroom Facility Customer Gallery');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $showroom_facility_customer_gallery = Showroom_facility_customer_gallery::find($request->id);
                $showroom_facility_customer_gallery->showroom_id = $request->showroom_id;

                if($request->hasFile('facility_image'))
                {
                    $destination = 'public/showroom_facility_image/' . $showroom_facility_customer_gallery->facility_image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('facility_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/showroom_facility_image/', $filename);
                    $showroom_facility_customer_gallery->facility_image = $filename;
                }

                if($request->hasFile('customer_gallery_image'))
                {
                    $destination = 'public/showroom_customer_gallery_image/' . $showroom_facility_customer_gallery->customer_gallery_image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('customer_gallery_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/showroom_customer_gallery_image/', $filename);
                    $showroom_facility_customer_gallery->customer_gallery_image = $filename;
                }

                $showroom_facility_customer_gallery->save();

                return redirect()->route('showroom_list')->with('success','Showroom Facility Customer Gallery update successfully.');
    
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }


    public function showroom_facility_customer_gallery_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Showroom Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $showroom_facility_customer_gallery = Showroom_facility_customer_gallery::find($id);
                if($showroom_facility_customer_gallery->facility_image != NULL)
                {
                    $image = public_path("showroom_facility_image/{$showroom_facility_customer_gallery->facility_image}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }

                if($showroom_facility_customer_gallery->customer_gallery_image != NULL)
                {
                    $image = public_path("showroom_customer_gallery_image/{$showroom_facility_customer_gallery->customer_gallery_image}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                
                $showroom_facility_customer_gallery->delete();

                if($showroom_facility_customer_gallery)
                {
                    return redirect()->route('showroom_list')->with('success', 'Showroom Facility Customer Gallery deleted successfully.');
                }
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

}
