<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Used_car;
use App\Models\OurBusiness;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Header_menu;
use App\Models\UsedCarContactQuery;
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
                $return_data['brands'] = Brand::select('id','name')->get();
                $return_data['cars'] = Car::select('id','name')->get();

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
                $fields = array('name','business_id','name_color','name_font_size','name_font_family','link','rating','number_of_rating','brand_id','description','description_font_size','description_font_family','description_font_color','address','address_font_family','address_font_color','working_hours','working_hours_font_size','working_hours_font_family','working_hours_font_color','contact_number','contact_font_family','contact_font_size','contact_font_color','email','email_font_color','email_font_size','email_font_family','facility_title','facility_title_font_size','facility_title_font_family','facility_title_font_color','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size','email_title_font_family','meta_title','meta_keyword','meta_description');
                foreach($fields as $field)
                {
                    $used_car->$fields = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                }

                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/used_car_image' ;
                    $file->move($destinationPath,$fileName);
                    $used_car->image = $fileName;
                }

                if($file = $request->hasFile('address_icon')) {

                    $address_icon = fileUpload($request,'address_icon','uploads/used_car/addressIcon');
                    $used_car->address_icon = $address_icon;
                }

                if($file = $request->hasFile('working_hours_icon')) {

                    $working_hours_icon = fileUpload($request,'working_hours_icon','uploads/used_car/workingHoursIcon');
                    $used_car->working_hours_icon = $working_hours_icon;
                }

                if($file = $request->hasFile('contact_icon')) {

                    $contact_icon = fileUpload($request,'contact_icon','uploads/used_car/contactIcon');
                    $used_car->contact_icon = $contact_icon;
                }

                if($file = $request->hasFile('email_icon')) {

                    $email_icon = fileUpload($request,'email_icon','uploads/used_car/emailIcon');
                    $used_car->email_icon = $email_icon;
                }

                if($file = $request->hasFile('lets_connect_image')) {

                    $lets_connect_image = fileUpload($request,'lets_connect_image','uploads/used_car/letsConnectImage');
                    $used_car->lets_connect_image = $lets_connect_image;
                }

                $used_car->slug = $request->name ? slugify($request->name) : NULL;
                $used_car->car_model_id = json_encode($request->car_model_id);
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
                    $url= url('public/used_car_image/'.$used_car->image);
                    $image = '<img src="'.$url.'" border="0" width="50">';
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
                $return_data['brands'] = Brand::select('id','name')->get();
                $return_data['cars'] = Car::select('id','name')->get();

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
                $fields = array('name','business_id','name_color','name_font_size','name_font_family','link','rating','number_of_rating','brand_id','description','description_font_size','description_font_family','description_font_color','address','address_font_family','address_font_color','working_hours','working_hours_font_size','working_hours_font_family','working_hours_font_color','contact_number','contact_font_family','contact_font_size','contact_font_color','email','email_font_color','email_font_size','email_font_family','facility_title','facility_title_font_size','facility_title_font_family','facility_title_font_color','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size','email_title_font_family','meta_title','meta_keyword','meta_description');
                foreach($fields as $field)
                {
                    $used_car->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                }

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

                if($file = $request->hasFile('address_icon')) 
                {
                    $old_address_icon = $used_car->address_icon;
                    if($old_address_icon)
                    {
                        rmoveFile('uploads/used_car'.$old_address_icon);
                    }
                    $address_icon = fileUpload($request,'address_icon','uploads/used_car/addressIcon');
                    $used_car->address_icon = $address_icon;
                }

                if($file = $request->hasFile('working_hours_icon')) 
                {
                    $old_working_hours_icon = $used_car->working_hours_icon;
                    if($old_working_hours_icon)
                    {
                        removeFile('uploads/workingHoursIcon'.$old_working_hours_icon);
                    }
                    $working_hours_icon = fileUpload($request,'working_hours_icon','uploads/used_car/workingHoursIcon');
                    $used_car->working_hours_icon = $working_hours_icon;
                }

                if($file = $request->hasFile('contact_icon')) 
                {
                    $old_contact_icon = $used_car->contact_icon;
                    if($old_contact_icon)
                    {
                        removeFile('uploads/contactIcon'.$old_contact_icon);
                    }
                    $contact_icon = fileUpload($request,'contact_icon','uploads/used_car/contactIcon');
                    $used_car->contact_icon = $contact_icon;
                }

                if($file = $request->hasFile('email_icon')) 
                {
                    $old_email_icon = $used_car->email_icon;
                    if($old_email_icon)
                    {
                        removeFile('uploads/used_car/emailIcon'.$old_email_icon);
                    }
                    $email_icon = fileUpload($request,'email_icon','uploads/used_car/emailIcon');
                    $used_car->email_icon = $email_icon;
                }

                if($file = $request->hasFile('lets_connect_image')) 
                {
                    $old_lets_connect_image = $used_car->lets_connect_image;
                    if($old_lets_connect_image)
                    {
                        removeFile('uploads/used_car/letsConnectImage'.$old_lets_connect_image);
                    }
                    $lets_connect_image = fileUpload($request,'lets_connect_image','uploads/used_car/letsConnectImage');
                    $used_car->lets_connect_image = $lets_connect_image;
                }

                $used_car->slug = $request->name ? slugify($request->name) : NULL;
                $used_car->car_model_id = json_encode($request->car_model_id);
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

    public function usedCarContactQueryList()
    {
        $has_permission = hasPermission('Used Car Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Used Car Contact Query');
                return view('admin.used_car_contact_query.list',array_merge($return_data));
            }
        }
    }

    public function usedCarContactQueryDatatable(Request $request)
    {
        if($request->ajax()){
            $query = UsedCarContactQuery::with('ourService')->select('id', 'first_name','phone','email','our_service')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('our_service', function($list){
                    $our_service = isset($list->ourService->name) && $list->ourService->name ? $list->ourService->name : NULL;
                    return $our_service;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Used Car Contact Query');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $html .= "<span class='text-nowrap'>";
                            $html .= "<a href='".url('used-car-contact-query-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                            $html .= "<a href='javascript:void(0);' data-href='".route('used-car-contact-query-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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

    public function usedCarContactQueryEdit($id)
    {
        $has_permission = hasPermission('Used Car Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $return_data = array();
                $return_data['site_title'] = trans('Used Car Contact Query Edit');
                $return_data['our_services'] = Header_menu::where('menu_name','Our Services')->get();
                $return_data['record'] = UsedCarContactQuery::find($id);

                return view('admin.used_car_contact_query.form',array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function usedCarContactQueryUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Used Car Contact Query');
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

                $used_car_contact_query = UsedCarContactQuery::find($id);
                $used_car_contact_query->first_name = $request->first_name;
                $used_car_contact_query->email = $request->email;
                $used_car_contact_query->phone = $request->phone;
                $used_car_contact_query->our_service = $request->our_service;
                $used_car_contact_query->description = $request->description;
                $used_car_contact_query->save();

                if($used_car_contact_query)
                {
                    return redirect()->route('used-car-contact-query')->with('success','Used Car Contact Query update successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong, please try again later!');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function usedCarContactQueryDestroy($id)
    {
        $has_permission = hasPermission('Used Car Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $used_car_contact_query = UsedCarContactQuery::where('id',$id)->delete();

                if($used_car_contact_query)
                {
                    return redirect()->back()->with('success','Used Car Contact Query deleted successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong, please try again later!');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }
}
