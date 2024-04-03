<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Page;
use DataTables;
use DB;

class PageController extends Controller
{
    public function pageList()
    {
        $has_permission = hasPermission('Pages');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Pages');
                return view("admin.page.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function pageCreate(Request $request)
    {
        $has_permission = hasPermission('Pages');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Page Create');
                return view("admin.page.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function pageStore(Request $request)
    {
        $has_permission = hasPermission('Pages');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'name' => 'required',
                ]);
                $page = new Page();
                $page->name = $request->name ? $request->name : NULL;
                $page->slug = $request->name ? slugify($request->name) : NULL;
                $page->description = $request->description ? $request->description : NULL;

                $page->save();

                if($page)
                {
                    return redirect()->route('pages')->with('success', 'Page insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function pageDatatable(Request $request)
    {
        if($request->ajax()){
            $query = Page::select('id', 'name', 'description')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('description', function($list){
                    $description = isset($list->description) && $list->description ? strip_tags(Str::limit($list->description,50,'...')) : NULL;
                    return $description;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Pages');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('page-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('page-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function pageEdit($id)
    {
        $has_permission = hasPermission('Pages');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Page Edit');
                $page = Page::find($id);
                $return_data['record'] = $page;
                return view("admin.page.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function pageUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Pages');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'name' => 'required',
                ]);
                $page = Page::find($id);
                $page->name = $request->name ? $request->name : NULL;
                $page->slug = $request->name ? slugify($request->name) : NULL;
                $page->description = $request->description ? $request->description : NULL;

                $page->save();

                if($page)
                {
                    return redirect()->route('pages')->with('success', 'Page update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function pageDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Pages');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $page = Page::where('id',$id)->delete();
                if($page)
                {
                    return redirect()->route('pages')->with('success', 'Page deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
