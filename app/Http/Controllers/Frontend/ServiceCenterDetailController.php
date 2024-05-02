<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use App\Models\OurBusiness;
use App\Models\ServiceCenterFacilityCustomerGallery;
use App\Models\ServiceCenterTestimonial;

class ServiceCenterDetailController extends Controller
{
    public function serviceCenter($slug)
    {
        $return_data = array();
        $service_center = ServiceCenter::with('service')->select('id', 'service_id', 'name', 'slug', 'name_color', 'name_font_size', 'name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_icon', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_icon', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_icon', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_icon', 'email_font_size', 'email_font_family', 'email_font_color', 'rating')->where('slug',$slug)->first();
        $return_data['service_center'] = $service_center;
        // print_r($return_data['service_center']);exit;
        //  dd($return_data['service_center']);
        $return_data['facility'] = ServiceCenterFacilityCustomerGallery::where('service_center_id',$service_center->id)->get();
        $return_data['testimonials'] = ServiceCenterTestimonial::where('service_center_id',$service_center->id)->get();
        return view('frontend.service_center.index',array_merge($return_data));
    }
}
