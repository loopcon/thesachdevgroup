<?php

namespace App\Http\Controllers;

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

        $car->save();
  
        return redirect()->route('car.index')->with('message', 'Car insert succesfully');
    }

    public function car_index(Request $request){
        if ($request->ajax()) {
            $car = Car::with('brand')->get();
            return Datatables::of($car)
                    ->addIndexColumn()
                    ->addColumn('action', function($car){
            
                    $updateButton = '<a href="'.route("car.edit",encrypt($car->id)).'" class="btn btn-info btn-sm">Edit</a>';        
                    $deleteBtn = '<a class="btn btn-danger btn-sm" id="smallButton" data-id="'.$car->id.'">Delete</a>';
                    return $updateButton . $deleteBtn;
                    })
  
                    ->editColumn('image', function($car){
  
                        if($car->image == NULL){
                            $url= asset('public/no_image/notImg.png');
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
  
                        }else{
  
                            $url= asset('public/car/'.$car->image);
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
                        }
                    })
                    
                    ->editColumn('brand', function($car){
                        $brand_name =  $car->brand->name;
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
            $car->save();

        return redirect()->route('car.index')->with('message', 'Car update succesfully');
    }

    public function car_destroy(Request $request,$id){

        $car = Car::findOrFail($id);
       
        if($car->image == null){
  
            $car->delete();
  
        }else{
            
            $image_path = public_path("car/{$car->image}");
  
            if (File::exists($image_path)) {
                unlink($image_path);
            }
  
            $car->delete();
        }
  
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
  
    }

}
