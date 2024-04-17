<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Showroom;
use App\Models\OurBusiness;
use DataTables;
use File;


class CarController extends Controller
{
    //car
    public function car(Request $request){
        $has_permission = hasPermission('Car');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $brands = Brand::get();
                $our_business = OurBusiness::get();
                return view("admin.car.form",compact('brands','our_business')); 
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    
    public function car_insert(Request $request){
        $has_permission = hasPermission('Car');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $car = new Car();
                
                $car->our_business_id = $request->our_business_id;
                $car->brand_id = $request->brand_id;

                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;
        
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;
        
                    $destinationPath = public_path().'/car' ;
                    $file->move($destinationPath,$fileName);
                    $car->image = $fileName;
                }

                $car->name = $request->name;
                $car->price = $request->price;
                $car->link = $request->link;
                $car->name_color = $request->name_color;
                $car->price_color = $request->price_color;
                $car->name_font_size = $request->name_font_size;
                $car->price_font_size = $request->price_font_size;
                $car->name_font_family = $request->name_font_family;
                $car->price_font_family = $request->price_font_family;
                $car->save();
        
                return redirect()->route('car.index')->with('success','Car Model insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function car_index(Request $request){
        if ($request->ajax()) {
            $car = Car::with('brand')->orderBy('id', 'DESC')->get();
            return Datatables::of($car)
                    ->addIndexColumn()
                    ->addColumn('action', function($car){

                        $updateButton = "";
                        $deleteBtn = "";
                        $has_permission = hasPermission('Car');
                        if(isset($has_permission) && $has_permission)
                        {
                            if($has_permission->full_permission == 1)
                            {
                                $updateButton = "<a href='".route("car.edit",encrypt($car->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                                $deleteBtn = "<a href='javascript:void(0);' data-href='".route('car_destroy',array($car->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    
                            }
                        }
                        return $updateButton . $deleteBtn;
                    })
  
                    ->editColumn('image', function($car){
  
                        if(isset($car->image) && isset($car->image)){
                            $url= asset('car/'.$car->image);
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
                        }
                    })
                    
                    ->editColumn('our_business_id', function($car){
                        $our_business_name = isset($car->our_business->title) && $car->our_business->title ? $car->our_business->title: NULL;
                        return $our_business_name;
                    })

                    ->editColumn('brand', function($car){
                        $brand_name = isset($car->brand->name) && $car->brand->name ? $car->brand->name: NULL;
                        return $brand_name;
                    })
            ->rawColumns(['action','image','brand','our_business_id'])
            ->make(true);
        }
        
        $has_permission = hasPermission('Car');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view('admin.car.show');
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
    
    public function car_edit($id){
        $has_permission = hasPermission('Car');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $cars  = Car::where('id',decrypt($id))->get();
                $brands = Brand::get();
                $our_business = OurBusiness::get();
                return view('admin.car._form',compact('cars','brands','our_business'));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function car_update(Request $request, $id)
    {
        $has_permission = hasPermission('Car');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $car = Car::find($id);
                $car->our_business_id = $request->our_business_id;
                $car->brand_id = $request->brand_id;

                if($request->hasFile('image'))
                {
                    $destination = 'public/car/' . $car->image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/car/', $filename);
                    $car->image = $filename;
                }
                $car->name = $request->name;
                $car->price = $request->price;
                $car->link = $request->link;
                $car->name_color = $request->name_color;
                $car->price_color = $request->price_color;
                $car->name_font_size = $request->name_font_size;
                $car->price_font_size = $request->price_font_size;
                $car->name_font_family = $request->name_font_family;
                $car->price_font_family = $request->price_font_family;
                $car->save();

                return redirect()->route('car.index')->with('success','Car Model update successfully.');
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function car_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Car');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $car = Car::findOrFail($id);
               
                if (Showroom::whereJsonContains('car_id', $id)->exists()) {
                    return redirect('car_index')->with('error', trans('Showroom associated with this car exist. Cannot delete car.'));
                } else {
                    $image_path = public_path("car/{$car->image}");

                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                    $car->delete();
                    if($car)
                    {
                        return redirect()->route('car.index')->with('message', 'Car Model deleted successfully');
                    }
                }

  
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

}
