<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use DataTables;
use File;


class CarController extends Controller
{
    //car
    public function car(Request $request){
        $brands = Brand::get();
        return view("admin.car.form",compact('brands')); 
    }

    
    public function car_insert(Request $request){
      
        $car = new Car();
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
  
        return redirect()->route('car.index')->with('message', 'Car insert succesfully');
    }

    public function car_index(Request $request){
        if ($request->ajax()) {
            $car = Car::with('brand')->orderBy('id', 'DESC')->get();
            return Datatables::of($car)
                    ->addIndexColumn()
                    ->addColumn('action', function($car){
            
                    $updateButton = "<a href='".route("car.edit",encrypt($car->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                    $deleteBtn = "<a href='javascript:void(0);' data-href='".route('car_destroy',array($car->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    return $updateButton . $deleteBtn;
                    })
  
                    ->editColumn('image', function($car){
  
                        if($car->image == NULL){
                            $url= asset('no_image/notImg.png');
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
  
                        }else{
  
                            $url= asset('car/'.$car->image);
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
                        }
                    })
                    
                    ->editColumn('brand', function($car){
                        $brand_name = isset($car->brand->name) && $car->brand->name ? $car->brand->name: NULL;
                        return $brand_name;
                    })
            ->rawColumns(['action','image','brand'])
            ->make(true);
        }
        
        return view('admin.car.show');
    }
    
    public function car_edit($id){
        $cars  = Car::where('id',decrypt($id))->get();
        $brands = Brand::get();
        return view('admin.car._form',compact('cars','brands'));
    }

    public function car_update(Request $request, $id)
    {
        $car = Car::find($id);
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

        return redirect()->route('car.index')->with('message', 'Car update succesfully');
    }

    public function car_destroy(Request $request,$id){

        $car = Car::findOrFail($id);

        $image_path = public_path("car/{$car->image}");

        if (File::exists($image_path)) {
            unlink($image_path);
        }

        $car->delete();

        if($car)
        {
            return redirect()->route('car.index')->with('message', 'Car deleted succesfully');
        }
  
    }

}
