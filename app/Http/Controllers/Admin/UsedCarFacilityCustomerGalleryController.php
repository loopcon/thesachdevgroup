<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Used_car;
use App\Models\UsedCarFacilityCustomerGallery;
use DataTables;
use File;
use Auth;

class UsedCarFacilityCustomerGalleryController extends Controller
{
    public function usedCarFacilityCustomerGalleryList()
    {
        $has_permission = hasPermission('Used Car Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Used Car Facility Customer Gallery');
                return view("admin.used_car_facility_customer_gallery.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ajaxaUsedCarFacilityCustomerGalleryHtml(request $request)
    {
        $has_permission = hasPermission('Used Car Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                if($request->ajax()){
                    $id = $request->id;
                    $id = $id ? decrypt($id) : NULL;
                    $record = $id ? UsedCarFacilityCustomerGallery::find($id) : NULL;
                    $used_car = Used_car::select('id', 'name')->get();
                    $html = view('admin.used_car_facility_customer_gallery.ajax_form', array('record' => $record, 'used_car' => $used_car))->render();
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

    public function usedCarFacilityCustomerGalleryStore(Request $request)
    {
        $has_permission = hasPermission('Used Car Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'used_car_id' => 'required',
                    'facility_image' => 'image|mimes:jpeg,png,jpg,webp',
                    'customer_gallery_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $used_car_facility_gallery = new UsedCarFacilityCustomerGallery();
                $used_car_facility_gallery->used_car_id = $request->used_car_id ? $request->used_car_id : NULL;

                if($request->hasFile('facility_image')) {
                    $facility_image = fileUpload($request, 'facility_image', 'uploads/used_car_facility_image');
                    $used_car_facility_gallery->facility_image = $facility_image;
                }

                if($request->hasFile('customer_gallery_image')) {
                    $customer_gallery_image = fileUpload($request, 'customer_gallery_image', 'uploads/used_car_customer_gallery_image');
                    $used_car_facility_gallery->customer_gallery_image = $customer_gallery_image;
                }

                $used_car_facility_gallery->save();

                if($used_car_facility_gallery)
                {
                    return redirect()->route('used-car-facility-customer-gallery')->with('success', 'Used Car Facility Customer Gallery insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function usedCarFacilityCustomerGalleryDatatable(Request $request)
    {
        if($request->ajax()){
            $query = UsedCarFacilityCustomerGallery::with('usedCarDetail')->select('id', 'used_car_id', 'facility_image', 'customer_gallery_image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('facility_image', function($list){
                    $facility_image = $list->facility_image ? asset('uploads/used_car_facility_image/'.$list->facility_image) : '';
                    return isset($facility_image) && $facility_image !='' ? '<img src="' . $facility_image . '" alt="" width="50" height="80">' : '';
                })
                ->addColumn('customer_gallery_image', function($list){
                    $customer_gallery_image = $list->customer_gallery_image ? asset('uploads/used_car_customer_gallery_image/'.$list->customer_gallery_image) : '';
                    return isset($customer_gallery_image) && $customer_gallery_image !='' ? '<img src="' . $customer_gallery_image . '" alt="" width="50" height="80">' : '';
                })
                ->addColumn('used_car_id', function($list){
                    $used_car_id = isset($list->usedCarDetail->name) && $list->usedCarDetail->name ? $list->usedCarDetail->name : NULL;
                    return $used_car_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Used Car Facility Customer Gallery');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='javascript:void(0);' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('used-car-facility-customer-gallery-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['facility_image', 'customer_gallery_image', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function usedCarFacilityCustomerGalleryUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Used Car Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'used_car_id' => 'required',
                    'facility_image' => 'image|mimes:jpeg,png,jpg,webp',
                    'customer_gallery_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $used_car_facility_gallery = UsedCarFacilityCustomerGallery::find($id);
                $used_car_facility_gallery->used_car_id = $request->used_car_id ? $request->used_car_id : NULL;

                if($request->hasFile('facility_image')) {
                    $oldimage = $used_car_facility_gallery->facility_image;
                    if($oldimage)
                    {
                        removeFile('uploads/used_car_facility_image/'.$oldimage);
                    }
                    $facility_image = fileUpload($request, 'facility_image', 'uploads/used_car_facility_image');
                    $used_car_facility_gallery->facility_image = $facility_image;
                }

                if($request->hasFile('customer_gallery_image')) {
                    $oldimage = $used_car_facility_gallery->customer_gallery_image;
                    if($oldimage)
                    {
                        removeFile('uploads/used_car_customer_gallery_image/'.$oldimage);
                    }
                    $customer_gallery_image = fileUpload($request, 'customer_gallery_image', 'uploads/used_car_customer_gallery_image');
                    $used_car_facility_gallery->customer_gallery_image = $customer_gallery_image;
                }

                $used_car_facility_gallery->save();

                if($used_car_facility_gallery)
                {
                    return redirect()->route('used-car-facility-customer-gallery')->with('success', 'Used Car Facility Customer Gallery update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function usedCarFacilityCustomerGalleryDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Used Car Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $used_car_fc_image = UsedCarFacilityCustomerGallery::find($id);
                if($used_car_fc_image->facility_image != NULL)
                {
                    $facility_image = $used_car_fc_image->facility_image;
                    if($facility_image)
                    {
                        removeFile('uploads/used_car_facility_image/'.$facility_image);
                    }
                }

                if($used_car_fc_image->customer_gallery_image != NULL)
                {
                    $customer_gallery_image = $used_car_fc_image->customer_gallery_image;
                    if($customer_gallery_image)
                    {
                        removeFile('uploads/used_car_customer_gallery_image/'.$customer_gallery_image);
                    }
                }
                $used_car_fc_image = UsedCarFacilityCustomerGallery::where('id',$id)->delete();
                if($used_car_fc_image)
                {
                    return redirect()->route('used-car-facility-customer-gallery')->with('success', 'Used Car Facility Customer Gallery deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
