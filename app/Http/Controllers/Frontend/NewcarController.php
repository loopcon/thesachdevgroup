<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use DB;

class NewcarController extends Controller
{
    public function carList()
    {
        $return_data = array();
        $return_data['brands'] = Brand::get();
         $return_data['models'] = Car::get();
        return view('frontend.new_car.index',array_merge($return_data));
    }
}
