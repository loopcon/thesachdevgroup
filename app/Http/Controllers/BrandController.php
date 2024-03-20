<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use DataTables;
use File;

class BrandController extends Controller
{
    //brand
    public function brand(Request $request){
        return view("admin.brand.form"); 
    }

    public function brand_insert(Request $request){
      
        $brand = new Brand();
  
        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
  
            $extension = $file->getClientOriginalExtension();
            $fileName = time(). '.' . $extension;
  
            $destinationPath = public_path().'/brand' ;
            $file->move($destinationPath,$fileName);
            $brand->image = $fileName;
        }

        $brand->name = $request->name;
        $brand->save();
  
        return redirect()->route('brand.index')->with('message', 'Brand insert succesfully');
    }

    public function brand_index(Request $request){
        if ($request->ajax()) {
            $brand = Brand::get();
            return Datatables::of($brand)
                    ->addIndexColumn()
                    ->addColumn('action', function($brand){
            
                    $updateButton = '<a href="'.route("brand.edit",encrypt($brand->id)).'" class="btn btn-info btn-sm">Edit</a>';        
                    $deleteBtn = '<a class="btn btn-danger btn-sm" id="smallButton" data-id="'.$brand->id.'">Delete</a>';
                    return $updateButton . $deleteBtn;
                    })
  
                    ->editColumn('image', function($brand){
  
                        if($brand->image == NULL){
                            $url= asset('public/no_image/notImg.png');
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
  
                        }else{
  
                            $url= asset('public/brand/'.$brand->image);
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
                        }
                    })
            ->rawColumns(['action','image'])
            ->make(true);
        }
        
        return view('admin.brand.show');
    }
    
    public function brand_edit($id){
        $brands  = Brand::where('id',decrypt($id))->get();
        return view('admin.brand._form',compact('brands'));
    }

    public function brand_update(Request $request, $id)
    {
        $brand = Brand::find($id);

            if($request->hasFile('image'))
            {
                $destination = 'public/brand/' . $brand->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time(). '.' . $extension;
                $file->move('public/brand/', $filename);
                $brand->image = $filename;
            }
            $brand->name = $request->name;
            $brand->save();

        return redirect()->route('brand.index')->with('message', 'Brand update succesfully');
    }
    
    public function brand_destroy(Request $request,$id){

        $brand = Brand::findOrFail($id);
       
        if($brand->image == null){
  
            $brand->delete();
  
        }else{
            
            $image_path = public_path("brand/{$brand->image}");
  
            if (File::exists($image_path)) {
                unlink($image_path);
            }
  
            $brand->delete();
        }
  
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
  
    }
}
