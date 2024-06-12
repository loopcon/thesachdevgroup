<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Our_location;
use App\Models\Showroom;
use App\Models\ServiceCenter;
use App\Models\Body_shop;
use App\Models\OurBusiness;

class locationDetailController extends Controller
{
    //locationDetail
    public function locationDetail()
    {
        $return_data = array();     
        $return_data['our_location'] = Our_location::first();
        $return_data['showrooms'] = Showroom::get();
        $return_data['showroom_first'] = Showroom::first();
        $return_data['service_center_first'] = ServiceCenter::first();
        $return_data['body_shops_first'] = Body_shop::first();
        $return_data['businesses'] = OurBusiness::select('id','title')->get();
        $return_data['service_center'] = ServiceCenter::select('id','name','slug','business_id','name_color','name_font_size','name_font_family','image', 'address', 'address_font_color','address_font_size','address_font_family','contact_number','email','map_link')->get();
        $return_data['body_shops'] = Body_shop::select('id','business_id','image','name','name_color','name_font_size','name_font_family','address','address_font_size','address_font_family','address_font_color','email','email_font_size','email_font_family','email_font_color','contact_number','contact_font_size','contact_font_family','contact_font_color','map_link')->get();
        return view('frontend.our_location.index',array_merge($return_data));
    }
}
