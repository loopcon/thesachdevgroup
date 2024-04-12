<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header_menu_social_media_icon;
use App\Models\Header_menu;
use App\Models\Footer_menu;
use App\Models\Home_slider;
use App\Models\Home_our_businesses;
use App\Models\Home_detail;
use App\Models\Mission_vision;
use App\Models\OurBusiness;

class HomeController extends Controller
{
    public function home(){

        $header_social_media_icons = Header_menu_social_media_icon::get();

        $header_menu_our_businesses = Header_menu::where('menu_name','our_businesses')->get();
        $header_menu_our_services = Header_menu::where('menu_name','our_services')->get();
        $header_menu_awards_recognitions = Header_menu::where('menu_name','awards_recognition')->get();
        $header_menu_contacts = Header_menu::where('menu_name','contact_us')->get();

        $footer_menus = Footer_menu::get();

        $footer_menu_our_services = Footer_menu::where('menu_name','our_services')->get();
        $footer_menu_our_businesses = Footer_menu::where('menu_name','our_businesses')->get();
        $footer_menu_useful_links = Footer_menu::where('menu_name','useful_links')->get();

        $home_sliders = Home_slider::get();

        $home_our_businessess = Home_our_businesses::get();
        $home_our_businesses_background_color = Home_our_businesses::pluck('background_color')->toArray();

        $home_details = Home_detail::get();
        
        $mission_visions = Mission_vision::get();

        return view('frontend.home',compact('header_social_media_icons','header_menu_our_businesses',
            'header_menu_our_services','header_menu_awards_recognitions','header_menu_contacts',
            'footer_menus','footer_menu_our_services','footer_menu_our_businesses','footer_menu_useful_links',
            'home_sliders','home_our_businessess','home_our_businesses_background_color','home_details',
            'mission_visions'
        ));

    }
}
