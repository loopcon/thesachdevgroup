<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Showroom;
use App\Models\Facilitie;
use App\Models\Customer_gallery;
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
                return view("admin.showroom.form",compact('brands')); 
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

                $showroom->working_hours_color = $request->working_hours_color;
                $showroom->working_hours_font_size = $request->working_hours_font_size;
                $showroom->working_hours_font_family = $request->working_hours_font_family;

                $showroom->contact_number_color = $request->contact_number_color;
                $showroom->contact_number_font_size = $request->contact_number_font_size;
                $showroom->contact_number_font_family = $request->contact_number_font_family;

                $showroom->email_color = $request->email_color;
                $showroom->email_font_size = $request->email_font_size;
                $showroom->email_font_family = $request->email_font_family;

                $showroom->description = $request->description;
                $showroom->description_color = $request->description_color;
                $showroom->description_font_size = $request->description_font_size;
                $showroom->description_font_family = $request->description_font_family;


                $showroom->save();

                if ($files = $request->file('facilitie_image')) {
                    foreach($files as $file) {

                        $facilitie_image = new Facilitie;
                        $facilitie_image->showroom_id = $showroom->id;

                        $image_name = rand() . '.' . $file->getClientOriginalExtension();
                        $file->move('public/facilitie_image/', $image_name);

                        $facilitie_image->facilitie_image = $image_name;
                        $facilitie_image->save();
                    }
                }

                if ($files = $request->file('customer_gallery_image')) {
                    foreach($files as $file) {

                        $customer_gallery_image = new Customer_gallery;
                        $customer_gallery_image->showroom_id = $showroom->id;

                        $image_name = rand() . '.' . $file->getClientOriginalExtension();
                        $file->move('public/customer_gallery_image/', $image_name);

                        $customer_gallery_image->customer_gallery_image = $image_name;
                        $customer_gallery_image->save();
                    }
                }

                return redirect()->route('showroom.index')->with('success','Showroom insert successfully.');
    
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
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
  
                ->editColumn('brand', function($showroom){
                    $brand_name =  isset($showroom->brand->name) && $showroom->brand->name ? $showroom->brand->name: NULL;
                    return $brand_name;
                })
                ->editColumn('car', function($showroom) {
                    $description = $showroom->description;  
                    return $description;
                })

                ->editColumn('description', function($showroom) {
                    $car_ids = json_decode($showroom->car_id); 
                    $car_names = Car::whereIn('id', $car_ids)->pluck('name')->implode(', '); 
                    return $car_names;
                })

                ->editColumn('facilitie_image', function($showroom){

                    $facilitie_image = Facilitie::where('showroom_id',$showroom->id)->pluck('facilitie_image')->toArray();

                    if($facilitie_image == NULL){
                        $url= asset('no_image/notImg.png');
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;

                    }else{

                        $imgs="";
                        foreach ($facilitie_image as $image ) {
                            $url= asset('facilitie_image/'.$image);
                            $imgs.= '<div><img src="'.$url.'"  width="50"></div><br>';
                        } 
                        return $imgs;
                    }
                })

                
                ->editColumn('customer_gallery_image', function($showroom){

                    $customer_gallery_image = Customer_gallery::where('showroom_id',$showroom->id)->pluck('customer_gallery_image')->toArray();

                    if($customer_gallery_image == NULL){
                        $url= asset('no_image/notImg.png');
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;

                    }else{

                        $imgs="";
                        foreach ($customer_gallery_image as $image ) {
                            $url= asset('customer_gallery_image/'.$image);
                            $imgs.= '<div><img src="'.$url.'"  width="50"></div><br>';
                        } 
                        return $imgs;
                    }
                })
            ->rawColumns(['action','brand','car','description','facilitie_image','customer_gallery_image'])
            ->make(true);
        }
        
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view('admin.showroom.show');
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }
    
    public function showroom_edit($id,$brand_id){
        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $showrooms  = Showroom::where('id',decrypt($id))->get();
                $brands = Brand::get();
                $cars = Car::where('brand_id',$brand_id)->get();
                $facilitie_image = Facilitie::where('showroom_id',decrypt($id))->pluck('facilitie_image','id')->toArray();
                $customer_gallery_images = Customer_gallery::where('showroom_id',decrypt($id))->pluck('customer_gallery_image','id')->toArray();
                return view('admin.showroom._form',compact('showrooms','brands','cars','facilitie_image','customer_gallery_images'));
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

                $showroom->working_hours_color = $request->working_hours_color;
                $showroom->working_hours_font_size = $request->working_hours_font_size;
                $showroom->working_hours_font_family = $request->working_hours_font_family;

                $showroom->contact_number_color = $request->contact_number_color;
                $showroom->contact_number_font_size = $request->contact_number_font_size;
                $showroom->contact_number_font_family = $request->contact_number_font_family;

                $showroom->email_color = $request->email_color;
                $showroom->email_font_size = $request->email_font_size;
                $showroom->email_font_family = $request->email_font_family;

                $showroom->description = $request->description;
                $showroom->description_color = $request->description_color;
                $showroom->description_font_size = $request->description_font_size;
                $showroom->description_font_family = $request->description_font_family;
                
                $showroom->save();

                if ($files = $request->file('facilitie_image')) {
                    foreach($files as $file) {

                        $facilitie_image = new Facilitie;
                        $facilitie_image->showroom_id = $showroom->id;

                        $image_name = rand() . '.' . $file->getClientOriginalExtension();
                        $file->move('public/facilitie_image/', $image_name);

                        $facilitie_image->facilitie_image = $image_name;
                        $facilitie_image->save();
                    }
                }

                if ($files = $request->file('customer_gallery_image')) {
                    foreach($files as $file) {

                        $customer_gallery_image = new Customer_gallery;
                        $customer_gallery_image->showroom_id = $showroom->id;

                        $image_name = rand() . '.' . $file->getClientOriginalExtension();
                        $file->move('public/customer_gallery_image/', $image_name);

                        $customer_gallery_image->customer_gallery_image = $image_name;
                        $customer_gallery_image->save();
                    }
                }

                return redirect()->route('showroom.index')->with('success','Showroom update successfully.');
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    public function showroom_destroy(Request $request,$id){

        $has_permission = hasPermission('Showroom');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $showroom = Showroom::findOrFail($id);

                $customergallery_image = Showroom::with('customer_gallery')->findOrFail($id);
                $images = Customer_gallery::where('showroom_id',$id)->get();

                foreach ($images as $image) {
                    $image_path = public_path("customer_gallery_image/{$image->customer_gallery_image}");

                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $customergallery_image->customer_gallery()->delete();

                
                $facilitie_image = Showroom::with('facilitie')->findOrFail($id);
                $facilitieImages = Facilitie::where('showroom_id',$id)->get();

                foreach ($facilitieImages as $facilitieImage) {
                    $facilitieimage_path = public_path("facilitie_image/{$facilitieImage->facilitie_image}");

                    if (File::exists($facilitieimage_path)) {
                        unlink($facilitieimage_path);
                    }
                }

                $facilitie_image->facilitie()->delete();

                $showroom->delete();

                return redirect()->route('showroom.index')->with('message', 'Showroom deleted successfully');
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    
    public function DeleteFacilitieImage(Request $request){

        $facilitie_image = Facilitie::findOrFail($request->id);
        $image_path = public_path("facilitie_image/{$facilitie_image->facilitie_image}");

        if (File::exists($image_path)) {
            unlink($image_path);
        }
        $facilitie_image->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function DeleteCustomerGallery(Request $request){

        $customer_gallery_image = Customer_gallery::findOrFail($request->id);
        $image_path = public_path("customer_gallery_image/{$customer_gallery_image->customer_gallery_image}");

        if (File::exists($image_path)) {
            unlink($image_path);
        }
        $customer_gallery_image->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    
    public function getcarname(Request $request){
        $cars = Car::where('brand_id',$request->brand_id)->get();
        return $cars;
    }
}

