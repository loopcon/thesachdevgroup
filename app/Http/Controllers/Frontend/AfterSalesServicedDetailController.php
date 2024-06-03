<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AfterSalesService;
use App\Models\Brand;
use App\Models\BookCarService;

class AfterSalesServicedDetailController extends Controller
{
    public function bookService()
    {
        $return_data = array();
        $return_data['after_sales_service'] = AfterSalesService::first();
        $brand_id = json_decode($return_data['after_sales_service']['brand_id']);
        $return_data['brands'] = Brand::select('id','name','image','link')->whereIn('id',$brand_id)->get();
        
        return view('frontend.after_sales_service.index',array_merge($return_data));
    }

    public function bookCarService(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $book_service = new BookCarService();
        $book_service->first_name = $request->first_name;
        $book_service->phone = $request->phone;
        $book_service->email = $request->email;
        $book_service->brand_id = $request->brand_id;

        $book_service->save();

        if($book_service)
        {
            return redirect()->back()->with('message','Service booked successfully!');
        }else{
            return redirect()->back()->with('message','Service not booked, please try again!');
        }
    }
}
