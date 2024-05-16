<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyCsr;

class CompanyCsrDetailController extends Controller
{
    public function companyCsr()
    {
        $return_data = array();
        $return_data['csr'] = CompanyCsr::first();
        return view('frontend.company_csr.index',array_merge($return_data));
    }
}
