<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home_slider;
use App\Models\Home_our_businesses;
use App\Models\Testimonial;
use App\Models\Home_detail;
use DataTables;
use File;

class HomeController extends Controller
{
   public function dashboard(Request $request){
       return view("admin.dashboard"); 
    }

   public function homeslider(Request $request){
      return view("admin.homeslider.form"); 
   }
     
   public function homeslider_insert(Request $request){
      
      $home_slider = new Home_slider();

      if($file = $request->hasFile('image')) {
          $file = $request->file('image') ;

          $extension = $file->getClientOriginalExtension();
          $fileName = time(). '.' . $extension;

          $destinationPath = public_path().'/home_slider' ;
          $file->move($destinationPath,$fileName);
          $home_slider->image = $fileName;
      }
      $home_slider->save();

      return redirect()->route('homeslider.index')->with('message', 'Home slider insert succesfully');

   }

   public function homeslider_index(Request $request){
      if ($request->ajax()) {
          $home_slider = Home_slider::get();
          return Datatables::of($home_slider)
                  ->addIndexColumn()
                  ->addColumn('action', function($home_slider){
          
                  $updateButton = '<a href="'.route("home_slider.edit",encrypt($home_slider->id)).'" class="btn btn-info btn-sm">Edit</a>';        
                  $deleteBtn = '<a class="btn btn-danger btn-sm" id="smallButton" data-id="'.$home_slider->id.'">Delete</a>';
                  return $updateButton . $deleteBtn;
                  })

                  ->editColumn('image', function($home_slider){

                      if($home_slider->image == NULL){
                          $url= asset('public/no_image/notImg.png');
                          $image = '<img src="'.$url.'" border="0" width="100">';
                          return $image;

                      }else{

                          $url= asset('public/home_slider/'.$home_slider->image);
                          $image = '<img src="'.$url.'" border="0" width="100">';
                          return $image;
                      }
                  })
          ->rawColumns(['action','image'])
          ->make(true);
      }
      
      return view('admin.homeslider.show');
  }

   public function homeslider_edit($id){
      $homesliders  = Home_slider::where('id',decrypt($id))->get();
      return view('admin.homeslider._form',compact('homesliders'));
   }

   public function homeslider_update(Request $request, $id)
   {
      $homesliders = Home_slider::find($id);

        if($request->hasFile('image'))
        {
            $destination = 'public/home_slider/' . $homesliders->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('public/home_slider/', $filename);
            $homesliders->image = $filename;
        }
        $homesliders->save();

      return redirect()->route('homeslider.index')->with('message', 'Home slider update succesfully');
   }

   public function homeslider_destroy(Request $request,$id){

      $home_slider = Home_slider::findOrFail($id);
     
      if($home_slider->image == null){

          $home_slider->delete();

      }else{
          
          $image_path = public_path("home_slider/{$home_slider->image}");

          if (File::exists($image_path)) {
              unlink($image_path);
          }

          $home_slider->delete();
      }

      return response()->json([
          'success' => 'Record deleted successfully!'
      ]);

  }

  //home_our_businesses
   public function home_our_businesses(Request $request){
      return view("admin.home_our_businesses.form"); 
   }


   public function home_our_businesses_insert(Request $request){
      
      $home_our_businesses = new Home_our_businesses();

      if($file = $request->hasFile('image')) {
          $file = $request->file('image') ;

          $extension = $file->getClientOriginalExtension();
          $fileName = time(). '.' . $extension;

          $destinationPath = public_path().'/home_our_businesses' ;
          $file->move($destinationPath,$fileName);
          $home_our_businesses->image = $fileName;
      }
      $home_our_businesses->save();

      return redirect()->route('home_our_businesses.index')->with('message', 'Home our businesses insert succesfully');

   }

   public function home_our_businesses_index(Request $request){
      if ($request->ajax()) {
          $home_our_businesses = Home_our_businesses::get();
          return Datatables::of($home_our_businesses)
                  ->addIndexColumn()
                  ->addColumn('action', function($home_our_businesses){
          
                  $updateButton = '<a href="'.route("home_our_businesses.edit",encrypt($home_our_businesses->id)).'" class="btn btn-info btn-sm">Edit</a>';        
                  $deleteBtn = '<a class="btn btn-danger btn-sm" id="smallButton" data-id="'.$home_our_businesses->id.'">Delete</a>';
                  return $updateButton . $deleteBtn;
                  })

                  ->editColumn('image', function($home_our_businesses){

                      if($home_our_businesses->image == NULL){
                          $url= asset('public/no_image/notImg.png');
                          $image = '<img src="'.$url.'" border="0" width="100">';
                          return $image;

                      }else{

                          $url= asset('public/home_our_businesses/'.$home_our_businesses->image);
                          $image = '<img src="'.$url.'" border="0" width="100">';
                          return $image;
                      }
                  })
          ->rawColumns(['action','image'])
          ->make(true);
      }
      
      return view('admin.home_our_businesses.show');
    }

   public function home_our_businesses_edit($id){
      $home_our_businesses  = Home_our_businesses::where('id',decrypt($id))->get();
      return view('admin.home_our_businesses._form',compact('home_our_businesses'));
   }

   public function home_our_businesses_update(Request $request, $id)
   {
      $home_our_businesses = Home_our_businesses::find($id);

        if($request->hasFile('image'))
        {
            $destination = 'public/home_our_businesses/' . $home_our_businesses->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('public/home_our_businesses/', $filename);
            $home_our_businesses->image = $filename;
        }
        $home_our_businesses->save();

      return redirect()->route('home_our_businesses.index')->with('message', 'Home our businesses update succesfully');
   }

   public function home_our_businesses_destroy(Request $request,$id){

      $home_our_businesses = Home_our_businesses::findOrFail($id);
     
      if($home_our_businesses->image == null){

          $home_our_businesses->delete();

      }else{
          
          $image_path = public_path("home_our_businesses/{$home_our_businesses->image}");

          if (File::exists($image_path)) {
              unlink($image_path);
          }

          $home_our_businesses->delete();
      }

      return response()->json([
          'success' => 'Record deleted successfully!'
      ]);

  }
    //testimonials
    public function testimonials(Request $request){
        return view("admin.testimonials.form"); 
    }

    public function testimonials_insert(Request $request){
        
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
        $testimonials->description = $request->description;
        $testimonials->save();

        return redirect()->route('testimonials.index')->with('message', 'Testimonials insert succesfully');

    }

    public function testimonials_index(Request $request){
        $testimonials = Testimonial::get();
        if ($request->ajax()) {
            $testimonials = Testimonial::get();
            return Datatables::of($testimonials)
                ->addIndexColumn()
                ->addColumn('action', function($testimonials){
                $id = encrypt($testimonials->id);
                $updateButton = '<a href="'.route('testimonials.edit',array($id)).'" class="btn btn-info btn-sm">Edit</a>';        
                $deleteBtn = '<a class="btn btn-danger btn-sm" id="smallButton" data-id="'.$testimonials->id.'">Delete</a>';
                return $updateButton . $deleteBtn;
                })

                ->editColumn('image', function($testimonials){

                    if($testimonials->image == NULL){
                        $url= asset('public/no_image/notImg.png');
                        $image = '<img src="'.$url.'" border="0" width="100">';
                        return $image;

                    }else{

                        $url= asset('public/testimonials/'.$testimonials->image);
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
        
        return view('admin.testimonials.show',compact('testimonials'));
    }

    public function testimonials_edit($id){
        $id = decrypt($id);
        $testimonials  = Testimonial::where('id',$id)->get();
        return view('admin.testimonials._form',compact('testimonials'));
    }

    public function testimonials_update(Request $request, $id)
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
        $testimonials->description = $request->description;
        $testimonials->save();

      return redirect()->route('testimonials.index')->with('message', 'Testimonials update succesfully');
   }

   public function testimonials_destroy(Request $request,$id){

        $testimonials = Testimonial::findOrFail($id);
    
        if($testimonials->image == null){

            $testimonials->delete();

        }else{
            
            $image_path = public_path("testimonials/{$testimonials->image}");

            if (File::exists($image_path)) {
                unlink($image_path);
            }

            $testimonials->delete();
        }

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);

    }


    //home detail
    public function home_detail(Request $request){
        $home_details = Home_detail::get();
        return view("admin.home_detail.form",compact('home_details')); 
    }

    public function home_detail_insert(Request $request){
        
        $existing_detail = Home_detail::find(1);

        if($existing_detail) {
            $home_detail = $existing_detail;
    
            if($request->hasFile('image'))
            {
                $oldImage = $home_detail->image;
                if($oldImage) {
                    $oldImagePath = public_path('home_detail/') . $oldImage;
                    if(File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
            }

            if($request->hasFile('our_story_image'))
            {
                $oldstoryImage = $home_detail->our_story_image;
                if($oldstoryImage) {
                    $oldstoryImagePath = public_path('our_story_image/') . $oldstoryImage;
                    if(File::exists($oldstoryImagePath)) {
                        File::delete($oldstoryImagePath);
                    }
                }
            }

        } else {
            $home_detail = new Home_detail();
        }
     
        if($file = $request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time(). '.' . $extension;
    
            $destinationPath = public_path().'/home_detail' ;
            $file->move($destinationPath,$fileName);
            $home_detail->image = $fileName;
        }

        if($file = $request->hasFile('our_story_image')) {
            $file = $request->file('our_story_image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time(). '.' . $extension;
    
            $destinationPath = public_path().'/our_story_image' ;
            $file->move($destinationPath,$fileName);
            $home_detail->our_story_image = $fileName;
        }
    
        $home_detail->title = $request->title;
        $home_detail->description = $request->description;

        $home_detail->our_story_title = $request->our_story_title;
        $home_detail->our_story_description = $request->our_story_description;

        $home_detail->our_mission_title = $request->our_mission_title;
        $home_detail->our_mission_description = $request->our_mission_description;

        $home_detail->our_vision_title = $request->our_vision_title;
        $home_detail->our_vision_description = $request->our_vision_description;

        $home_detail->save();
    
        return redirect()->route('home_detail')->with('message', 'Home detail inserted successfully');
    }

   
    
    
    
   

}
