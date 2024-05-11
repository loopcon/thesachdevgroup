<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\CarInsurance;

class CarInsuranceDetailController extends Controller
{
    public function bookInsurance()
    {
        $return_data = array();
        $return_data['car_insurance'] = CarInsurance::first();
        $brand_id = json_decode($return_data['car_insurance']['brand_id']);
        $return_data['brands'] = Brand::select('id','name','image')->whereIn('id',$brand_id)->get();

        return view('frontend.car_insurance.index',array_merge($return_data));
    }
}
