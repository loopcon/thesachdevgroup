<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyCsr;

class CompanyCsrController extends Controller
{
    public function companyCsr()
    {
        $has_permission = hasPermission('Company CSR');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Company CSR');
                $return_data['record'] = CompanyCsr::first();

                return view("admin.company_csr.index",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function companyCsrUpdate(Request $request)
    {
        $has_permission = hasPermission('Company CSR');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $request->validate([
                    'banner_image' => 'image|mimes:jpeg,png,jpg,webp,svg',
                    'title' => 'required',
                ]);
                $company_csr = CompanyCsr::first();
                if(isset($company_csr->id) && $company_csr->id)
                {
                    $id = $company_csr->id;
                    $company_csr = CompanyCsr::find($id);
                    $fields = array('title','title_color','title_font_size','title_font_family','description','description_font_color','description_font_size','description_font_family','left_title','left_title_color','left_title_font_size','left_title_font_family','left_description', 'meta_title', 'meta_keyword', 'meta_description');
                    foreach($fields as $field)
                    {
                        $company_csr->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }

                    if($request->hasFile('banner_image')) {
                        $oldimage = $company_csr->banner_image;
                        if($oldimage)
                        {
                            removeFile('uploads/companyCsrBanner'.$oldimage);
                        }
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/companyCsrBanner');
                        $company_csr->banner_image = $banner_image;
                    }

                    if($request->hasFile('image')) {
                        $oldimage = $company_csr->image;
                        if($oldimage)
                        {
                            removeFile('uploads/companyCsr'.$oldimage);
                        }
                        $image = fileUpload($request, 'image', 'uploads/companyCsr');
                        $company_csr->image = $image;
                    }
                    $company_csr->save();

                }else{

                    $company_csr = new CompanyCsr();
                    $fields = array('title','title_color','title_font_size','title_font_family','description','description_font_color','description_font_size','description_font_family','left_title','left_title_color','left_title_font_size','left_title_font_family','left_description', 'meta_title', 'meta_keyword', 'meta_description');
                    foreach($fields as $field)
                    {
                        $company_csr->$field = isset($request->$field) && $request->$field !='' ? $request->$field : NULL;
                    }

                    if($request->hasFile('banner_image')) {
                        $banner_image = fileUpload($request, 'banner_image', 'uploads/companyCsrBanner');
                        $company_csr->banner_image = $banner_image;
                    }

                    if($request->hasFile('image')) {
                        $image = fileUpload($request, 'image', 'uploads/companyCsr');
                        $company_csr->image = $image;
                    }
                    $company_csr->save();
                }
                if($company_csr)
                {
                    return redirect()->back()->with('success', trans('Company CSR update successfully.'));
                }else{
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
