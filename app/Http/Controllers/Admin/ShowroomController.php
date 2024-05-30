<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Showroom;
use App\Models\Showroom_facility_customer_gallery;
use App\Models\OurBusiness;
use App\Models\ShowroomContatQuery;
use App\Models\Header_menu;
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
                $request->validate([
                    'our_business_id' => 'required',
                    'name' => 'required',
                    'slider_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'address_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'working_hours_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'contact_number_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'email_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'brand_id' => 'required',
                    'car_id' => 'required',
                    'address' => 'required',
                    'working_hours' => 'required',
                    'contact_number' => 'required|numeric',
                    'email' => 'required',
                    'rating' => 'required',
                    'number_of_rating' => 'required',

                ]);
                $showroom = new Showroom();
                $feilds = array('our_business_id','slider_showroom_name','slider_showroom_name_color','slider_showroom_name_font_size','slider_showroom_name_font_family','name','name_color','name_font_size','name_font_family','brand_id','address','working_hours','contact_number','email','address_color','address_font_size','address_font_family','working_hours_color','working_hours_font_size','working_hours_font_family','working_hours_icon','contact_number_color','contact_number_font_size','contact_number_font_family','email_color','email_font_size','email_font_family','rating','number_of_rating','description','description_color','description_font_size','description_font_family','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size','email_title_font_family','map_link');
                foreach($feilds as $field)
                {
                    $showroom->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                }

                $showroom->slug = $request->name ? slugify($request->name) : NULL;
                $showroom->car_id = json_encode($request->car_id);

                if($file = $request->hasFile('slider_image')) {
                    $file = $request->file('slider_image');
                    $extension = $file->getClientOriginalExtension();
                    $sliderImagefileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_slider_image' ;
                    $file->move($destinationPath,$sliderImagefileName);
                    $showroom->slider_image = $sliderImagefileName;
                }

                if($file = $request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $ImagefileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_image' ;
                    $file->move($destinationPath,$ImagefileName);
                    $showroom->image = $ImagefileName;
                }

                if($file = $request->hasFile('address_icon')) {
                    $file = $request->file('address_icon');
                    $extension = $file->getClientOriginalExtension();
                    $addressiconfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_address_icon' ;
                    $file->move($destinationPath,$addressiconfileName);
                    $showroom->address_icon = $addressiconfileName;
                }

                if($file = $request->hasFile('working_hours_icon')) {
                    $file = $request->file('working_hours_icon');
                    $extension = $file->getClientOriginalExtension();
                    $working_hours_iconfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_working_hours_icon' ;
                    $file->move($destinationPath,$working_hours_iconfileName);
                    $showroom->working_hours_icon = $working_hours_iconfileName;
                }

                if($file = $request->hasFile('contact_number_icon')) {
                    $file = $request->file('contact_number_icon');
                    $extension = $file->getClientOriginalExtension();
                    $callfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_contact_number_icon' ;
                    $file->move($destinationPath,$callfileName);
                    $showroom->contact_number_icon = $callfileName;
                }

                if($file = $request->hasFile('email_icon')) {
                    $file = $request->file('email_icon');
                    $extension = $file->getClientOriginalExtension();
                    $IconfileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/showrooms_email_icon' ;
                    $file->move($destinationPath,$IconfileName);
                    $showroom->email_icon = $IconfileName;
                }

                if($request->hasFile('lets_connect_image')) {
                    $lets_connect_image = fileUpload($request, 'lets_connect_image', 'uploads/showroom/lets_connect_image');
                    $showroom->lets_connect_image = $lets_connect_image;
                }
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
                $request->validate([
                    'our_business_id' => 'required',
                    'name' => 'required',
                    'slider_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'address_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'working_hours_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'contact_number_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'email_icon' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'brand_id' => 'required',
                    'car_id' => 'required',
                    'address' => 'required',
                    'working_hours' => 'required',
                    'contact_number' => 'required|numeric',
                    'email' => 'required',
                    'rating' => 'required',
                    'number_of_rating' => 'required',

                ]);
                $showroom = Showroom::find($id);
                $feilds = array('our_business_id','slider_showroom_name','slider_showroom_name_color','slider_showroom_name_font_size','slider_showroom_name_font_family','name','name_color','name_font_size','name_font_family','brand_id','address','working_hours','contact_number','email','address_color','address_font_size','address_font_family','working_hours_color','working_hours_font_size','working_hours_font_family','working_hours_icon','contact_number_color','contact_number_font_size','contact_number_font_family','email_color','email_font_size','email_font_family','rating','number_of_rating','description','description_color','description_font_size','description_font_family','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size','email_title_font_family','map_link');
                foreach($feilds as $field)
                {
                    $showroom->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                }

                $showroom->slug = $request->name ? slugify($request->name) : NULL;
                $showroom->car_id = json_encode($request->car_id);

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

                if($request->hasFile('lets_connect_image')) {
                    $oldimage = $showroom->lets_connect_image;
                    if($oldimage)
                    {
                        removeFile('uploads/showroom/lets_connect_image/'.$oldimage);
                    }
                    $lets_connect_image = fileUpload($request, 'lets_connect_image', 'uploads/showroom/lets_connect_image');
                    $showroom->lets_connect_image = $lets_connect_image;
                }
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
                        return redirect()->route('showroom_list')->with('success', 'Car deleted successfully.');
                    }
                }
            } else {
                return redirect('dashboard')->with('error', trans('You do not have permission to access this page!'));
            }

        } else {
            return redirect('dashboard')->with('error', trans('You do not have permission to access this page!'));
        }

    }

    public function getcarname(Request $request)
    {
        $cars = Car::where('brand_id',$request->brand_id)->get();
        return $cars;
    }

    public function showroomContactQueryList(Request $request)
    {
        $has_permission = hasPermission('Showroom Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Showroom Contact Query');
                return view("admin.showroom_contact_query.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }

    }

    public function showroomContactQueryDatatable(Request $request)
    {
        if($request->ajax()){
            $query = ShowroomContatQuery::with('ourService')->select('id', 'first_name','phone','email','our_service')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('our_service', function($list){
                    $our_service = isset($list->ourService->name) && $list->ourService->name ? $list->ourService->name : NULL;
                    return $our_service;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Showroom Contact Query');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $html .= "<span class='text-nowrap'>";
                            $html .= "<a href='".url('showroom-contact-query-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                            $html .= "<a href='javascript:void(0);' data-href='".route('showroom-contact-query-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function showroomContactQueryEdit($id)
    {
        $has_permission = hasPermission('Showroom Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Showroom Contact Query Edit');
                $return_data['our_services'] = Header_menu::where('menu_name','Our Services')->get();
                $return_data['record'] = ShowroomContatQuery::find($id);

                return view('admin.showroom_contact_query.form',array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function showroomContactQueryUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Showroom Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'first_name' => 'required',
                    'email' => 'required',
                    'phone' => 'required|numeric',
                ]);

                $showroom_contact_query = ShowroomContatQuery::find($id);
                $showroom_contact_query->first_name = $request->first_name;
                $showroom_contact_query->email = $request->email;
                $showroom_contact_query->phone = $request->phone;
                $showroom_contact_query->our_service = $request->our_service;
                $showroom_contact_query->description = $request->description;
                $showroom_contact_query->save();

                if($showroom_contact_query)
                {
                    return redirect()->route('showroom-contact-query')->with('success','Showrooom Contact Query update successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong, please try again later!');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function showroomContactQueryDestroy($id)
    {
        $has_permission = hasPermission('Showroom Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $showroom_contact_query = ShowroomContatQuery::where('id',$id)->delete();

                if($showroom_contact_query)
                {
                    return redirect()->back()->with('success','Showroom Contact Query deleted successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong, please try again later!');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }

    }
}

