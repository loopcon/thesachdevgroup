<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BodyShopFacilityCustomerGallery;
use App\Models\Body_shop;
use DataTables;
use File;
use Auth;

class BodyShopFacilityCustomerGalleryController extends Controller
{
    public function bodyShopFacilityCustomerGalleryList()
    {
        $has_permission = hasPermission('Body Shop Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Body Shop Facility Customer Gallery');
                return view("admin.body_shop_facility_customer_gallery.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function ajaxabodyShopFacilityCustomerGalleryHtml(request $request)
    {
        $has_permission = hasPermission('Body Shop Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                if($request->ajax()){
                    $id = $request->id;
                    $id = $id ? decrypt($id) : NULL;
                    $record = $id ? BodyShopFacilityCustomerGallery::find($id) : NULL;
                    $body_shop = Body_shop::select('id', 'name')->get();
                    $html = view('admin.body_shop_facility_customer_gallery.ajax_form', array('record' => $record, 'body_shop' => $body_shop))->render();
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

    public function bodyShopFacilityCustomerGalleryStore(Request $request)
    {
        $has_permission = hasPermission('Body Shop Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'body_shop_id' => 'required',
                    'facility_image' => 'image|mimes:jpeg,png,jpg,webp',
                    'customer_gallery_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $body_shop_facility_gallery = new BodyShopFacilityCustomerGallery();
                $body_shop_facility_gallery->body_shop_id = $request->body_shop_id ? $request->body_shop_id : NULL;

                if($request->hasFile('facility_image')) {
                    $facility_image = fileUpload($request, 'facility_image', 'uploads/body_shop_facility_image');
                    $body_shop_facility_gallery->facility_image = $facility_image;
                }

                if($request->hasFile('customer_gallery_image')) {
                    $customer_gallery_image = fileUpload($request, 'customer_gallery_image', 'uploads/body_shop_customer_gallery_image');
                    $body_shop_facility_gallery->customer_gallery_image = $customer_gallery_image;
                }

                $body_shop_facility_gallery->save();

                if($body_shop_facility_gallery)
                {
                    return redirect()->route('body-shop-facility-customer-gallery')->with('success', 'Body Shop Facility Customer Gallery insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function bodyShopFacilityCustomerGalleryDatatable(Request $request)
    {
        if($request->ajax()){
            $query = BodyShopFacilityCustomerGallery::with('bodyShopDetail')->select('id', 'body_shop_id', 'facility_image', 'customer_gallery_image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('facility_image', function($list){
                    $facility_image = $list->facility_image ? asset('uploads/body_shop_facility_image/'.$list->facility_image) : '';
                    return isset($facility_image) && $facility_image !='' ? '<img src="' . $facility_image . '" alt="" width="50" height="80">' : '';
                })
                ->addColumn('customer_gallery_image', function($list){
                    $customer_gallery_image = $list->customer_gallery_image ? asset('uploads/body_shop_customer_gallery_image/'.$list->customer_gallery_image) : '';
                    return isset($customer_gallery_image) && $customer_gallery_image !='' ? '<img src="' . $customer_gallery_image . '" alt="" width="50" height="80">' : '';
                })
                ->addColumn('body_shop_id', function($list){
                    $body_shop_id = isset($list->bodyShopDetail->name) && $list->bodyShopDetail->name ? $list->bodyShopDetail->name : NULL;
                    return $body_shop_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Body Shop Facility Customer Gallery');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='javascript:void(0);' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('body-shop-facility-customer-gallery-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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

    public function bodyShopFacilityCustomerGalleryUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Body Shop Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'body_shop_id' => 'required',
                    'facility_image' => 'image|mimes:jpeg,png,jpg,webp',
                    'customer_gallery_image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $body_shop_facility_gallery = BodyShopFacilityCustomerGallery::find($id);
                $body_shop_facility_gallery->body_shop_id = $request->body_shop_id ? $request->body_shop_id : NULL;

                if($request->hasFile('facility_image')) {
                    $oldimage = $body_shop_facility_gallery->facility_image;
                    if($oldimage)
                    {
                        removeFile('uploads/body_shop_facility_image/'.$oldimage);
                    }
                    $facility_image = fileUpload($request, 'facility_image', 'uploads/body_shop_facility_image');
                    $body_shop_facility_gallery->facility_image = $facility_image;
                }

                if($request->hasFile('customer_gallery_image')) {
                    $oldimage = $body_shop_facility_gallery->customer_gallery_image;
                    if($oldimage)
                    {
                        removeFile('uploads/body_shop_customer_gallery_image/'.$oldimage);
                    }
                    $customer_gallery_image = fileUpload($request, 'customer_gallery_image', 'uploads/body_shop_customer_gallery_image');
                    $body_shop_facility_gallery->customer_gallery_image = $customer_gallery_image;
                }

                $body_shop_facility_gallery->save();

                if($body_shop_facility_gallery)
                {
                    return redirect()->route('body-shop-facility-customer-gallery')->with('success', 'Body Shop Facility Customer Gallery update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function bodyShopFacilityCustomerGalleryDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Body Shop Facility Customer Gallery');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $body_shop_fc_image = BodyShopFacilityCustomerGallery::find($id);
                if($body_shop_fc_image->facility_image != NULL)
                {
                    $facility_image = $body_shop_fc_image->facility_image;
                    if($facility_image)
                    {
                        removeFile('uploads/body_shop_facility_image/'.$facility_image);
                    }
                }

                if($body_shop_fc_image->customer_gallery_image != NULL)
                {
                    $customer_gallery_image = $body_shop_fc_image->customer_gallery_image;
                    if($customer_gallery_image)
                    {
                        removeFile('uploads/body_shop_customer_gallery_image/'.$customer_gallery_image);
                    }
                }
                $body_shop_fc_image = BodyShopFacilityCustomerGallery::where('id',$id)->delete();
                if($body_shop_fc_image)
                {
                    return redirect()->route('body-shop-facility-customer-gallery')->with('success', 'Body Shop Facility Customer Gallery deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
