<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact_us;
use App\Models\QuickContactUs;
use App\Models\OurBusiness;
use File;
use DataTables;

class ContactUsController extends Controller
{
    public function contact_us()
    {
        $has_permission = hasPermission('Contact Us');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Contact Us');
                $contact_us = Contact_us::first();
                $return_data['record'] = $contact_us;
                return view("admin.contact_us.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function contact_us_insert(Request $request){

        $has_permission = hasPermission('Contact Us');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $existing_data = Contact_us::find(1);

                if($existing_data) {
                    $contact_us = $existing_data;
            
                    if($request->hasFile('image'))
                    {
                        $oldImage = $contact_us->image;
                        if($oldImage) {
                            $oldImagePath = public_path('contact_us/') . $oldImage;
                            if(File::exists($oldImagePath)) {
                                File::delete($oldImagePath);
                            }
                        }
                    }
                    if(!$contact_us->slug){
                        $contact_us->slug = slugify($request->title);
                    }

                } else {
                    $contact_us = new Contact_us();

                    $contact_us->slug = slugify($request->title);
                }
            
                if($file = $request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time(). '.' . $extension;
            
                    $destinationPath = public_path().'/contact_us' ;
                    $file->move($destinationPath,$fileName);
                    $contact_us->image = $fileName;
                }

                $contact_us->title = $request->title;
                $contact_us->title_color = $request->title_color;
                $contact_us->title_font_size = $request->title_font_size;
                $contact_us->title_font_family = $request->title_font_family;


                $contact_us->sub_title = $request->sub_title;
                $contact_us->sub_title_color = $request->sub_title_color;
                $contact_us->sub_title_font_size = $request->sub_title_font_size;
                $contact_us->sub_title_font_family = $request->sub_title_font_family;

                $contact_us->form_title = $request->form_title;
                $contact_us->form_title_color = $request->form_title_color;
                $contact_us->form_title_font_size = $request->form_title_font_size;
                $contact_us->form_title_font_family = $request->form_title_font_family;

                $contact_us->form_sub_title = $request->form_sub_title;
                $contact_us->form_sub_title_color = $request->form_sub_title_color;
                $contact_us->form_sub_title_font_size = $request->form_sub_title_font_size;
                $contact_us->form_sub_title_font_family = $request->form_sub_title_font_family;

                $contact_us->map_link = $request->map_link;


                $contact_us->save();
            
                return redirect()->route('contact_us')->with('success','Contact Us update successfully.');
   
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function contactUsQueryList(Request $request)
    {
        $has_permission = hasPermission('Quick Contact Us Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Quick Contact Us Query');

                return view("admin.quick_contact_query.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function contactUsQueryDatatable(Request $request)
    {
        if($request->ajax()){
            $query = QuickContactUs::with('businessDetail')->select('id', 'business_id', 'first_name', 'phone', 'email', 'location')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('business_id', function($list){
                    $business_id = isset($list->businessDetail->title) && $list->businessDetail->title ? $list->businessDetail->title : NULL;
                    return $business_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Quick Contact Us Query');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('contact-us-query-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('booked-car-service-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function contactUsQueryDestroy($id)
    {
        $has_permission = hasPermission('Quick Contact Us Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $contact_query = QuickContactUs::where('id',$id)->delete();
                if($contact_query)
                {
                    return redirect()->back()->with('success','Contact Query deleted successfully.');
                }else{
                    return redirect()->back()->with('error','something went wrong,please try again.');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function contactUsQueryEdit(Request $request,$id)
    {
        $has_permission = hasPermission('Quick Contact Us Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $return_data = array();
                $return_data['site_title'] = trans('Quick Contact Us Query Edit');
                $return_data['record'] = QuickContactUs::find($id);
                $return_data['our_business'] = OurBusiness::select('id','title')->get();

                return view('admin.quick_contact_query.form',array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }


    }

    public function contactUsQueryUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Quick Contact Us Query');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'first_name' => 'required',
                    'phone' => 'required|numeric',
                    'email' => 'required',
                ]);

                $contact_query = QuickContactUs::find($id);
                $contact_query->first_name = $request->first_name;
                $contact_query->phone = $request->phone;
                $contact_query->email = $request->email;
                $contact_query->business_id = $request->business_id;

                $contact_query->save();

                if($contact_query)
                {
                    return redirect()->route('contact-us-query')->with('success', 'Contact Query update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
