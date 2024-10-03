<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use App\Models\NewCar;
use App\Constant;

class NewCarController extends Controller
{
    public function carList()
    {
        $return_data = array();
        $newCar = NewCar::first();
        $return_data['new_car'] = $newCar;
        $return_data['brands'] = Brand::get();
        $return_data['models'] = Car::where('car_type',Constant::NEW_CAR)->get();
        $return_data['meta_title'] = isset($newCar->meta_title) && $newCar->meta_title ? $newCar->meta_title : NULL;
        $return_data['meta_description'] = isset($newCar->meta_description) && $newCar->meta_description ? $newCar->meta_description : NULL;
        $return_data['meta_keyword'] = isset($newCar->meta_keyword) && $newCar->meta_keyword ? $newCar->meta_keyword : NULL;
        // $brand_id = json_decode($return_data['new_car']['brand_id']);
        // $car_id = json_decode($return_data['new_car']['car_id']);
        // $return_data['brands'] = Brand::whereIn('id',$brand_id)->get();
        // $return_data['models'] = Car::whereIn('id',$car_id)->get();
        return view('frontend.new_car.index',array_merge($return_data));
    }
}
