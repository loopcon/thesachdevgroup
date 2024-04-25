<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurBusiness;
use App\Models\Service;
use App\Models\Showroom;
use App\Models\Body_shop;
use App\Models\Used_car;
use App\Models\ServiceCenter;
use App\Models\OurBusinessInsurance;
use App\Models\Car;

class BusinessController extends Controller
{
    public function businessDetail($slug)
    {   
        $return_data = array();                                                                                       
        $business = OurBusiness::select('id', 'title', 'slug', 'description', 'banner_image', 'url', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family', 'why_choose_title', 'why_choose_title_color', 'why_choose_title_font_size', 'why_choose_title_font_family', 'why_choose_image', 'why_choose_description', 'why_choose_description_color', 'why_choose_description_font_size', 'why_choose_description_font_family','showroom_title', 'showroom_title_color', 'showroom_title_font_size', 'showroom_title_font_family', 'service_center_title', 'service_center_title_color', 'service_center_title_font_size', 'service_center_title_font_family', 'body_shop_title', 'body_shop_title_color', 'body_shop_title_font_size', 'body_shop_title_font_family', 'insurance_title', 'insurance_title_color', 'insurance_title_font_size', 'insurance_title_font_family')->where('slug', $slug)->first();
        $return_data['business'] = $business;
        $return_data['showrooms'] = Showroom::select('id', 'our_business_id', 'name', 'name_color', 'name_font_size', 'name_font_family','slider_image','slider_showroom_name','slider_showroom_name_color','slider_showroom_name_font_size','slider_showroom_name_font_family','image','rating','number_of_rating')->where('our_business_id', $business->id)->get();
        $return_data['services'] = Service::select('id', 'business_id', 'name', 'icon', 'url', 'name_font_color', 'name_font_size', 'name_font_family')->where('business_id', $business->id)->get();
        $return_data['body_shops'] = Body_shop::select('id', 'business_id', 'name', 'image', 'link', 'name_color', 'name_font_size', 'name_font_family', 'rating', 'number_of_rating')->where('business_id', $business->id)->get();
        $return_data['used_cars'] = Used_car::select('id', 'business_id', 'name', 'image', 'link', 'name_color', 'name_font_size', 'name_font_family', 'rating', 'number_of_rating')->where('business_id', $business->id)->get();
        $return_data['service_centers'] = ServiceCenter::select('id', 'business_id', 'name', 'name_color', 'name_font_size', 'name_font_family', 'image', 'rating', 'number_of_rating', 'slider_image', 'slider_service_center_name','slider_service_center_name_color', 'slider_service_center_name_size', 'slider_service_center_name_font_family')->where('business_id', $business->id)->get();
        $return_data['business_insurance'] = OurBusinessInsurance::select('id', 'business_id', 'name', 'name_font_size', 'name_font_family', 'name_font_color', 'icon', 'url')->where('business_id', $business->id)->get();
        $return_data['car_model'] = Car::select('id', 'image', 'name', 'name_font_size', 'name_font_family', 'name_color','link')->where('our_business_id', $business->id)->get();

        return view('frontend.business.index',array_merge($return_data));
    }
}
