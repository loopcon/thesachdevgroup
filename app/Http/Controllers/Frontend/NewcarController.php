<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use App\Models\NewCar;

class NewcarController extends Controller
{
    public function carList()
    {
        $return_data = array();
        $return_data['new_car'] = NewCar::first();
        $return_data['brands'] = Brand::get();
        $return_data['models'] = Car::get();
        // $brand_id = json_decode($return_data['new_car']['brand_id']);
        // $car_id = json_decode($return_data['new_car']['car_id']);
        // $return_data['brands'] = Brand::whereIn('id',$brand_id)->get();
        // $return_data['models'] = Car::whereIn('id',$car_id)->get();
        return view('frontend.new_car.index',array_merge($return_data));
    }
}
