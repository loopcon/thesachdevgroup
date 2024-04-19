<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header_menu_social_media_icon;
use App\Models\Header_menu;
use App\Models\Footer_menu;
use App\Models\Footer_menu_description;
use App\Models\Home_slider;
use App\Models\Home_our_businesses;
use App\Models\Home_detail;
use App\Models\Mission_vision;
use App\Models\Count;
use App\Models\Testimonial;
use App\Models\Home_our_businesses_title;
use App\Models\Mission_vision_image;
use App\Models\Testimonials_title;

class HomeController extends Controller
{
    public function home(){

        $header_social_media_icons = Header_menu_social_media_icon::get();

        $header_menu_our_businesses = Header_menu::where('menu_name','our_businesses')->get();
        $header_menu_our_services = Header_menu::where('menu_name','our_services')->get();
        $header_menu_careers = Header_menu::where('menu_name','careers')->get();
        $header_menu_awards_recognitions = Header_menu::where('menu_name','awards_recognition')->get();
        $header_menu_contacts = Header_menu::where('menu_name','contact_us')->get();

        $footer_menus = Footer_menu::get();

        $footer_menu_our_services = Footer_menu::where('menu_name','our_services')->get();
        $footer_menu_our_businesses = Footer_menu::where('menu_name','our_businesses')->get();
        $footer_menu_useful_links = Footer_menu::where('menu_name','useful_links')->get();

        $footer_menu_description = Footer_menu_description::first();

        $home_sliders = Home_slider::get();

        $home_our_businessess = Home_our_businesses::get();
        $home_our_businesses_title = Home_our_businesses_title::first();
      
        $home_details = Home_detail::get();
        
        $mission_visions = Mission_vision::get();
        $mission_visions_imgae = Mission_vision_image::first();

        $counts = Count::get();

        $testimonials = Testimonial::get();

        $testimonials_title = Testimonials_title::first();

        return view('frontend.home',compact('header_social_media_icons','header_menu_our_businesses',
            'header_menu_our_services','header_menu_careers','header_menu_awards_recognitions','header_menu_contacts',
            'footer_menus','footer_menu_our_services','footer_menu_our_businesses','footer_menu_useful_links',
            'footer_menu_description','home_sliders','home_our_businessess','home_our_businesses_title','home_details',
            'mission_visions','mission_visions_imgae','counts','testimonials','testimonials_title'
        ));

    }
}
