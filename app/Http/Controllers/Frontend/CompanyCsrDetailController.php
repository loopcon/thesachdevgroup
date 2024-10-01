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
        $return_data['csr'] = $companyCsr = CompanyCsr::first();
        $return_data['meta_title'] = isset($companyCsr->meta_title) && $companyCsr->meta_title ? $companyCsr->meta_title : NULL;
        $return_data['meta_description'] = isset($companyCsr->meta_description) && $companyCsr->meta_description ? $companyCsr->meta_description : NULL;
        $return_data['meta_keyword'] = isset($companyCsr->meta_keyword) && $companyCsr->meta_keyword ? $companyCsr->meta_keyword : NULL;

        return view('frontend.company_csr.index',array_merge($return_data));
    }
}
