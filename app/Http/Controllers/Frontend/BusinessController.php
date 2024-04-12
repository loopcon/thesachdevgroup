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

class BusinessController extends Controller
{
    public function businessDetail($slug)
    {   
        $return_data = array();                                                                                       
        $return_data['business'] = OurBusiness::select('id', 'title', 'slug', 'description', 'banner_image', 'url', 'title_font_size', 'title_font_color', 'title_font_family', 'description_font_size', 'description_font_color', 'description_font_family', 'why_choose_title', 'why_choose_title_color')->where('slug', $slug)->first();
        return view('frontend.business.index',array_merge($return_data));
    }
}
