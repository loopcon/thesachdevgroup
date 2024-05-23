<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contact_us;
use App\Models\Header_menu_social_media_icon;
use App\Models\QuickContactUs;

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

    public function contactUsFormStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
        ]);

        $contact_us = new QuickContactUs();
        $contact_us->first_name = $request->first_name;
        $contact_us->phone = $request->phone;
        $contact_us->email = $request->email;
        $contact_us->business_id = $request->business_id;
        $contact_us->location = $request->location;
        $contact_us->description = $request->description;
        $contact_us->save();

        if($contact_us)
        {
            return redirect()->back()->with('message','Your Contact Successfully!');
        }else{
            return redirect()->back()->with('message','Something went wrong,please try again!');
        }
    }
}
