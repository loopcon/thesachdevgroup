<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showroom;
use App\Models\Car;
use App\Models\Showroom_facility_customer_gallery;
use App\Models\ShowroomTestimonial;

class ShowroomDetailController extends Controller
{
    public function showroom($slug)
    {
        $return_data = array();
        $showroom = Showroom::select('id', 'slug','image','name','name_color','name_font_size','name_font_family','car_id','address','working_hours','contact_number','email','address_color','address_font_size','address_font_family','address_icon','working_hours_color','working_hours_font_size','working_hours_font_family','working_hours_icon','contact_number_color','contact_number_font_size','contact_number_font_family','contact_number_icon','email_color','email_font_size','email_font_family','email_icon','rating','number_of_rating','description','description_color','description_font_size','description_font_family','facility_title','facility_title_color','facility_title_font_size','facility_title_font_family','customer_gallery_title','customer_gallery_title_color','customer_gallery_title_font_size','customer_gallery_title_font_family','testimonial_title','testimonial_title_color','testimonial_title_font_size','testimonial_title_font_family','lets_connect_image','address_title','address_title_color','address_title_font_size','address_title_font_family','working_hour_title','working_hour_title_color','working_hour_title_font_size','working_hour_title_font_family','contact_title','contact_title_color','contact_title_font_size','contact_title_font_family','email_title','email_title_color','email_title_font_size','email_title_font_family',)->where('slug',$slug)->first();
        $return_data['showroom'] = $showroom;

        $car_id = isset($showroom->car_id) && $showroom->car_id ? json_decode($showroom->car_id) : '';
        $return_data['cars'] = Car::whereIn('id',$car_id)->select('name','image','name_color','name_font_size','name_font_family','link')->get();
        $return_data['facility'] = Showroom_facility_customer_gallery::where('showroom_id',$showroom->id)->get();
        $return_data['testimonials'] = ShowroomTestimonial::where('showroom_id',$showroom->id)->get();
        return view('frontend.showroom.index',array_merge($return_data));
    }
}
