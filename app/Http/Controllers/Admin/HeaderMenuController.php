<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header_menu;
use Illuminate\Validation\Rule;
use DataTables;

class HeaderMenuController extends Controller
{
    //header_menu
    public function header_menu(Request $request){
        $has_permission = hasPermission('Header Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                return view("admin.header_menu.form"); 
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function header_menu_insert(Request $request)
    {
        $has_permission = hasPermission('Header Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'name' => ['required',
                        Rule::unique('header_menus')->where(function ($query) use ($request) {
                            return $query->where('name', $request->name)
                            ->where('menu_name', $request->menu_name)->whereNull('deleted_at');
                        })
                    ],
                    'menu_name' => 'required',
                    'link' => 'nullable|url',
                ]);

                $header_menu = new Header_menu();
                $header_menu->menu_name = $request->menu_name;
                $header_menu->name = $request->name;
                $header_menu->link = $request->link;
                $header_menu->color = $request->color;
                $header_menu->font_size = $request->font_size;
                $header_menu->font_family = $request->font_family;
                $header_menu->save();
               
                return redirect()->route('header_menu.index')->with('success','Header Menu insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function header_menu_index(Request $request)
    {
        if ($request->ajax()) {
            $header_menu = Header_menu::orderBy('id', 'DESC')->get();
            return Datatables::of($header_menu)
                    ->addIndexColumn()
                    ->addColumn('action', function($header_menu){
                        $updateButton = "";
                        $deleteBtn = "";
                        $has_permission = hasPermission('Header Menu');
                        if(isset($has_permission) && $has_permission)
                        {
                            if($has_permission->full_permission == 1)
                            {
                                $updateButton = "<a href='".route("header_menu.edit",encrypt($header_menu->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                                $deleteBtn = "<a href='javascript:void(0);' data-href='".route('header_menu_destroy',array($header_menu->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            }
                        }
                    return $updateButton . $deleteBtn;
                    })

            ->rawColumns(['action'])
            ->make(true);
        }
        $has_header_menu_permission = hasPermission('Header Menu');
        $has_social_media_permission = hasPermission('Header Menu Social Media Icon');
        if(($has_header_menu_permission && ($has_header_menu_permission->read_permission == 1 || $has_header_menu_permission->full_permission == 1)) ||
        ($has_social_media_permission && ($has_social_media_permission->read_permission == 1 || $has_social_media_permission->full_permission == 1))) {
            return view('admin.header_menu.show');
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function header_menu_edit($id)
    {
        $has_permission = hasPermission('Header Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $header_menus  = Header_menu::where('id',decrypt($id))->get();
                return view('admin.header_menu._form',compact('header_menus'));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function header_menu_update(Request $request, $id)
    {
        $has_permission = hasPermission('Header Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'name' => ['required',
                        Rule::unique('header_menus')->where(function ($query) use ($request) {
                            return $query->where('name', $request->name)
                            ->where('menu_name', $request->menu_name)->where('id','!=',$request->id)->whereNull('deleted_at');
                        })
                    ],
                    'link' => 'nullable|url',
                ]);

                $header_menu = Header_menu::find($id);
                $header_menu->menu_name = $request->menu_name;
                $header_menu->name = $request->name;
                $header_menu->link = $request->link;
                $header_menu->color = $request->color;
                $header_menu->font_size = $request->font_size;
                $header_menu->font_family = $request->font_family;
                $header_menu->save();

                return redirect()->route('header_menu.index')->with('success','Header Menu update successfully.');
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function header_menu_destroy(Request $request,$id)
    {
        $has_permission = hasPermission('Header Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $header_menu = Header_menu::findOrFail($id);
                $header_menu->delete();
        
                if($header_menu)
                {
                    return redirect()->route('header_menu.index')->with('success', 'Header Menu deleted successfully.');
                }
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
