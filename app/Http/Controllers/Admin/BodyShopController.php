<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Body_shop;
use App\Models\OurBusiness;
use DataTables;
use File;

class BodyShopController extends Controller
{
    //body_shop
    public function body_shop()
    {
        $has_permission = hasPermission('Body Shops');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop');
                return view("admin.body_shop.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function bodyShopCreate()
    {
        $has_permission = hasPermission('Body Shops');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop Create');
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
                return view("admin.body_shop.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function body_shop_insert(Request $request)
    {
        $has_permission = hasPermission('Body Shops');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
  
                $body_shop = new Body_shop();
                $fields = array('address','address_font_size','address_font_family','address_font_color','email','email_font_size','email_font_family','email_font_color','contact_number','contact_font_size','contact_font_family','contact_font_color','map_link');
                foreach($fields as $field)
                {
                    $body_shop->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                }

                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;

                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;

                    $destinationPath = public_path().'/body_shop_image' ;
                    $file->move($destinationPath,$fileName);
                    $body_shop->image = $fileName;
                }

                $body_shop->name = $request->name;

                $body_shop->slug = $request->name ? slugify($request->name) : NULL;
                $body_shop->business_id = $request->business_id;
                $body_shop->name_color = $request->name_color;
                $body_shop->name_font_size	 = $request->name_font_size;
                $body_shop->name_font_family	 = $request->name_font_family;
                $body_shop->link = $request->link;
                $body_shop->rating = $request->rating;
                $body_shop->number_of_rating = $request->number_of_rating;
                $body_shop->save();
        
                return redirect()->route('body_shop')->with('success','Body Shop insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }


    public function body_shop_index(Request $request)
    {
        if ($request->ajax()) {

            $body_shop = Body_shop::orderBy('id', 'DESC')->get();
            return Datatables::of($body_shop)
                ->addIndexColumn()
                ->addColumn('action', function($body_shop){
                    $updateButton = "";
                    $deleteBtn = "";
                    $has_permission = hasPermission('Body Shops');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                            $updateButton = "<a href='".route("body_shop.edit",encrypt($body_shop->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                            $deleteBtn = "<a href='javascript:void(0);' data-href='".route('body_shop_destroy',array($body_shop->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        }
                    }
                return $updateButton . $deleteBtn;
            })

            ->editColumn('image', function($body_shop){

                if(isset($body_shop->image) && isset($body_shop->image)){
                    $url= url('public/body_shop_image/'.$body_shop->image);
                    $image = '<img src="'.$url.'" border="0" width="50">';
                    return $image;
                }
            })

            ->rawColumns(['action','image'])
            ->make(true);
        }
       
        return redirect()->back()->with('message','something went wrong');
    }

    public function body_shop_edit($id)
    {
        $has_permission = hasPermission('Body Shops');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Body Shop Edit');
                $body_shop = Body_shop::find($id);
                $return_data['record'] = $body_shop;
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
                return view("admin.body_shop.form",array_merge($return_data));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function body_shop_update(Request $request, $id)
    {
        $has_permission = hasPermission('Body Shops');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $body_shop = Body_shop::find(decrypt($id));
                $fields = array('address','address_font_size','address_font_family','address_font_color','email','email_font_size','email_font_family','email_font_color','contact_number','contact_font_size','contact_font_family','contact_font_color','map_link');
                foreach($fields as $field)
                {
                    $body_shop->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                }

                if($request->hasFile('image'))
                {
                    $destination = 'public/body_shop_image/' . $body_shop->image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('public/body_shop_image/', $filename);
                    $body_shop->image = $filename;
                }

                $body_shop->name = $request->name;

                $body_shop->slug = $request->name ? slugify($request->name) : NULL;

                $body_shop->business_id = $request->business_id;
                $body_shop->name_color = $request->name_color;
                $body_shop->name_font_size	 = $request->name_font_size;
                $body_shop->name_font_family	 = $request->name_font_family;
                $body_shop->link = $request->link;
                $body_shop->rating = $request->rating;
                $body_shop->number_of_rating = $request->number_of_rating;
                $body_shop->save();
                

                return redirect()->route('body_shop')->with('success','Body Shop update successfully.');
    
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

    public function body_shop_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Body Shops');

        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $body_shop_image = Body_shop::find($id);

                if($body_shop_image->image != NULL)
                {
                    $image = public_path("body_shop_image/{$body_shop_image->image}");
                    if (File::exists($image)) {
                        unlink($image);
                    }
                }
                $body_shop_image = Body_shop::where('id',$id)->delete();
                if($body_shop_image)
                {
                    return redirect()->route('body_shop')->with('message', 'Body Shop deleted successfully');
                }
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }

    }

}
