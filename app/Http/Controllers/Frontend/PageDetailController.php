<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Faq;
use App\Models\FaqTitle;

class PageDetailController extends Controller
{
    public function cmsPage($slug)
    {
        // $segment = request()->segment(1);
        if($slug){
            $pageInfo = Page::where([['slug' , $slug]])->first();
            if($pageInfo){
                $return_data = array();
                $return_data['site_title'] = trans(ucwords($pageInfo->name));
                $return_data['pageInfo'] = $pageInfo;

                $return_data['meta_title'] = isset($pageInfo->meta_title) && $pageInfo->meta_title ? $pageInfo->meta_title : NULL;
                $return_data['meta_description'] = isset($pageInfo->meta_description) && $pageInfo->meta_description ? $pageInfo->meta_description : NULL;
                $return_data['meta_keyword'] = isset($pageInfo->meta_keyword) && $pageInfo->meta_keyword ? $pageInfo->meta_keyword : NULL;
                    
                return view('frontend.cms_page.index', array_merge($return_data));
            } else {
                return redirect('/');
            }
        }
    }

    public function faqPage()
    {
        $return_data = array();
        $return_data['faqs'] = Faq::select('id','name','description')->get();
        $return_data['faq_title'] = $faqTitle = FaqTitle::first();
        $return_data['meta_title'] = isset($faqTitle->meta_title) && $faqTitle->meta_title ? $faqTitle->meta_title : NULL;
        $return_data['meta_description'] = isset($faqTitle->meta_description) && $faqTitle->meta_description ? $faqTitle->meta_description : NULL;
        $return_data['meta_keyword'] = isset($faqTitle->meta_keyword) && $faqTitle->meta_keyword ? $faqTitle->meta_keyword : NULL;

        return view('frontend.faq.index',array_merge($return_data));
    }
}
