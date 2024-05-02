<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use App\Models\OurBusiness;
use App\Models\ServiceCenterFacilityCustomerGallery;
use App\Models\ServiceCenterTestimonial;
use App\Models\Service;

class ServiceCenterDetailController extends Controller
{
    public function serviceCenter($slug)
    {
        $return_data = array();
        $service_center = ServiceCenter::with('service')->select('id', 'service_id', 'name', 'slug', 'name_color', 'name_font_size', 'name_font_family', 'image', 'description', 'description_font_size', 'description_font_family', 'description_font_color', 'address', 'address_icon', 'address_font_size', 'address_font_family', 'address_font_color', 'working_hours', 'working_hours_icon', 'working_hours_font_size', 'working_hours_font_family', 'working_hours_font_color', 'contact_number', 'contact_icon', 'contact_font_size', 'contact_font_family', 'contact_font_color', 'email', 'email_icon', 'email_font_size', 'email_font_family', 'email_font_color','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','lets_connect_image','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size', 'email_title_font_family')->where('slug',$slug)->first();
        $return_data['service_center'] = $service_center;

        $service_id = json_decode($service_center->service_id);
        $return_data['services'] = Service::whereIn('id',$service_id)->get();
        $return_data['facility'] = ServiceCenterFacilityCustomerGallery::where('service_center_id',$service_center->id)->get();
        $return_data['testimonials'] = ServiceCenterTestimonial::where('service_center_id',$service_center->id)->get();
        return view('frontend.service_center.index',array_merge($return_data));
    }
}
