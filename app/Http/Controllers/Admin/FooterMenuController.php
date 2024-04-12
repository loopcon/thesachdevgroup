<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer_menu;
use Illuminate\Validation\Rule;
use DataTables;

class FooterMenuController extends Controller
{
    //footer_menu
    public function footer_menu()
    {
        $has_permission = hasPermission('Footer Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Footer Menu');
                return view("admin.footer_menu.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('message', 'You have not permission to access this page!');
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function footerMenuCreate()
    {
        $has_permission = hasPermission('Footer Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Footer Menu Create');
                return view("admin.footer_menu.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function footer_menu_insert(Request $request){
        $has_permission = hasPermission('Footer Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $request->validate([
                    'name' => ['required',
                        Rule::unique('footer_menus')->where(function ($query) use ($request) {
                            return $query->where('name', $request->name)
                            ->where('menu_name', $request->menu_name)->whereNull('deleted_at');
                        })
                    ],
                    'menu_name' => 'required',
                    'link' => 'url',
                ]);

                $footer_menu = new Footer_menu();
                $footer_menu->menu_name = $request->menu_name;
                $footer_menu->name = $request->name;
                $footer_menu->link = $request->link;
                $footer_menu->color = $request->color;
                $footer_menu->font_size = $request->font_size;
                $footer_menu->font_family = $request->font_family;

                $footer_menu->footer_description = $request->footer_description;

                $footer_menu->footer_description_color = $request->footer_description_color;
                $footer_menu->footer_description_font_size = $request->footer_description_font_size;
                $footer_menu->footer_description_font_family = $request->footer_description_font_family;

                $footer_menu->save();
        
                return redirect()->route('footer_menu')->with('success','Footer Menu insert successfully.');
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        } else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function footer_menu_index(Request $request){
        if ($request->ajax()) {
            $footer_menu = Footer_menu::orderBy('id', 'DESC')->get();
            return Datatables::of($footer_menu)
                    ->addIndexColumn()
                    ->addColumn('action', function($footer_menu){
                        $updateButton = "";
                        $deleteBtn = "";
                        $has_permission = hasPermission('Footer Menu');
                        if(isset($has_permission) && $has_permission)
                        {
                            if($has_permission->full_permission == 1)
                            {

                                $updateButton = "<a href='".route("footer_menu.edit",encrypt($footer_menu->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                                $deleteBtn = "<a href='javascript:void(0);' data-href='".route('footer_menu_destroy',array($footer_menu->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                            }
                        }
                        return $updateButton . $deleteBtn;
                    })

                    ->editColumn('footer_description', function($footer_menu){

                        $footer_description = $footer_menu->footer_description;
                        return $footer_description;
                    })
                    
            ->rawColumns(['action','footer_description'])
            ->make(true);
        }
       
        return redirect()->back()->with('message','something went wrong');
    }

    
    public function footer_menu_edit($id)
    {
        $has_permission = hasPermission('Footer Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('Footer Menu Edit');
                $footer_menu = Footer_menu::find($id);
                $return_data['record'] = $footer_menu;
                return view("admin.footer_menu.form",array_merge($return_data));
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function footer_menu_update(Request $request, $id)
    {
        $has_permission = hasPermission('Footer Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {

                $request->validate([
                    'name' => ['required',
                        Rule::unique('footer_menus')->where(function ($query) use ($request) {
                            return $query->where('name', $request->name)
                            ->where('menu_name', $request->menu_name)->where('id','!=',decrypt($request->id))->whereNull('deleted_at');
                        })
                    ],
                    'link' => 'nullable|url',
                ]);

                $footer_menu = Footer_menu::find(decrypt($id));
                $footer_menu->menu_name = $request->menu_name;
                $footer_menu->name = $request->name;
                $footer_menu->link = $request->link;
                $footer_menu->color = $request->color;
                $footer_menu->font_size = $request->font_size;
                $footer_menu->font_family = $request->font_family;

                $footer_menu->footer_description = $request->footer_description;

                $footer_menu->footer_description_color = $request->footer_description_color;
                $footer_menu->footer_description_font_size = $request->footer_description_font_size;
                $footer_menu->footer_description_font_family = $request->footer_description_font_family;
                
                $footer_menu->save();

                return redirect()->route('footer_menu')->with('success','Footer Menu update successfully.');
    
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function footer_menu_destroy(Request $request,$id){
        $has_permission = hasPermission('Footer Menu');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $footer_menu = Footer_menu::findOrFail($id);
                $footer_menu->delete();
        
                if($footer_menu)
                {
                    return redirect()->route('footer_menu')->with('message', 'Footer Menu deleted successfully');
                }
            } else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
