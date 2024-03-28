<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use DataTables;
use File;

class BrandController extends Controller
{
    //brand
    public function brand(Request $request){
        $has_permission = hasPermission('Brand');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view("admin.brand.form"); 
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function brand_insert(Request $request){

        $has_permission = hasPermission('Brand');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
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
                $brand->color = $request->color;
                $brand->font_size = $request->font_size;
                $brand->font_family = $request->font_family;
                $brand->save();

                return redirect()->route('brand.index')->with('success','Brand insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function brand_index(Request $request){
        if ($request->ajax()) {
            $brand = Brand::orderBy('id', 'DESC')->get();
            return Datatables::of($brand)
                    ->addIndexColumn()
                    ->addColumn('action', function($brand){
        
                        $updateButton = "";
                        $deleteBtn = "";
                        $has_permission = hasPermission('Brand');
                        if(isset($has_permission) && $has_permission)
                        {
                            if($has_permission->full_permission == 1)
                            {
                                $updateButton = "<a href='".route("brand.edit",encrypt($brand->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                                $deleteBtn = "<a href='javascript:void(0);' data-href='".route('brand_destroy',array($brand->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            }
                        }
                    return $updateButton . $deleteBtn;
                    })
  
                    ->editColumn('image', function($brand){
  
                        if($brand->image == NULL){
                            $url= asset('no_image/notImg.png');
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
  
                        }else{
  
                            $url= asset('brand/'.$brand->image);
                            $image = '<img src="'.$url.'" border="0" width="100">';
                            return $image;
                        }
                    })
            ->rawColumns(['action','image'])
            ->make(true);
        }
        $has_permission = hasPermission('Brand');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view('admin.brand.show');
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        }
    }
    
    public function brand_edit($id){
        $has_permission = hasPermission('Brand');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $brands  = Brand::where('id',decrypt($id))->get();
                return view('admin.brand._form',compact('brands'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function brand_update(Request $request, $id)
    {
        $has_permission = hasPermission('Brand');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
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
                $brand->color = $request->color;
                $brand->font_size = $request->font_size;
                $brand->font_family = $request->font_family;
                $brand->save();

                return redirect()->route('brand.index')->with('success','Brand update successfully.');
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
    
    public function brand_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Brand');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $brand = Brand::findOrFail($id);

                $image_path = public_path("brand/{$brand->image}");

                if (File::exists($image_path)) {
                    unlink($image_path);
                }
                $brand->delete();
                if($brand)
                {
                    return redirect()->route('brand.index')->with('message', 'Brand deleted successfully');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
