<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\CarInsurance;
use App\Models\BookInsurance;

class CarInsuranceDetailController extends Controller
{
    public function carInsurance()
    {
        $return_data = array();
        $return_data['car_insurance'] = CarInsurance::first();
        $brand_id = json_decode($return_data['car_insurance']['brand_id']);
        $return_data['brands'] = Brand::select('id','name','image')->whereIn('id',$brand_id)->get();

        return view('frontend.car_insurance.index',array_merge($return_data));
    }

    public function bookInsurance(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $book_insurance = new BookInsurance();
        $book_insurance->first_name = $request->first_name;
        $book_insurance->phone = $request->phone;
        $book_insurance->email = $request->email;
        $book_insurance->brand_id = $request->brand_id;

        $book_insurance->save();

        if($book_insurance)
        {
            return redirect()->back()->with('message','Insurance Booked successfully!');
        }else{
            return redirect()->back()->with('message','Insurance not booked, please try again!');
        }
    }
}
