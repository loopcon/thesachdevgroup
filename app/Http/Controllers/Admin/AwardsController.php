<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Awards;
use App\Models\Showroom;
use App\Models\AwardBanner;
use App\Models\OurBusiness;
use DataTables;
use File;

class AwardsController extends Controller
{
    public function awardList()
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Awards');
                return view("admin.award.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function ajaxAwardHtml(request $request)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                if($request->ajax()){
                    $id = $request->id;
                    $id = $id ? decrypt($id) : NULL;
                    $record = $id ? Awards::find($id) : NULL;
                    $our_business = OurBusiness::select('id', 'title')->get();
                    $html = view('admin.award.ajax_form', array('record' => $record, 'our_business' => $our_business))->render();
                    $return = array();
                    $return['html'] = $html;
                    echo json_encode($return);
                } else {
                    return redirect('dashboard');
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardStore(Request $request)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'business_id' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);

                $award = new Awards();
                $award->business_id = $request->business_id ? $request->business_id : NULL;
                $award->name = $request->name ? $request->name : NULL;
                if($request->hasFile('image')) {
                    $image = fileUpload($request, 'image', 'uploads/award');
                    $award->image = $image;
                }
                $award->save();

                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardDatatable(Request $request)
    {
        if($request->ajax()){
            $query = Awards::with('businessdDetail')->select('id', 'business_id', 'name', 'image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $image = $list->image ? asset('uploads/award/'.$list->image) : '';
                    return '<img src="' . $image . '" alt="" width="100">';
                }) 
                ->addColumn('business_id', function($list){
                    $business_id = isset($list->businessdDetail->title) && $list->businessdDetail->title ? $list->businessdDetail->title : NULL;
                    return $business_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Awards');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='javascript:void(0);' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('award-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['image', 'business_id', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function awardUpdate(Request $request, $id)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'business_id' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $award = Awards::find($id);
                $award->business_id = $request->business_id ? $request->business_id : NULL;
                $award->name = $request->name ? $request->name : NULL;

                if($request->hasFile('image')) {
                    $oldimg = $award->image;
                    if($oldimg)
                    {
                        removeFile('uploads/award/'.$oldimg);
                    }
                    $image = fileUpload($request, 'image', 'uploads/award');
                    $award->image = $image;
                }
                $award->save();

                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $award = Awards::find($id);
                if($award->image != NULL)
                {
                    $image = $award->image;
                    if($image)
                    {
                        removeFile('uploads/award/'.$image);
                    }
                }
                $award = Awards::where('id',$id)->delete();
                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function awardBannerCreate(Request $request)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Award Banner');
                $banner = AwardBanner::first();
                $return_data['record'] = $banner;
                return view("admin.award.award_banner",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardBannerUpdate(Request $request)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Award Banner');
                $banner = AwardBanner::first();
                $banner->award_title = $request->award_title;
                $banner->award_title_font_size = $request->award_title_font_size;
                $banner->award_title_font_color = $request->award_title_font_color;
                $banner->award_title_font_family = $request->award_title_font_family;
                
                if($request->hasFile('banner_image')) {
                    $oldimg = $banner->banner_image;
                    if($oldimg)
                    {
                        removeFile('uploads/award_banner/'.$oldimg);
                    }
                    $banner_image = fileUpload($request, 'banner_image', 'uploads/award_banner');
                    $banner->banner_image = $banner_image;
                }
                $banner->save();
                if($banner)
                {
                    return redirect()->back()->with('success', 'Award Banner update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }
}
