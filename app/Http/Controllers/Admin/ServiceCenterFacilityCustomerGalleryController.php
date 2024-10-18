<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use App\Models\ServiceCenterFacilityCustomerGallery;
use DataTables;
use File;
use Auth;

class ServiceCenterFacilityCustomerGalleryController extends Controller
{
    public function serviceCenterFacilityCustomerGalleryList()
    {
        $has_permission = hasPermission('Service Center Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Service Center Facility Customer Gallery');
                return view("admin.service_center_facility_customergallery.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ajaxaServiceCenterFacilityCustomerGalleryHtml(request $request)
    {
        $has_permission = hasPermission('Service Center Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                if($request->ajax()){
                    $id = $request->id;
                    $id = $id ? decrypt($id) : NULL;
                    $record = $id ? ServiceCenterFacilityCustomerGallery::find($id) : NULL;
                    $service_center = ServiceCenter::select('id', 'name')->get();
                    $html = view('admin.service_center_facility_customergallery.ajax_form', array('record' => $record, 'service_center' => $service_center))->render();
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

    public function serviceCenterFacilityCustomerGalleryStore(Request $request)
    {
        $has_permission = hasPermission('Service Center Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'service_center_id' => 'required',
                    'facility_image' => 'image|mimes:jpeg,png,jpg,webp',
                    'customer_gallery_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $service_center_facility_gallery = new ServiceCenterFacilityCustomerGallery();
                $service_center_facility_gallery->service_center_id = $request->service_center_id ? $request->service_center_id : NULL;

                if($request->hasFile('facility_image')) {
                    $facility_image = fileUpload($request, 'facility_image', 'uploads/service_center_facility_image');
                    $service_center_facility_gallery->facility_image = $facility_image;
                }

                if($request->hasFile('customer_gallery_image')) {
                    $customer_gallery_image = fileUpload($request, 'customer_gallery_image', 'uploads/service_center_customer_gallery_image');
                    $service_center_facility_gallery->customer_gallery_image = $customer_gallery_image;
                }

                $service_center_facility_gallery->save();

                if($service_center_facility_gallery)
                {
                    return redirect()->route('service-center-facility-customergallery')->with('success', 'Service Center Facility Customer Gallery insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterFacilityCustomerGalleryDatatable(Request $request)
    {
        if($request->ajax()){
            $query = ServiceCenterFacilityCustomerGallery::with('serviceCenterDetail')->select('id', 'service_center_id', 'facility_image', 'customer_gallery_image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('facility_image', function($list){
                    $facility_image = $list->facility_image ? asset('uploads/service_center_facility_image/'.$list->facility_image) : '';
                    return isset($facility_image) && $facility_image !='' ? '<img src="' . $facility_image . '" alt="" width="50" height="80">' : '';
                })
                ->addColumn('customer_gallery_image', function($list){
                    $customer_gallery_image = $list->customer_gallery_image ? asset('uploads/service_center_customer_gallery_image/'.$list->customer_gallery_image) : '';
                    return isset($customer_gallery_image) && $customer_gallery_image !='' ? '<img src="' . $customer_gallery_image . '" alt="" width="50" height="80">' : '';
                })
                ->addColumn('service_center_id', function($list){
                    $service_center_id = isset($list->serviceCenterDetail->name) && $list->serviceCenterDetail->name ? $list->serviceCenterDetail->name : NULL;
                    return $service_center_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Service Center Facility Customer Gallery');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='javascript:void(0);' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('service-center-facility-customergallery-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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

    public function serviceCenterFacilityCustomerGalleryUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Service Center Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'service_center_id' => 'required',
                    'facility_image' => 'image|mimes:jpeg,png,jpg,webp',
                    'customer_gallery_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $service_center_facility_gallery = ServiceCenterFacilityCustomerGallery::find($id);
                $service_center_facility_gallery->service_center_id = $request->service_center_id ? $request->service_center_id : NULL;

                if($request->hasFile('facility_image')) {
                    $oldimage = $service_center_facility_gallery->facility_image;
                    if($oldimage)
                    {
                        removeFile('uploads/service_center_facility_image/'.$oldimage);
                    }
                    $facility_image = fileUpload($request, 'facility_image', 'uploads/service_center_facility_image');
                    $service_center_facility_gallery->facility_image = $facility_image;
                }

                if($request->hasFile('customer_gallery_image')) {
                    $oldimage = $service_center_facility_gallery->customer_gallery_image;
                    if($oldimage)
                    {
                        removeFile('uploads/service_center_customer_gallery_image/'.$oldimage);
                    }
                    $customer_gallery_image = fileUpload($request, 'customer_gallery_image', 'uploads/service_center_customer_gallery_image');
                    $service_center_facility_gallery->customer_gallery_image = $customer_gallery_image;
                }

                $service_center_facility_gallery->save();

                if($service_center_facility_gallery)
                {
                    return redirect()->route('service-center-facility-customergallery')->with('success', 'Service Center Facility Customer Gallery update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function serviceCenterFacilityCustomerGalleryDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Service Center Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $service_center_fc_image = ServiceCenterFacilityCustomerGallery::find($id);
                if($service_center_fc_image->facility_image != NULL)
                {
                    $facility_image = $service_center_fc_image->facility_image;
                    if($facility_image)
                    {
                        removeFile('uploads/service_center_facility_image/'.$facility_image);
                    }
                }

                if($service_center_fc_image->customer_gallery_image != NULL)
                {
                    $customer_gallery_image = $service_center_fc_image->customer_gallery_image;
                    if($customer_gallery_image)
                    {
                        removeFile('uploads/service_center_customer_gallery_image/'.$customer_gallery_image);
                    }
                }
                $service_center_fc_image = ServiceCenterFacilityCustomerGallery::where('id',$id)->delete();
                if($service_center_fc_image)
                {
                    return redirect()->route('service-center-facility-customergallery')->with('success', 'Service Center Facility Customer Gallery deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

}
