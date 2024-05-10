<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AfterSalesService;
use App\Models\Brand;

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
}
