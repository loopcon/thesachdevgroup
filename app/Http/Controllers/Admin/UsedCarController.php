<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Used_car;
use App\Models\OurBusiness;
use DataTables;
use File;

class UsedCarController extends Controller
{
    //used_car
    public function used_car()
    {
        $has_permission = hasPermission('Used Car');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Used Car');
                return view("admin.used_car.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function usedCarCreate()
    {
        $has_permission = hasPermission('Used Car');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Used Car Create');
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
                return view("admin.used_car.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function used_car_insert(Request $request)
    {
        $has_permission = hasPermission('Used Car');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'business_id' => 'required',
                    'name' => 'required',
                    'rating' => 'required',
                    'number_of_rating' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,webp',
                ]);
  
                $used_car = new Used_car();

                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/used_car_image' ;
                    $file->move($destinationPath,$fileName);
                    $used_car->image = $fileName;
                }

                $used_car->name = $request->name;

                $used_car->slug = $request->name ? slugify($request->name) : NULL;

                $used_car->business_id = $request->business_id;
                $used_car->name_color = $request->name_color;
                $used_car->name_font_size	 = $request->name_font_size;
                $used_car->name_font_family	 = $request->name_font_family;
                $used_car->link = $request->link;
                $used_car->rating = $request->rating;
                $used_car->number_of_rating = $request->number_of_rating;
                $used_car->save();
        
                return redirect()->route('used_car')->with('success','Used Car insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function used_car_index(Request $request)
    {
        if ($request->ajax()) {

            $used_car = Used_car::orderBy('id', 'DESC')->get();

            return Datatables::of($used_car)
                ->addIndexColumn()
                ->addColumn('action', function($used_car){
                    $updateButton = "";
                    $deleteBtn = "";
                    $has_permission = hasPermission('Used Car');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $updateButton = "<a href='".route("used_car.edit",encrypt($used_car->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                            $deleteBtn = "<a href='javascript:void(0);' data-href='".route('used_car_destroy',array($used_car->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        }
                    }
                return $updateButton . $deleteBtn;
            })

            ->editColumn('image', function($used_car){

                if(isset($used_car->image) && isset($used_car->image)){
                    $url= asset('used_car_image/'.$used_car->image);
                    $image = '<img src="'.$url.'" border="0" width="100">';
                    return $image;
                }
            })

            ->rawColumns(['action','image'])
            ->make(true);
        }
       
        return redirect()->back()->with('error','something went wrong');
    }

    public function used_car_edit($id)
    {
        $has_permission = hasPermission('Used Car');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Used Car Edit');
                $used_car = Used_car::find($id);
                $return_data['record'] = $used_car;
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
                return view("admin.used_car.form",array_merge($return_data));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }


    public function used_car_update(Request $request, $id)
    {
        $has_permission = hasPermission('Used Car');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'business_id' => 'required',
                    'name' => 'required',
                    'rating' => 'required',
                    'number_of_rating' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $used_car = Used_car::find(decrypt($id));

                if($request->hasFile('image'))
                {
                    $destination = 'public/used_car_image/' . $used_car->image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/used_car_image/', $filename);
                    $used_car->image = $filename;
                }

                $used_car->name = $request->name;

                $used_car->slug = $request->name ? slugify($request->name) : NULL;

                $used_car->business_id = $request->business_id;
                $used_car->name_color = $request->name_color;
                $used_car->name_font_size	 = $request->name_font_size;
                $used_car->name_font_family	 = $request->name_font_family;
                $used_car->link = $request->link;
                $used_car->rating = $request->rating;
                $used_car->number_of_rating = $request->number_of_rating;
                $used_car->save();
                
                return redirect()->route('used_car')->with('success','Used Car update successfully.');
    
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }


    public function used_car_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Used Car');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $used_car_image = Used_car::find($id);

                if($used_car_image->image != NULL)
                {
                    $image = public_path("used_car_image/{$used_car_image->image}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                $used_car_image = Used_car::where('id',$id)->delete();
                if($used_car_image)
                {
                    return redirect()->route('used_car')->with('success', 'Used Car deleted successfully.');
                }
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
