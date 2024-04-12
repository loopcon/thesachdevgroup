<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Header_menu;
use App\Models\Header_menu_social_media_icon;
use App\Models\Footer_menu;
use App\Models\Home_slider;
use App\Models\Home_our_businesses;
use App\Models\Home_detail;
use App\Models\Mission_vision;
use App\Models\OurBusiness;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     //
    // }

    public function boot(): void
    {        
        $header_social_media_icons = Header_menu_social_media_icon::get();
        view()->share('header_social_media_icons', $header_social_media_icons);

        $header_menu_our_businesses = Header_menu::where('menu_name','our_businesses')->get();
        view()->share('header_menu_our_businesses', $header_menu_our_businesses);

        $header_menu_our_services = Header_menu::where('menu_name','our_services')->get();
        view()->share('header_menu_our_services', $header_menu_our_services);

        $header_menu_awards_recognitions = Header_menu::where('menu_name','awards_recognition')->get();
        view()->share('header_menu_awards_recognitions', $header_menu_awards_recognitions);

        $header_menu_contacts = Header_menu::where('menu_name','contact_us')->get();
        view()->share('header_menu_contacts', $header_menu_contacts);

        $footer_menus = Footer_menu::get();
        view()->share('footer_menus', $footer_menus);

        $footer_menu_our_services = Footer_menu::where('menu_name','our_services')->get();
        view()->share('footer_menu_our_services', $footer_menu_our_services);

        $footer_menu_our_businesses = Footer_menu::where('menu_name','our_businesses')->get();
        view()->share('footer_menu_our_businesses', $footer_menu_our_businesses);

        $footer_menu_useful_links = Footer_menu::where('menu_name','useful_links')->get();
        view()->share('footer_menu_useful_links', $footer_menu_useful_links);

        $home_sliders = Home_slider::get();
        view()->share('home_sliders', $home_sliders);

        $home_our_businessess = Home_our_businesses::get();
        view()->share('home_our_businessess', $home_our_businessess);

        $home_our_businesses_background_color = Home_our_businesses::pluck('background_color')->toArray();
        view()->share('home_our_businesses_background_color', $home_our_businesses_background_color);

        $home_details = Home_detail::get();
        view()->share('home_details', $home_details);

        $mission_visions = Mission_vision::get();
        view()->share('mission_visions', $mission_visions);

        $our_business = OurBusiness::select('id', 'title', 'slug', 'url')->get();
        view()->share('our_business', $our_business);
    }
}
