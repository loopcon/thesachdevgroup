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
        $has_permission = hasPermission('Home Slider');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view("admin.homeslider.form");
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } 
   }
     
    public function homeslider_insert(Request $request){

        $has_permission = hasPermission('Home Slider');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $home_slider = new Home_slider();

                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/home_slider' ;
                    $file->move($destinationPath,$fileName);
                    $home_slider->image = $fileName;
                }
                
                $home_slider->title = $request->title;
                $home_slider->subtitle = $request->subtitle;
                $home_slider->title_color = $request->title_color;
                $home_slider->title_font_size = $request->title_font_size;
                $home_slider->title_font_family = $request->title_font_family;
                $home_slider->sub_title_color = $request->sub_title_color;
                $home_slider->sub_title_font_size = $request->sub_title_font_size;
                $home_slider->sub_title_font_family = $request->sub_title_font_family;
                $home_slider->text_position = $request->text_position;
                $home_slider->save();

                return redirect()->route('homeslider.index')->with('success','Home Slider insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

   public function homeslider_index(Request $request){
      if ($request->ajax()) {
          $home_slider = Home_slider::orderBy('id', 'DESC')->get();
          return Datatables::of($home_slider)
                  ->addIndexColumn()
                  ->addColumn('action', function($home_slider){   
                        $updateButton = "";
                        $deleteBtn = "";
                        $has_permission = hasPermission('Home Slider');
                        if(isset($has_permission) && $has_permission)
                        {
                            if($has_permission->full_permission == 1)
                            {

                                $updateButton = "<a href='".route("home_slider.edit",encrypt($home_slider->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                                $deleteBtn = "<a href='javascript:void(0);' data-href='".route('homeslider_destroy',array($home_slider->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            }
                        }
                        return $updateButton . $deleteBtn;
                    })

                  ->editColumn('image', function($home_slider){

                      if($home_slider->image == NULL){
                          $url= asset('no_image/notImg.png');
                          $image = '<img src="'.$url.'" border="0" width="100">';
                          return $image;

                      }else{

                          $url= asset('home_slider/'.$home_slider->image);
                          $image = '<img src="'.$url.'" border="0" width="100">';
                          return $image;
                      }
                  })
          ->rawColumns(['action','image'])
          ->make(true);
      }
      
        $has_permission = hasPermission('Home Slider');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {

                return view('admin.homeslider.show');

            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        }
    }

    public function homeslider_edit($id){
        $has_permission = hasPermission('Home Slider');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $homesliders  = Home_slider::where('id',decrypt($id))->get();
                return view('admin.homeslider._form',compact('homesliders'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

   public function homeslider_update(Request $request, $id)
   {
        $has_permission = hasPermission('Home Slider');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
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

                $homesliders->title = $request->title;
                $homesliders->subtitle = $request->subtitle;
                $homesliders->title_color = $request->title_color;
                $homesliders->title_font_size = $request->title_font_size;
                $homesliders->title_font_family = $request->title_font_family;
                $homesliders->sub_title_color = $request->sub_title_color;
                $homesliders->sub_title_font_size = $request->sub_title_font_size;
                $homesliders->sub_title_font_family = $request->sub_title_font_family;
                $homesliders->text_position = $request->text_position;
                $homesliders->save();

                return redirect()->route('homeslider.index')->with('success','Home Slider update successfully.');
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function homeslider_destroy(Request $request,$id){

        $has_permission = hasPermission('Home Slider');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $home_slider = Home_slider::findOrFail($id);

                $image_path = public_path("home_slider/{$home_slider->image}");

                if (File::exists($image_path)) {
                    unlink($image_path);
                }

                $home_slider->delete();

                if($home_slider)
                {
                    return redirect()->route('homeslider.index')->with('message', 'Home Slider deleted successfully');
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

  //home_our_businesses
   public function home_our_businesses(Request $request)
    {
        $has_permission = hasPermission('Home Our Businesses');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view("admin.home_our_businesses.form"); 
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }


    public function home_our_businesses_insert(Request $request){
        $has_permission = hasPermission('Home Our Businesses');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
      
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

            return redirect()->route('home_our_businesses.index')->with('success','Home Our Businesses insert successfully.');

            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
   }

   public function home_our_businesses_index(Request $request){
        if ($request->ajax()) {
          $home_our_businesses = Home_our_businesses::orderBy('id', 'DESC')->get();
          return Datatables::of($home_our_businesses)
                  ->addIndexColumn()
                  ->addColumn('action', function($home_our_businesses){
          
                        $updateButton = "";
                        $deleteBtn = "";
                        $has_permission = hasPermission('Home Our Businesses');
                        if(isset($has_permission) && $has_permission)
                        {
                            if($has_permission->full_permission == 1)
                            {

                                $updateButton = "<a href='".route("home_our_businesses.edit",encrypt($home_our_businesses->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                                $deleteBtn = "<a href='javascript:void(0);' data-href='".route('home_our_businesses_destroy',array($home_our_businesses->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            }
                        }
                        return $updateButton . $deleteBtn;
                  })

                  ->editColumn('image', function($home_our_businesses){

                      if($home_our_businesses->image == NULL){
                          $url= asset('no_image/notImg.png');
                          $image = '<img src="'.$url.'" border="0" width="100">';
                          return $image;

                      }else{

                          $url= asset('home_our_businesses/'.$home_our_businesses->image);
                          $image = '<img src="'.$url.'" border="0" width="100">';
                          return $image;
                      }
                  })
          ->rawColumns(['action','image'])
          ->make(true);
      }
      
        $has_permission = hasPermission('Home Our Businesses');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view('admin.home_our_businesses.show');

            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        }
    }

    public function home_our_businesses_edit($id){

        $has_permission = hasPermission('Home Our Businesses');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $home_our_businesses  = Home_our_businesses::where('id',decrypt($id))->get();
                return view('admin.home_our_businesses._form',compact('home_our_businesses'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

   public function home_our_businesses_update(Request $request, $id)
   {
        $has_permission = hasPermission('Home Our Businesses');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
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

                return redirect()->route('home_our_businesses.index')->with('success','Home Our Businesses update successfully.');
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function home_our_businesses_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Home Our Businesses');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $home_our_businesses = Home_our_businesses::findOrFail($id);

                $image_path = public_path("home_our_businesses/{$home_our_businesses->image}");

                if (File::exists($image_path)) {
                    unlink($image_path);
                }

                $home_our_businesses->delete();

                if($home_our_businesses)
                {
                    return redirect()->route('home_our_businesses.index')->with('message', 'Home Our Businesses deleted successfully');
                }

            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

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
        }
    }

    public function testimonials_index(Request $request){
        $testimonials = Testimonial::get();
        if ($request->ajax()) {
            $testimonials = Testimonial::get();
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
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }


    //home detail
    public function home_detail(Request $request)
    {
        $has_permission = hasPermission('Home Detail');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $home_details = Home_detail::get();
                return view("admin.home_detail.form",compact('home_details')); 
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function home_detail_insert(Request $request){

        $has_permission = hasPermission('Home Detail');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                
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

                    if($request->hasFile('icon'))
                    {
                        $oldiconImage = $home_detail->icon;
                        if($oldiconImage) {
                            $oldiconImagePath = public_path('icon/') . $oldiconImage;
                            if(File::exists($oldiconImagePath)) {
                                File::delete($oldiconImagePath);
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

                if($file = $request->hasFile('icon')) {
                    $file = $request->file('icon');
                    $icon_extension = $file->getClientOriginalExtension();
                    $iconfileName = time(). '.' . $icon_extension;
            
                    $icon_destinationPath = public_path().'/icon' ;
                    $file->move($icon_destinationPath,$iconfileName);
                    $home_detail->icon = $iconfileName;
                }
            
                $home_detail->title = $request->title;
                $home_detail->sub_title = $request->sub_title;

                $home_detail->title_color = $request->title_color;
                $home_detail->title_font_size = $request->title_font_size;
                $home_detail->title_font_family = $request->title_font_family;

                $home_detail->sub_title_color = $request->sub_title_color;
                $home_detail->sub_title_font_size = $request->sub_title_font_size;
                $home_detail->sub_title_font_family = $request->sub_title_font_family;

                $home_detail->description = $request->description;

                $home_detail->description_color = $request->description_color;
                $home_detail->description_font_size = $request->description_font_size;
                $home_detail->description_font_family = $request->description_font_family;

                $home_detail->businesses_title = $request->businesses_title;
                $home_detail->testimonials_title = $request->testimonials_title;

                $home_detail->amount = $request->amount;
                $home_detail->name = $request->name;

                $home_detail->count_amount_color = $request->count_amount_color;
                $home_detail->count_name_color = $request->count_name_color;
                $home_detail->count_background_color = $request->count_background_color;
                $home_detail->count_amount_font_size = $request->count_amount_font_size;
                $home_detail->count_name_font_size = $request->count_name_font_size;
                $home_detail->count_amount_font_family = $request->count_amount_font_family;
                $home_detail->count_name_font_family = $request->count_name_font_family;

                $home_detail->save();
            
                return redirect()->route('home_detail')->with('success','Home Detail update successfully.');
   
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }

    }


}
