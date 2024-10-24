<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewCar;
use App\Models\Car;
use App\Models\OurServiceUsedCars;
use Constant;

class UsedCarDetailController extends Controller
{
    public function usedCar()
    {
        $usedCar = OurServiceUsedCars::first();
        $return_data = array();
        $return_data['usedCar'] = $usedCar;
        $return_data['car_models'] = Car::where('car_type',Constant::USED_CAR)->select('id','image','name','price','link','name_color','price_color','name_font_size','price_font_size','name_font_family','price_font_family','driven','driven_color','driven_font_size','driven_font_family','fuel_type','fuel_type_color','fuel_type_font_size','fuel_type_font_family','year','year_color','year_font_size','year_font_family','body_style','body_style_color','body_style_font_size','body_style_font_family')->get();

        $return_data['meta_title'] = isset($usedCar->meta_title) && $usedCar->meta_title ? $usedCar->meta_title : NULL;
        $return_data['meta_description'] = isset($usedCar->meta_description) && $usedCar->meta_description ? $usedCar->meta_description : NULL;
        $return_data['meta_keyword'] = isset($usedCar->meta_keyword) && $usedCar->meta_keyword ? $usedCar->meta_keyword : NULL;

        return view('frontend.used_car.index',array_merge($return_data));
    }
}
