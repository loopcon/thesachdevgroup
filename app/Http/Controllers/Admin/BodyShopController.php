<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Body_shop;
use App\Models\OurBusiness;
use App\Models\Car;
use App\Models\BodyShopContactQuery;
use App\Models\Header_menu;
use DataTables;
use File;

class BodyShopController extends Controller
{
    //body_shop
    public function body_shop()
    {
        $has_permission = hasPermission('Body Shops');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop');
                return view("admin.body_shop.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function bodyShopCreate()
    {
        $has_permission = hasPermission('Body Shops');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop Create');
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
                $return_data['cars'] = Car::select('id','name')->get();
                return view("admin.body_shop.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function body_shop_insert(Request $request)
    {
        $has_permission = hasPermission('Body Shops');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
  
                $body_shop = new Body_shop();
                $fields = array('name','business_id','name_color','name_font_size','name_font_family','link','rating','number_of_rating','address','address_font_size','address_font_family','address_font_color','email','email_font_size','email_font_family','email_font_color','contact_number','contact_font_size','contact_font_family','contact_font_color','map_link','description','description_font_size','description_font_family','description_font_color','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size','email_title_font_family','meta_title','meta_keyword','meta_description','working_hours','working_hours_font_size','working_hours_font_family','working_hours_font_color');
                foreach($fields as $field)
                {
                    $body_shop->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                }
                $body_shop->slug = $request->name ? slugify($request->name) : NULL;
                $body_shop->car_model_id = isset($request->car_model_id) && $request->car_model_id ? json_encode($request->car_model_id) : NULL;

                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/body_shop_image' ;
                    $file->move($destinationPath,$fileName);
                    $body_shop->image = $fileName;
                }

                if($request->hasFile('address_icon')) {
                    $address_icon = fileUpload($request, 'address_icon', 'uploads/body_shop_address_icon');
                    $body_shop->address_icon = $address_icon;
                }

                if($request->hasFile('working_hours_icon')) {
                    $working_hours_icon = fileUpload($request, 'working_hours_icon', 'uploads/body_shop_working_hours_icon');
                    $body_shop->working_hours_icon = $working_hours_icon;
                }

                if($request->hasFile('contact_icon')) {
                    $contact_icon = fileUpload($request, 'contact_icon', 'uploads/body_shop_contact_icon');
                    $body_shop->contact_icon = $contact_icon;
                }

                if($request->hasFile('email_icon')) {
                    $email_icon = fileUpload($request, 'email_icon', 'uploads/body_shop_email_icon');
                    $body_shop->email_icon = $email_icon;
                }

                if($request->hasFile('lets_connect_image')) {
                    $lets_connect_image = fileUpload($request, 'lets_connect_image', 'uploads/body_shop/lets_connect_image');
                    $body_shop->lets_connect_image = $lets_connect_image;
                }

                $body_shop->save();
        
                return redirect()->route('body_shop')->with('success','Body Shop insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function body_shop_index(Request $request)
    {
        if ($request->ajax()) {

            $body_shop = Body_shop::orderBy('id', 'DESC')->get();
            return Datatables::of($body_shop)
                ->addIndexColumn()
                ->addColumn('action', function($body_shop){
                    $updateButton = "";
                    $deleteBtn = "";
                    $has_permission = hasPermission('Body Shops');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $updateButton = "<a href='".route("body_shop.edit",encrypt($body_shop->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                            $deleteBtn = "<a href='javascript:void(0);' data-href='".route('body_shop_destroy',array($body_shop->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        }
                    }
                return $updateButton . $deleteBtn;
            })

            ->editColumn('image', function($body_shop){

                if(isset($body_shop->image) && isset($body_shop->image)){
                    $url= url('public/body_shop_image/'.$body_shop->image);
                    $image = '<img src="'.$url.'" border="0" width="50">';
                    return $image;
                }
            })

            ->rawColumns(['action','image'])
            ->make(true);
        }
       
        return redirect()->back()->with('message','something went wrong');
    }

    public function body_shop_edit($id)
    {
        $has_permission = hasPermission('Body Shops');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Body Shop Edit');
                $body_shop = Body_shop::find($id);
                $return_data['record'] = $body_shop;
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
                $return_data['cars'] = Car::select('id','name')->get();

                return view("admin.body_shop.form",array_merge($return_data));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function body_shop_update(Request $request, $id)
    {
        $has_permission = hasPermission('Body Shops');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $body_shop = Body_shop::find(decrypt($id));
                $fields = array('name','business_id','name_color','name_font_size','name_font_family','link','rating','number_of_rating','address','address_font_size','address_font_family','address_font_color','email','email_font_size','email_font_family','email_font_color','contact_number','contact_font_size','contact_font_family','contact_font_color','map_link','description','description_font_size','description_font_family','description_font_color','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size','email_title_font_family','meta_title','meta_keyword','meta_description','working_hours','working_hours_font_size','working_hours_font_family','working_hours_font_color');
                foreach($fields as $field)
                {
                    $body_shop->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                }
                $body_shop->slug = $request->name ? slugify($request->name) : NULL;
                $body_shop->car_model_id = isset($request->car_model_id) && $request->car_model_id ? json_encode($request->car_model_id) : NULL;

                if($request->hasFile('image'))
                {
                    $destination = 'public/body_shop_image/' . $body_shop->image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/body_shop_image/', $filename);
                    $body_shop->image = $filename;
                }

                if($request->hasFile('address_icon')) {
                    $oldimage = $body_shop->address_icon;
                    if($oldimage)
                    {
                        removeFile('uploads/body_shop_address_icon/'.$oldimage);
                    }
                    $address_icon = fileUpload($request, 'address_icon', 'uploads/body_shop_address_icon');
                    $body_shop->address_icon = $address_icon;
                }

                if($request->hasFile('working_hours_icon')) {
                    $oldimage = $body_shop->working_hours_icon;
                    if($oldimage)
                    {
                        removeFile('uploads/body_shop_working_hours_icon/'.$oldimage);
                    }
                    $working_hours_icon = fileUpload($request, 'working_hours_icon', 'uploads/body_shop_working_hours_icon');
                    $body_shop->working_hours_icon = $working_hours_icon;
                }

                if($request->hasFile('contact_icon')) {
                    $oldimage = $body_shop->contact_icon;
                    if($oldimage)
                    {
                        removeFile('uploads/body_shop_contact_icon/'.$oldimage);
                    }
                    $contact_icon = fileUpload($request, 'contact_icon', 'uploads/body_shop_contact_icon');
                    $body_shop->contact_icon = $contact_icon;
                }

                if($request->hasFile('email_icon')) {
                    $oldimage = $body_shop->email_icon;
                    if($oldimage)
                    {
                        removeFile('uploads/body_shop_email_icon/'.$oldimage);
                    }
                    $email_icon = fileUpload($request, 'email_icon', 'uploads/body_shop_email_icon');
                    $body_shop->email_icon = $email_icon;
                }

                if($request->hasFile('lets_connect_image')) {
                    $oldimage = $body_shop->lets_connect_image;
                    if($oldimage)
                    {
                        removeFile('uploads/body_shop/lets_connect_image/'.$oldimage);
                    }
                    $lets_connect_image = fileUpload($request, 'lets_connect_image', 'uploads/body_shop/lets_connect_image');
                    $body_shop->lets_connect_image = $lets_connect_image;
                }

                $body_shop->save();
                

                return redirect()->route('body_shop')->with('success','Body Shop update successfully.');
    
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    public function body_shop_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Body Shops');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $body_shop = Body_shop::find($id);

                if($body_shop->image != NULL)
                {
                    $image = public_path("body_shop_image/{$body_shop->image}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }

                if($body_shop->address_icon != NULL)
                {
                    $address_icon = $body_shop->address_icon;
                    if($address_icon)
                    {
                        removeFile('uploads/body_shop_address_icon/'.$address_icon);
                    }
                }

                if($body_shop->working_hours_icon != NULL)
                {
                    $working_hours_icon = $body_shop->working_hours_icon;
                    if($working_hours_icon)
                    {
                        removeFile('uploads/body_shop_working_hours_icon/'.$working_hours_icon);
                    }
                }

                if($body_shop->contact_icon != NULL)
                {
                    $contact_icon = $body_shop->contact_icon;
                    if($contact_icon)
                    {
                        removeFile('uploads/body_shop_contact_icon/'.$contact_icon);
                    }
                }

                if($body_shop->email_icon != NULL)
                {
                    $email_icon = $body_shop->email_icon;
                    if($email_icon)
                    {
                        removeFile('uploads/body_shop_email_icon/'.$email_icon);
                    }
                }

                if($body_shop->lets_connect_image != NULL)
                {
                    $lets_connect_image = $body_shop->lets_connect_image;
                    if($lets_connect_image)
                    {
                        removeFile('uploads/body_shop/lets_connect_image/'.$lets_connect_image);
                    }
                }

                $body_shop_image = Body_shop::where('id',$id)->delete();
                if($body_shop_image)
                {
                    return redirect()->route('body_shop')->with('message', 'Body Shop deleted successfully');
                }
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    public function bodyShopContactQueryList(Request $request)
    {
        $has_permission = hasPermission('Body Shop Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop Contact Query');
                return view("admin.body_shop_contact_query.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }

    }

    public function bodyShopContactQueryDatatable(Request $request)
    {
        if($request->ajax()){
            $query = BodyShopContactQuery::with('ourService')->select('id', 'first_name','phone','email','our_service')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('our_service', function($list){
                    $our_service = isset($list->ourService->name) && $list->ourService->name ? $list->ourService->name : NULL;
                    return $our_service;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Body Shop Contact Query');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $html .= "<span class='text-nowrap'>";
                            $html .= "<a href='".url('body-shop-contact-query-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                            $html .= "<a href='javascript:void(0);' data-href='".route('body-shop-contact-query-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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

    public function bodyShopContactQueryEdit($id)
    {
        $has_permission = hasPermission('Body Shop Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop Contact Query Edit');
                $return_data['our_services'] = Header_menu::where('menu_name','Our Services')->get();
                $return_data['record'] = BodyShopContactQuery::find($id);

                return view('admin.body_shop_contact_query.form',array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function bodyShopContactQueryUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Body Shop Contact Query');
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

                $body_shop_contact_query = BodyShopContactQuery::find($id);
                $body_shop_contact_query->first_name = $request->first_name;
                $body_shop_contact_query->email = $request->email;
                $body_shop_contact_query->phone = $request->phone;
                $body_shop_contact_query->our_service = $request->our_service;
                $body_shop_contact_query->description = $request->description;
                $body_shop_contact_query->save();

                if($body_shop_contact_query)
                {
                    return redirect()->route('body-shop-contact-query')->with('success','Body Shop Contact Query update successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong, please try again later!');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function bodyShopContactQueryDestroy($id)
    {
        $has_permission = hasPermission('Service Center Contact Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $body_shop_contact_query = BodyShopContactQuery::where('id',$id)->delete();

                if($body_shop_contact_query)
                {
                    return redirect()->back()->with('success','Body Shop Contact Query deleted successfully.');
                }else{
                    return redirect()->back()->with('error','Something went wrong, please try again later!');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }
}
