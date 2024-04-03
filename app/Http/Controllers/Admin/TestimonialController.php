<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use DataTables;
use File;

class TestimonialController extends Controller
{
    //testimonials
    public function testimonials(Request $request){
        $has_permission = hasPermission('Testimonials');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view("admin.testimonials.form"); 
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function testimonials_insert(Request $request){
        
        $has_permission = hasPermission('Testimonials');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $testimonials = new Testimonial();
                $testimonials->name = $request->name;

                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/testimonials' ;
                    $file->move($destinationPath,$fileName);
                    $testimonials->image = $fileName;
                }

                $testimonials->testimonials_title = $request->testimonials_title;

                $testimonials->testimonials_title_color = $request->testimonials_title_color;
                $testimonials->testimonials_title_font_size = $request->testimonials_title_font_size;
                $testimonials->testimonials_title_font_family = $request->testimonials_title_font_family;

                $testimonials->name_background_color = $request->name_background_color;
                $testimonials->name_color = $request->name_color;
                $testimonials->name_font_size = $request->name_font_size;
                $testimonials->name_font_family = $request->name_font_family;

                $testimonials->description = $request->description;
                $testimonials->description_color = $request->description_color;
                $testimonials->description_font_size = $request->description_font_size;
                $testimonials->description_font_family = $request->description_font_family;
                $testimonials->save();

                return redirect()->route('testimonials.index')->with('success','Testimonials insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function testimonials_index(Request $request){
        $testimonials = Testimonial::get();
        if ($request->ajax()) {
            $testimonials = Testimonial::orderBy('id', 'DESC')->get();
            return Datatables::of($testimonials)
                ->addIndexColumn()
                ->addColumn('action', function($testimonials){

                    $updateButton = "";
                    $deleteBtn = "";
                    $has_permission = hasPermission('Testimonials');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {

                            $id = encrypt($testimonials->id);
                            $updateButton = "<a href='".route('testimonials.edit',array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                            $deleteBtn = "<a href='javascript:void(0);' data-href='".route('testimonials_destroy',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        }
                    }
                
                return $updateButton . $deleteBtn;
                })

                ->editColumn('image', function($testimonials){

                    if($testimonials->image == NULL){
                        $url= asset('no_image/notImg.png');
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;

                    }else{

                        $url= asset('testimonials/'.$testimonials->image);
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;
                    }
                })

                ->editColumn('description', function($testimonials){

                    $description = $testimonials->description;
                    return $description;
                })

            ->rawColumns(['action','image','description'])
            ->make(true);
        }
        
        $has_permission = hasPermission('Testimonials');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view('admin.testimonials.show',compact('testimonials'));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function testimonials_edit($id){
        $has_permission = hasPermission('Testimonials');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $testimonials  = Testimonial::where('id',$id)->get();
                return view('admin.testimonials._form',compact('testimonials'));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function testimonials_update(Request $request, $id)
    {
        $has_permission = hasPermission('Testimonials');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $testimonials = Testimonial::find($id);
                $testimonials->name = $request->name;

                if($request->hasFile('image'))
                {
                    $destination = 'public/testimonials/' . $testimonials->image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/testimonials/', $filename);
                    $testimonials->image = $filename;
                }

                $testimonials->testimonials_title = $request->testimonials_title;

                $testimonials->testimonials_title_color = $request->testimonials_title_color;
                $testimonials->testimonials_title_font_size = $request->testimonials_title_font_size;
                $testimonials->testimonials_title_font_family = $request->testimonials_title_font_family;
                
                $testimonials->name_background_color = $request->name_background_color;
                $testimonials->name_color = $request->name_color;
                $testimonials->name_font_size = $request->name_font_size;
                $testimonials->name_font_family = $request->name_font_family;
                $testimonials->description = $request->description;
                $testimonials->description_color = $request->description_color;
                $testimonials->description_font_size = $request->description_font_size;
                $testimonials->description_font_family = $request->description_font_family;
                $testimonials->save();

                return redirect()->route('testimonials.index')->with('success','Testimonials update successfully.');
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    public function testimonials_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Testimonials');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $id = decrypt($id);
                $testimonial = Testimonial::find($id);
                if($testimonial->image !=NULL)
                {
                    $image = public_path("testimonials/{$testimonial->image}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                $testimonial = Testimonial::where('id',$id)->delete();
                if($testimonial)
                {
                    return redirect()->route('testimonials.index')->with('message', 'Testimonial deleted successfully');
                }
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

}
