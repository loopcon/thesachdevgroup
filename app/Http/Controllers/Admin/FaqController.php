<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Faq;
use App\Models\FaqTitle;
use DataTables;
use DB;

class FaqController extends Controller
{
    public function faqList()
    {
        $has_permission = hasPermission('Faqs');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Faqs');
                $faq_title = FaqTitle::first();
                $return_data['record'] = $faq_title;
                return view("admin.faq.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function faqCreate(Request $request)
    {
        $has_permission = hasPermission('Faqs');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Faq Create');
                return view("admin.faq.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function faqDatatable(Request $request)
    {
        if($request->ajax()){
            $query = Faq::select('id', 'name', 'description')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('description', function($list){
                    $description = isset($list->description) && $list->description ? strip_tags($list->description) : NULL;
                    return $description;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Faqs');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('faq-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('faq-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function faqStore(Request $request)
    {
        $has_permission = hasPermission('Faqs');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'name' => 'required',
                ]);
                $faq = new Faq();
                $faq->name = $request->name ? $request->name : NULL;
                $faq->slug = $request->name ? slugify($request->name) : NULL;
                $faq->description = $request->description ? $request->description : NULL;
                // $faq->meta_title = $request->meta_title ? $request->meta_title : NULL;
                // $faq->meta_keyword = $request->meta_keyword ? $request->meta_keyword : NULL;
                // $faq->meta_description = $request->meta_description ? $request->meta_description : NULL;
                

                $faq->save();

                if($faq)
                {
                    return redirect()->route('faq')->with('success', 'Faq insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function faqEdit($id)
    {
        $has_permission = hasPermission('Faqs');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Faq Edit');
                $faq = Faq::find($id);
                $return_data['record'] = $faq;
                return view("admin.faq.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function faqUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Faqs');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'name' => 'required',
                ]);
                $faq = Faq::find($id);
                $faq->name = $request->name ? $request->name : NULL;
                $faq->slug = $request->name ? slugify($request->name) : NULL;
                $faq->description = $request->description ? $request->description : NULL;
                // $faq->meta_title = $request->meta_title ? $request->meta_title : NULL;
                // $faq->meta_keyword = $request->meta_keyword ? $request->meta_keyword : NULL;
                // $faq->meta_description = $request->meta_description ? $request->meta_description : NULL;

                $faq->save();

                if($faq)
                {
                    return redirect()->route('faq')->with('success', 'Faq update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function faqDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Faqs');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $faq = Faq::where('id',$id)->delete();
                if($faq)
                {
                    return redirect()->route('faq')->with('success', 'Faq deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function faqTitleUpdate(Request $request)
    {
        $has_permission = hasPermission('Faqs');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'title' => 'required',
                ]);

                $faq_title = FaqTitle::first();
                $faq_title->title = $request->title;
                $faq_title->title_font_size = $request->title_font_size;
                $faq_title->title_color = $request->title_color;
                $faq_title->title_font_family = $request->title_font_family;
                $faq_title->meta_title = $request->meta_title ? $request->meta_title : NULL;
                $faq_title->meta_keyword = $request->meta_keyword ? $request->meta_keyword : NULL;
                $faq_title->meta_description = $request->meta_description ? $request->meta_description : NULL;
                $faq_title->save();

                if($faq_title)
                {
                    return redirect()->route('faq')->with('success', 'Faq Title update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }
}
