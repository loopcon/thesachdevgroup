<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contact_us;

class ContactUsDetailController extends Controller
{
    //contactus_detail
    public function contactusDetail()
    {
        $return_data = array();     
        $return_data['contact_us'] = Contact_us::first();
        return view('frontend.contact_us.index',array_merge($return_data));

    }
}
