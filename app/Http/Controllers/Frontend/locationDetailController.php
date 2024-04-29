<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Our_location;
use App\Models\Showroom;

class locationDetailController extends Controller
{
    //locationDetail
    public function locationDetail()
    {
        $return_data = array();     
        $return_data['our_location'] = Our_location::first();
        $return_data['showrooms'] = Showroom::get();
        return view('frontend.our_location.index',array_merge($return_data));

    }
}
