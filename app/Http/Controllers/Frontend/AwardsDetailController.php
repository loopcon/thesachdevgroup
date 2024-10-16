<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Awards;
use App\Models\AwardBanner;
use App\Models\OurBusiness;

class AwardsDetailController extends Controller
{
    public function gallery()
    {
        $return_data = array();
        $return_data['banner'] = $awardBanner = AwardBanner::first();
        $return_data['business'] = OurBusiness::select('id','title')->get();
        $return_data['awards'] = Awards::with('businessdDetail')->select('id', 'business_id','name','image')->get();
        $return_data['awards_data'] = Awards::with('businessdDetail')->select('id', 'business_id','name','image')->distinct()->get()->unique('businessdDetail.id');

        $return_data['meta_title'] = isset($awardBanner->meta_title) && $awardBanner->meta_title ? $awardBanner->meta_title : NULL;
        $return_data['meta_description'] = isset($awardBanner->meta_description) && $awardBanner->meta_description ? $awardBanner->meta_description : NULL;
        $return_data['meta_keyword'] = isset($awardBanner->meta_keyword) && $awardBanner->meta_keyword ? $awardBanner->meta_keyword : NULL;

        return view('frontend.awards.index',array_merge($return_data));
    }
}
