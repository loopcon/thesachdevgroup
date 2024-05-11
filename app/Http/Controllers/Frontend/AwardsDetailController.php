<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Awards;
use App\Models\AwardBanner;

class AwardsDetailController extends Controller
{
    public function gallery()
    {
        $return_data = array();
        $return_data['banner'] = AwardBanner::first();
        $return_data['awards'] = Awards::with('businessdDetail')->select('id', 'business_id','name','image')->get();
        $return_data['awards_data'] = Awards::with('businessdDetail')->select('id', 'business_id','name','image')->distinct()->get()->unique('showroomdDetail.id');
        // print_r($return_data['awards_data']);exit;
        return view('frontend.awards.index',array_merge($return_data));
    }
}