<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galaxy_toyota;
use App\Models\Galaxy_toyota_image;
use App\Models\Galaxy_toyota_showrooms_slider;
use DataTables;
use File;


class GalaxyToyotaController extends Controller
{
    //galaxy_toyota
    public function galaxy_toyota(Request $request){
        $galaxy_toyotas = Galaxy_toyota::get();
        return view("admin.galaxy_toyota.form",compact('galaxy_toyotas')); 
    }
    

    public function galaxy_toyota_insert(Request $request){
        
        $galaxy_toyota = Galaxy_toyota::find(1);
        
        if (!$galaxy_toyota) {
            $galaxy_toyota = new Galaxy_toyota();
        }
     
        $galaxy_toyota->title = $request->title;
        $galaxy_toyota->description = $request->description;
        $galaxy_toyota->save();
    
        return redirect()->route('galaxy_toyota')->with('message', 'Galaxy toyota inserted successfully');
    }

    //galaxy_toyota_image
    public function galaxy_toyota_image(Request $request){
        return view("admin.galaxy_toyota_image.form"); 
    }

    public function galaxy_toyota_image_insert(Request $request){
        
        $galaxy_toyota_image = new Galaxy_toyota_image();

        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;

            $extension = $file->getClientOriginalExtension();
            $fileName = time(). '.' . $extension;

            $destinationPath = public_path().'/galaxy_toyota_image' ;
            $file->move($destinationPath,$fileName);
            $galaxy_toyota_image->image = $fileName;
        }
        $galaxy_toyota_image->name = $request->name;
        $galaxy_toyota_image->save();

        return redirect()->route('galaxy_toyota_image.index')->with('message', 'Galaxy toyota image insert succesfully');
    }


    public function galaxy_toyota_image_index(Request $request){
        if ($request->ajax()) {
            $galaxy_toyota_image = Galaxy_toyota_image::get();
            return Datatables::of($galaxy_toyota_image)
                ->addIndexColumn()
                ->addColumn('action', function($galaxy_toyota_image){
        
                $updateButton = '<a href="'.route("galaxy_toyota_image.edit",encrypt($galaxy_toyota_image->id)).'" class="btn btn-info btn-sm">Edit</a>';        
                $deleteBtn = '<a class="btn btn-danger btn-sm" id="smallButton" data-id="'.$galaxy_toyota_image->id.'">Delete</a>';
                return $updateButton . $deleteBtn;
                })

                ->editColumn('image', function($galaxy_toyota_image){

                    if($galaxy_toyota_image->image == NULL){
                        $url= asset('public/no_image/notImg.png');
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;

                    }else{

                        $url= asset('public/galaxy_toyota_image/'.$galaxy_toyota_image->image);
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;
                    }
                })

            ->rawColumns(['action','image'])
            ->make(true);
        }
        
        return view('admin.galaxy_toyota_image.show');
    }

    public function galaxy_toyota_image_edit($id){
        $galaxy_toyota_images  = Galaxy_toyota_image::where('id',decrypt($id))->get();
        return view('admin.galaxy_toyota_image._form',compact('galaxy_toyota_images'));
    }

    public function galaxy_toyota_image_update(Request $request, $id)
    {
       $galaxy_toyota_image = Galaxy_toyota_image::find($id);
 
         if($request->hasFile('image'))
         {
             $destination = 'public/galaxy_toyota_image/' . $galaxy_toyota_image->image;
             if(File::exists($destination))
             {
                 File::delete($destination);
             }
             $file = $request->file('image');
             $extension = $file->getClientOriginalExtension();
             $filename = time(). '.' . $extension;
             $file->move('public/galaxy_toyota_image/', $filename);
             $galaxy_toyota_image->image = $filename;
         }
         $galaxy_toyota_image->name = $request->name;
         $galaxy_toyota_image->save();
 
       return redirect()->route('galaxy_toyota_image.index')->with('message', 'Galaxy toyota image update succesfully');
    }

    public function galaxy_toyota_image_destroy(Request $request,$id){

        $galaxy_toyota_image = Galaxy_toyota_image::findOrFail($id);
    
        if($galaxy_toyota_image->image == null){

            $galaxy_toyota_image->delete();

        }else{
            
            $image_path = public_path("galaxy_toyota_image/{$galaxy_toyota_image->image}");

            if (File::exists($image_path)) {
                unlink($image_path);
            }

            $galaxy_toyota_image->delete();
        }

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);

    }

    //galaxy_toyota_showrooms_slider
    public function galaxy_toyota_showrooms_slider(Request $request){
        return view("admin.galaxy_toyota_showrooms_slider.form"); 
    }


    public function galaxy_toyota_showrooms_slider_insert(Request $request){
        
        $galaxy_toyota_showrooms_slider = new Galaxy_toyota_showrooms_slider();

        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;

            $extension = $file->getClientOriginalExtension();
            $fileName = time(). '.' . $extension;

            $destinationPath = public_path().'/galaxy_toyota_showrooms_slider' ;
            $file->move($destinationPath,$fileName);
            $galaxy_toyota_showrooms_slider->image = $fileName;
        }
        $galaxy_toyota_showrooms_slider->name = $request->name;
        $galaxy_toyota_showrooms_slider->save();

        return redirect()->route('galaxy_toyota_showrooms_slider.index')->with('message', 'Galaxy toyota image insert succesfully');
    }
}
