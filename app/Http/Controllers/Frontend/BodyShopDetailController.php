<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Body_shop;
use App\Models\BodyShopTestimonial;
use App\Models\Car;
use App\Models\Header_menu;

class BodyShopDetailController extends Controller
{
    public function bodyShop($slug)
    {
        $return_data = array();
        $body_shop = Body_shop::select('id', 'slug','image','name','name_color','name_font_size','name_font_family','car_model_id','address','working_hours','contact_number','email','address_font_color','address_font_size','address_font_family','address_icon','working_hours_font_color','working_hours_font_size','working_hours_font_family','working_hours_icon','contact_font_color','contact_font_size','contact_font_family','contact_icon','email_font_color','email_font_size','email_font_family','email_icon','rating','number_of_rating','description','description_font_color','description_font_size','description_font_family','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','lets_connect_image','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size','email_title_font_family','meta_title','meta_keyword','meta_description')->where('slug',$slug)->first();
        $return_data['body_shop'] = $body_shop;

        $car_model_id = isset($body_shop->car_model_id) && $body_shop->car_model_id ? json_decode($body_shop->car_model_id) : '';
        if($car_model_id)
        {
            $return_data['cars'] = Car::whereIn('id',$car_model_id)->select('name','name_color','name_font_size','name_font_family','image')->get();
        }

        $return_data['testimonials'] = BodyShopTestimonial::where('body_shop_id',$body_shop->id)->get();
        // $return_data['facility'] = UsedCarFacilityCustomerGallery::select('facility_image')->where('used_car_id',$used_car->id)->get();
        // $return_data['customer_gallery'] = UsedCarFacilityCustomerGallery::select('customer_gallery_image')->where('used_car_id',$used_car->id)->get();
        $return_data['our_services'] = Header_menu::where('menu_name','Our Services')->get();

        $return_data['meta_keyword'] = isset($body_shop->meta_keyword) && $body_shop->meta_keyword ? $body_shop->meta_keyword : NULL;
        $return_data['meta_title'] = isset($body_shop->meta_title) && $body_shop->meta_title ? $body_shop->meta_title : NULL;
        $return_data['meta_description'] = isset($body_shop->meta_description) && $body_shop->meta_description ? $body_shop->meta_description : NULL;

        return view('frontend.body_shop.index',array_merge($return_data));
    }
}
