<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header_menu_social_media_icon;
use App\Models\Header_menu;
use App\Models\Footer_menu;
use App\Models\Home_slider;

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

        return view('frontend.home',compact('header_social_media_icons','header_menu_our_businesses',
            'header_menu_our_services','header_menu_awards_recognitions','header_menu_contacts',
            'footer_menus','footer_menu_our_services','footer_menu_our_businesses','footer_menu_useful_links',
            'home_sliders'
        ));

    }
}
