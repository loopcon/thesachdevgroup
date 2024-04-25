<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contact_us;
use App\Models\Header_menu_social_media_icon;

class ContactUsDetailController extends Controller
{
    //contactus_detail
    public function contactusDetail()
    {
        $return_data = array();     
        $return_data['contact_us'] = Contact_us::first();
        $return_data['header_social_media_icons'] = Header_menu_social_media_icon::get();
        return view('frontend.contact_us.index',array_merge($return_data));

    }
}
