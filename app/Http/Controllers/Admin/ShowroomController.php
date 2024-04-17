<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Showroom;
use App\Models\Showroom_facility_customer_gallery;
use App\Models\OurBusiness;
use DataTables;
use File;

class ShowroomController extends Controller
{
    //showroom

    public function showroom(Request $request){
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $brands = Brand::get();
                $our_business = OurBusiness::get();
                return view("admin.showroom.form",compact('brands','our_business')); 
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
    
    public function showroom_insert(Request $request){
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $showroom = new Showroom();

                $showroom->our_business_id = $request->our_business_id;

                if($file = $request->hasFile('slider_image')) {
                    $file = $request->file('slider_image');
                    $extension = $file->getClientOriginalExtension();
                    $sliderImagefileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_slider_image' ;
                    $file->move($destinationPath,$sliderImagefileName);
                    $showroom->slider_image = $sliderImagefileName;
                }

                $showroom->slider_showroom_name = $request->slider_showroom_name;
                $showroom->slider_showroom_color = $request->slider_showroom_color;
                $showroom->slider_showroom_font_size = $request->slider_showroom_font_size;
                $showroom->slider_showroom_font_family = $request->slider_showroom_font_family;
                
                if($file = $request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $ImagefileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_image' ;
                    $file->move($destinationPath,$ImagefileName);
                    $showroom->image = $ImagefileName;
                }

                $showroom->name = $request->name;
                $showroom->name_color = $request->name_color;
                $showroom->name_font_size = $request->name_font_size;
                $showroom->name_font_family = $request->name_font_family;

                $showroom->brand_id = $request->brand_id;
                $showroom->car_id = json_encode($request->car_id);
                $showroom->address = $request->address;
                $showroom->working_hours = $request->working_hours;
                $showroom->contact_number = $request->contact_number;
                $showroom->email = $request->email;

                $showroom->address_color = $request->address_color;
                $showroom->address_font_size = $request->address_font_size;
                $showroom->address_font_family = $request->address_font_family;

                if($file = $request->hasFile('address_icon')) {
                    $file = $request->file('address_icon');
                    $extension = $file->getClientOriginalExtension();
                    $addressiconfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_address_icon' ;
                    $file->move($destinationPath,$addressiconfileName);
                    $showroom->address_icon = $addressiconfileName;
                }

                $showroom->working_hours_color = $request->working_hours_color;
                $showroom->working_hours_font_size = $request->working_hours_font_size;
                $showroom->working_hours_font_family = $request->working_hours_font_family;

                if($file = $request->hasFile('working_hours_icon')) {
                    $file = $request->file('working_hours_icon');
                    $extension = $file->getClientOriginalExtension();
                    $working_hours_iconfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_working_hours_icon' ;
                    $file->move($destinationPath,$working_hours_iconfileName);
                    $showroom->working_hours_icon = $working_hours_iconfileName;
                }

                $showroom->contact_number_color = $request->contact_number_color;
                $showroom->contact_number_font_size = $request->contact_number_font_size;
                $showroom->contact_number_font_family = $request->contact_number_font_family;

                if($file = $request->hasFile('contact_number_icon')) {
                    $file = $request->file('contact_number_icon');
                    $extension = $file->getClientOriginalExtension();
                    $callfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_contact_number_icon' ;
                    $file->move($destinationPath,$callfileName);
                    $showroom->contact_number_icon = $callfileName;
                }

                $showroom->email_color = $request->email_color;
                $showroom->email_font_size = $request->email_font_size;
                $showroom->email_font_family = $request->email_font_family;


                if($file = $request->hasFile('email_icon')) {
                    $file = $request->file('email_icon');
                    $extension = $file->getClientOriginalExtension();
                    $IconfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_email_icon' ;
                    $file->move($destinationPath,$IconfileName);
                    $showroom->email_icon = $IconfileName;
                }

                $showroom->rating = $request->rating;
                $showroom->number_of_rating = $request->number_of_rating;

                $showroom->description = $request->description;
                $showroom->description_color = $request->description_color;
                $showroom->description_font_size = $request->description_font_size;
                $showroom->description_font_family = $request->description_font_family;
                $showroom->save();

                return redirect()->route('showroom_list')->with('success','Showroom insert successfully.');
    
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
    
    public function showroom_list(Request $request){
        $has_showroom_permission = hasPermission('Showroom');
        $has_facility_customer_gallery_permission = hasPermission('Showroom Facility Customer Gallery');

        if(($has_showroom_permission && ($has_showroom_permission->read_permission == 1 || $has_showroom_permission->full_permission == 1)) ||
            ($has_facility_customer_gallery_permission && ($has_facility_customer_gallery_permission->read_permission == 1 || $has_facility_customer_gallery_permission->full_permission == 1))) {
            
            $return_data = array();
            $return_data['showrooms'] = Showroom::select('id', 'name')->get();
            return view("admin.showroom.show",array_merge($return_data));
        
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    
    }

    public function showroom_index(Request $request){
        if ($request->ajax()) {
            $showroom = Showroom::with('brand','car')->orderBy('id', 'DESC')->get();
            return Datatables::of($showroom)
                    ->addIndexColumn()
                    ->addColumn('action', function($showroom){
    
                        $updateButton = "";
                        $deleteBtn = "";
                        $has_permission = hasPermission('Showroom');
                        if(isset($has_permission) && $has_permission)
                        {
                            if($has_permission->full_permission == 1)
                            {
                                $updateButton = "<a href='".route("showroom.edit",['showroom_edit' => encrypt($showroom->id), 'brand_id' => $showroom->brand_id])."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                                $deleteBtn = "<a href='javascript:void(0);' data-href='".route('showroom_destroy',array($showroom->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            }
                        }
                    return $updateButton . $deleteBtn;
                    })

                ->editColumn('our_business_id', function($showroom){
                    $our_business_name =  isset($showroom->our_business->title) && $showroom->our_business->title ? $showroom->our_business->title: NULL;
                    return $our_business_name;
                })

                ->editColumn('slider_image', function($showroom){

                    if(isset($showroom->slider_image) && isset($showroom->slider_image)){
                        $url= asset('showrooms_slider_image/'.$showroom->slider_image);
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;
                    }
                })

                ->editColumn('image', function($showroom){

                    if(isset($showroom->image) && isset($showroom->image)){
                        $url= asset('showrooms_image/'.$showroom->image);
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;
                    }
                })

                ->editColumn('brand', function($showroom){
                    $brand_name =  isset($showroom->brand->name) && $showroom->brand->name ? $showroom->brand->name: NULL;
                    return $brand_name;
                })
                ->editColumn('description', function($showroom) {
                    $description = $showroom->description;  
                    return $description;
                })
                
                ->editColumn('car', function($showroom) {
                    $car_ids = json_decode($showroom->car_id); 
                    $car_names = Car::whereIn('id', $car_ids)->pluck('name')->implode(', '); 
                    return $car_names;
                })

                ->editColumn('address_icon', function($showroom){

                    if(isset($showroom->address_icon) && isset($showroom->address_icon)){
                        $url= asset('showrooms_address_icon/'.$showroom->address_icon);
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;
                    }
                })

                ->editColumn('working_hours_icon', function($showroom){

                    if(isset($showroom->working_hours_icon) && isset($showroom->working_hours_icon)){
                        $url= asset('showrooms_working_hours_icon/'.$showroom->working_hours_icon);
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;
                    }
                })

                ->editColumn('contact_number_icon', function($showroom){

                    if(isset($showroom->contact_number_icon) && isset($showroom->contact_number_icon)){
                        $url= asset('showrooms_contact_number_icon/'.$showroom->contact_number_icon);
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;
                    }
                })

                ->editColumn('email_icon', function($showroom){

                    if(isset($showroom->email_icon) && isset($showroom->email_icon)){
                        $url= asset('showrooms_email_icon/'.$showroom->email_icon);
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;
                    }
                })

            ->rawColumns(['action','our_business_id','slider_image','image','brand','car','description','address_icon','working_hours_icon','contact_number_icon','email_icon'])
            ->make(true);
        }
        
    }
    
    public function showroom_edit($id,$brand_id){
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $showrooms  = Showroom::where('id',decrypt($id))->get();
                $our_business = OurBusiness::get();
                $brands = Brand::get();
                $cars = Car::where('brand_id',$brand_id)->get();
                return view('admin.showroom._form',compact('our_business','showrooms','brands','cars'));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function showroom_update(Request $request, $id)
    {
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $showroom = Showroom::find($id);

                $showroom->our_business_id = $request->our_business_id;


                if($request->hasFile('slider_image'))
                {
                    $destination = 'public/showrooms_slider_image/' . $showroom->slider_image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('slider_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/showrooms_slider_image/', $filename);
                    $showroom->slider_image = $filename;
                }

                $showroom->slider_showroom_name = $request->slider_showroom_name;
                $showroom->slider_showroom_color = $request->slider_showroom_color;
                $showroom->slider_showroom_font_size = $request->slider_showroom_font_size;
                $showroom->slider_showroom_font_family = $request->slider_showroom_font_family;

                if($request->hasFile('image'))
                {
                    $destination = 'public/showrooms_image/' . $showroom->image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/showrooms_image/', $filename);
                    $showroom->image = $filename;
                }

                $showroom->name = $request->name;
                
                $showroom->name_color = $request->name_color;
                $showroom->name_font_size = $request->name_font_size;
                $showroom->name_font_family = $request->name_font_family;

                $showroom->brand_id = $request->brand_id;
                $showroom->car_id = json_encode($request->car_id);
                $showroom->address = $request->address;
                $showroom->working_hours = $request->working_hours;
                $showroom->contact_number = $request->contact_number;
                $showroom->email = $request->email;

                $showroom->address_color = $request->address_color;
                $showroom->address_font_size = $request->address_font_size;
                $showroom->address_font_family = $request->address_font_family;

                if($request->hasFile('address_icon'))
                {
                    $destination = 'public/showrooms_address_icon/' . $showroom->address_icon;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('address_icon');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/showrooms_address_icon/', $filename);
                    $showroom->address_icon = $filename;
                }

                $showroom->working_hours_color = $request->working_hours_color;
                $showroom->working_hours_font_size = $request->working_hours_font_size;
                $showroom->working_hours_font_family = $request->working_hours_font_family;

                if($request->hasFile('working_hours_icon'))
                {
                    $destination = 'public/showrooms_working_hours_icon/' . $showroom->working_hours_icon;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('working_hours_icon');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/showrooms_working_hours_icon/', $filename);
                    $showroom->working_hours_icon = $filename;
                }

                $showroom->contact_number_color = $request->contact_number_color;
                $showroom->contact_number_font_size = $request->contact_number_font_size;
                $showroom->contact_number_font_family = $request->contact_number_font_family;

                if($request->hasFile('contact_number_icon'))
                {
                    $destination = 'public/showrooms_contact_number_icon/' . $showroom->contact_number_icon;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('contact_number_icon');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/showrooms_contact_number_icon/', $filename);
                    $showroom->contact_number_icon = $filename;
                }

                $showroom->email_color = $request->email_color;
                $showroom->email_font_size = $request->email_font_size;
                $showroom->email_font_family = $request->email_font_family;

                if($request->hasFile('email_icon'))
                {
                    $destination = 'public/showrooms_email_icon/' . $showroom->email_icon;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('email_icon');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/showrooms_email_icon/', $filename);
                    $showroom->email_icon = $filename;
                }

                $showroom->rating = $request->rating;
                $showroom->number_of_rating = $request->number_of_rating;

                $showroom->description = $request->description;
                $showroom->description_color = $request->description_color;
                $showroom->description_font_size = $request->description_font_size;
                $showroom->description_font_family = $request->description_font_family;
                
                $showroom->save();

                return redirect()->route('showroom_list')->with('success','Showroom update successfully.');
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    public function showroom_destroy(Request $request,$id){

        $has_permission = hasPermission('Showroom');
        
        if(isset($has_permission) && $has_permission) {

            if($has_permission->full_permission == 1) {

                $showroom = Showroom::findOrFail($id);

                if (Showroom_facility_customer_gallery::where('showroom_id', $id)->exists()) {
                    return redirect('showroom_list')->with('error', trans('Showroom facility customer gallery associated with this showroom exist. Cannot delete showroom.'));
                } else {

                    if($showroom->slider_image != NULL)
                    {
                        $image = public_path("showrooms_slider_image/{$showroom->slider_image}");
                        if (File::exists($image)) {
                            unlink($image);
                        }
                    }

                    if($showroom->image != NULL)
                    {
                        $image = public_path("showrooms_image/{$showroom->image}");
                        if (File::exists($image)) {
                            unlink($image);
                        }
                    }

                    if($showroom->address_icon != NULL)
                    {
                        $image = public_path("showrooms_address_icon/{$showroom->address_icon}");
                        if (File::exists($image)) {
                            unlink($image);
                        }
                    }

                    if($showroom->working_hours_icon != NULL)
                    {
                        $image = public_path("showrooms_working_hours_icon/{$showroom->working_hours_icon}");
                        if (File::exists($image)) {
                            unlink($image);
                        }
                    }

                    if($showroom->contact_number_icon != NULL)
                    {
                        $image = public_path("showrooms_contact_number_icon/{$showroom->contact_number_icon}");
                        if (File::exists($image)) {
                            unlink($image);
                        }
                    }

                    if($showroom->email_icon != NULL)
                    {
                        $image = public_path("showrooms_email_icon/{$showroom->email_icon}");
                        if (File::exists($image)) {
                            unlink($image);
                        }
                    }

                    $showroom->delete();

                    if($showroom)
                    {
                        return redirect()->route('showroom_list')->with('message', 'Car deleted successfully');
                    }
                }
            } else {
                return redirect('dashboard')->with('error', trans('You do not have permission to access this page!'));
            }

        } else {
            return redirect('dashboard')->with('error', trans('You do not have permission to access this page!'));
        }

    }

    public function getcarname(Request $request){
        $cars = Car::where('brand_id',$request->brand_id)->get();
        return $cars;
    }
}

